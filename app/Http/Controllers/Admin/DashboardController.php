<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DestinasiService;
use App\Services\GaleriService;
use App\Services\ChatbotLogService;
use App\Services\KategoriService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private DestinasiService $destinasiService,
        private KategoriService $kategoriService,
        private GaleriService $galeriService,
        private ChatbotLogService $chatbotLogService
    ) {}

    public function index(): View
    {
        $totalDestinasi = $this->destinasiService->countTotal();
        $totalKategori = $this->kategoriService->getAll()->count();
        $totalGaleri = $this->galeriService->countTotal();
        $totalChatbot = $this->chatbotLogService->countTotal();

        return view('admin.dashboard.index', compact(
            'totalDestinasi',
            'totalKategori',
            'totalGaleri',
            'totalChatbot'
        ));
    }
}
