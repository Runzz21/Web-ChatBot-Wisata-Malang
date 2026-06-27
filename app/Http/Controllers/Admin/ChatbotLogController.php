<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ChatbotLogService;
use App\Services\KategoriService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class ChatbotLogController extends Controller
{
    public function __construct(
        private ChatbotLogService $chatbotLogService,
        private KategoriService $kategoriService
    ) {}

    public function index(Request $request): View
    {
        $kategoriList = $this->kategoriService->getAll();

        $logs = $this->chatbotLogService->paginate(
            perPage: 20,
            search: $request->input('search'),
            kategoriId: $request->input('kategori'),
            tanggalMulai: $request->input('tanggal_mulai'),
            tanggalAkhir: $request->input('tanggal_akhir')
        );

        return view('admin.chatbot-log.index', compact('logs', 'kategoriList'));
    }

    public function exportCsv(Request $request)
    {
        $kategoriId = $request->input('kategori');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $logs = $this->chatbotLogService->getAllForExport(
            $kategoriId, $tanggalMulai, $tanggalAkhir
        );

        $filename = 'chatbot-log-' . now()->format('Y-m-d-His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($logs) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Sesi ID', 'Kategori', 'Jarak', 'Anggaran', 'Jumlah Hasil', 'Waktu']);

            foreach ($logs as $log) {
                fputcsv($handle, [
                    $log->id_log,
                    $log->sesi_id,
                    $log->kategori?->nama_kategori ?? '-',
                    $log->jarak_pilihan ?? '-',
                    $log->anggaran_pilihan ?? '-',
                    $log->jumlah_hasil,
                    $log->dibuat_pada,
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }
}
