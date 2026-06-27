<?php

namespace App\Http\Controllers;

use App\Services\ChabotService;
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

        $html = view('chatbot.partials.result', compact('rekomendasi'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'message' => $rekomendasi->isEmpty()
                ? 'Maaf, tidak ada destinasi yang sesuai dengan kriteria Anda.'
                : 'Berikut ' . $rekomendasi->count() . ' rekomendasi wisata untuk Anda:',
        ]);
    }
}
