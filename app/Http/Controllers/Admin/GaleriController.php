<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\GaleriDestinasi;
use App\Services\GaleriService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GaleriController extends Controller
{
    public function __construct(
        private GaleriService $galeriService
    ) {}

    public function index(Destinasi $destinasi): View
    {
        $galeri = $this->galeriService->findByDestinasi($destinasi->id_destinasi);
        return view('admin.galeri.index', compact('destinasi', 'galeri'));
    }

    public function store(Request $request, Destinasi $destinasi): RedirectResponse
    {
        $request->validate([
            'foto' => ['required', 'array'],
            'foto.*' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $this->galeriService->storeImages(
            $destinasi->id_destinasi,
            $request->file('foto')
        );

        return redirect()->route('admin.galeri.index', $destinasi->id_destinasi)
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    public function destroy(Destinasi $destinasi, GaleriDestinasi $galeri): RedirectResponse
    {
        $this->galeriService->delete($galeri);

        return redirect()->route('admin.galeri.index', $destinasi->id_destinasi)
            ->with('success', 'Foto berhasil dihapus.');
    }

    public function updateUrutan(Request $request, Destinasi $destinasi): RedirectResponse
    {
        $request->validate([
            'urutan' => ['required', 'array'],
            'urutan.*' => ['required', 'integer', 'min:1'],
        ]);

        foreach ($request->input('urutan') as $idGaleri => $urutan) {
            $this->galeriService->updateUrutan((int) $idGaleri, (int) $urutan);
        }

        return redirect()->route('admin.galeri.index', $destinasi->id_destinasi)
            ->with('success', 'Urutan foto berhasil diperbarui.');
    }
}
