<?php

namespace App\Http\Controllers;

use App\Services\DestinasiService;
use App\Services\KategoriService;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function __construct(
        private DestinasiService $destinasiService,
        private KategoriService $kategoriService
    ) {}

    public function index(Request $request)
    {
        $kategoriList = $this->kategoriService->getAll();

        $destinasi = $this->destinasiService->paginate(
            perPage: 12,
            search: $request->input('search'),
            kategoriId: $request->input('kategori') ? (int) $request->input('kategori') : null,
            jarak: $request->input('jarak'),
            harga: $request->input('harga'),
            buka24Jam: $request->boolean('buka_24jam') ?: null,
            sortBy: $request->input('sort_by'),
            sortOrder: $request->input('sort_order')
        );

        if ($request->ajax()) {
            $html = view('destinasi.partials.grid', compact('destinasi'))->render();
            return response()->json(['html' => $html]);
        }

        return view('destinasi.index', compact('destinasi', 'kategoriList'));
    }

    public function show(string $nama)
    {
        $destinasi = $this->destinasiService->findByNama($nama);
        $rekomendasi = $this->destinasiService->getRekomendasiSerupa($destinasi);

        return view('destinasi.show', compact('destinasi', 'rekomendasi'));
    }
}
