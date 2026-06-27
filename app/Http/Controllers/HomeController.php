<?php

namespace App\Http\Controllers;

use App\Services\DestinasiService;
use App\Services\KategoriService;

class HomeController extends Controller
{
    public function __construct(
        private KategoriService $kategoriService,
        private DestinasiService $destinasiService
    ) {}

    public function index()
    {
        $kategoriPopuler = $this->kategoriService->getPopuler(6);
        $destinasiPopuler = $this->destinasiService->getPopuler(6);
        $totalDestinasi = $this->destinasiService->countAktif();
        $totalKategori = $this->kategoriService->getAll()->count();

        return view('home.index', compact(
            'kategoriPopuler',
            'destinasiPopuler',
            'totalDestinasi',
            'totalKategori'
        ));
    }
}
