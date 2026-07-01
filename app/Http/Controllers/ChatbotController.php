<?php

namespace App\Http\Controllers;

use App\Repositories\DestinasiRepository;
use App\Services\ChabotService;
use App\Services\GeminiService;
use App\Services\KategoriService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatbotController extends Controller
{
    public function __construct(
        private ChabotService $chabotService,
        private KategoriService $kategoriService
    ) {}

    public function index(): View
    {
        $kategoriList = $this->kategoriService->getAll();
        $jarakOptions = $this->chabotService->getJarakOptions();
        $anggaranOptions = $this->chabotService->getAnggaranOptions();

        return view('chatbot.index', compact(
            'kategoriList',
            'jarakOptions',
            'anggaranOptions'
        ));
    }

    public function chat(
        Request $request,
        GeminiService $gemini,
        DestinasiRepository $destinasiRepo
    ): JsonResponse {
        $request->validate([
            'message' => ['required', 'string', 'max:500'],
        ]);

        $userMessage = $request->input('message');
        $history = $request->session()->get('chatbot_history', []);
        $destinasiContext = $destinasiRepo->getAllForContext();

        $reply = $gemini->chatFree($userMessage, $history, $destinasiContext);

        $history[] = ['role' => 'user', 'content' => $userMessage];
        $history[] = ['role' => 'model', 'content' => $reply];

        if (count($history) > 20) {
            $history = array_slice($history, -20);
        }

        $request->session()->put('chatbot_history', $history);

        $destinasi = collect();
        $allDestinasi = \App\Models\Destinasi::aktif()->get(['nama', 'lokasi', 'harga_tiket', 'jarak_km']);
        $namaList = $allDestinasi->pluck('nama')->implode(', ');

        $aiChoicePrompt = "Pengguna bertanya: \"{$userMessage}\"\n\n"
            . "Daftar destinasi wisata Malang:\n{$namaList}\n\n"
            . "Pilih maksimal 4 destinasi yang PALING RELEVAN dengan pertanyaan pengguna. "
            . "Balas HANYA dengan nama-nama destinasi pisah koma, tanpa format lain. Contoh: \"Jatim Park 1, Museum Angkut\"\n"
            . "Jika tidak ada yang relevan, balas: \"TIDAK_ADA\"";

        $aiChoice = $gemini->generate($aiChoicePrompt, [
            'role' => 'Asisten pemilih destinasi',
            'tone' => 'akurat dan singkat',
        ]);

        $aiChoice = trim($aiChoice);
        if ($aiChoice !== 'TIDAK_ADA') {
            $names = array_map('trim', explode(',', $aiChoice));
            $destinasi = \App\Models\Destinasi::aktif()
                ->whereIn('nama', $names)
                ->take(4)
                ->get();
        }

        $destinasiHtml = $destinasi->isNotEmpty()
            ? view('chatbot.partials.result', ['rekomendasi' => $destinasi, 'aiMessage' => null])->render()
            : '';

        return response()->json([
            'success' => true,
            'reply' => $reply,
            'destinasiHtml' => $destinasiHtml,
        ]);
    }

    public function process(Request $request): JsonResponse
    {
        $step = (int) $request->input('step');

        if ($step === 2) {
            $kategoriId = $request->input('id_kategori');
            $request->session()->put('chatbot_kategori', $kategoriId);
        } elseif ($step === 3) {
            $jarak = $request->input('jarak');
            $request->session()->put('chatbot_jarak', $jarak);
        }

        return response()->json(['success' => true]);
    }

    public function processFinal(Request $request): JsonResponse
    {
        $request->validate([
            'anggaran' => ['nullable', 'string', 'in:gratis,<10000,10000-20000,>20000'],
        ]);

        $sessionId = $request->session()->getId();
        $kategoriId = $request->session()->get('chatbot_kategori');
        $jarak = $request->session()->get('chatbot_jarak');
        $anggaran = $request->input('anggaran') ?: null;

        $rekomendasi = $this->chabotService->getRecommendations(
            $kategoriId ? (int) $kategoriId : null,
            $jarak,
            $anggaran,
            5
        );

        $this->chabotService->saveSearchLog(
            $sessionId,
            $kategoriId ? (int) $kategoriId : null,
            $jarak,
            $anggaran,
            $rekomendasi->count()
        );

        $request->session()->forget(['chatbot_kategori', 'chatbot_kategori_nama', 'chatbot_jarak']);

        $kategoriNama = $kategoriId ? optional($this->kategoriService->findById((int) $kategoriId))->nama_kategori : 'Semua';
        $jarakLabel = collect($this->chabotService->getJarakOptions())
            ->firstWhere('value', $jarak)['label'] ?? 'Semua jarak';
        $anggaranLabel = collect($this->chabotService->getAnggaranOptions())
            ->firstWhere('value', $anggaran ?? '')['label'] ?? 'Semua anggaran';

        $aiMessage = '';
        if ($rekomendasi->isNotEmpty()) {
            $geminiService = app(GeminiService::class);
            $aiMessage = $geminiService->generateRecommendation([
                'kategori' => $kategoriNama,
                'jarak' => $jarakLabel,
                'anggaran' => $anggaranLabel,
            ], $rekomendasi->all());
        }

        $html = view('chatbot.partials.result', compact('rekomendasi', 'aiMessage'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
        ]);
    }
}
