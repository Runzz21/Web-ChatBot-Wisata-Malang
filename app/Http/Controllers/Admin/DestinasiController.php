<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinasiRequest;
use App\Http\Requests\UpdateDestinasiRequest;
use App\Models\Destinasi;
use App\Services\DestinasiService;
use App\Services\KategoriService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinasiController extends Controller
{
    public function __construct(
        private DestinasiService $destinasiService,
        private KategoriService $kategoriService
    ) {}

    public function index(Request $request): View
    {
        $kategoriList = $this->kategoriService->getAll();
        $search = $request->input('search');
        $kategoriId = $request->input('kategori');

        $destinasi = Destinasi::with('kategori')
            ->when($search, fn($q) => $q->where('nama', 'like', "%{$search}%"))
            ->when($kategoriId, fn($q) => $q->where('id_kategori', $kategoriId))
            ->orderByDesc('dibuat_pada')
            ->paginate(15);

        return view('admin.destinasi.index', compact('destinasi', 'kategoriList', 'search', 'kategoriId'));
    }

    public function create(): View
    {
        $kategoriList = $this->kategoriService->getAll();
        return view('admin.destinasi.create', compact('kategoriList'));
    }

    public function store(StoreDestinasiRequest $request): RedirectResponse
    {
        $this->destinasiService->create(
            $request->except('foto_utama'),
            $request->file('foto_utama')
        );

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil ditambahkan.');
    }

    public function edit(Destinasi $destinasi): View
    {
        $kategoriList = $this->kategoriService->getAll();
        return view('admin.destinasi.edit', compact('destinasi', 'kategoriList'));
    }

    public function update(UpdateDestinasiRequest $request, Destinasi $destinasi): RedirectResponse
    {
        $this->destinasiService->update(
            $destinasi,
            $request->except('foto_utama'),
            $request->file('foto_utama')
        );

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil diperbarui.');
    }

    public function destroy(Destinasi $destinasi): RedirectResponse
    {
        $this->destinasiService->delete($destinasi);

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil dihapus.');
    }

    public function toggleStatus(Destinasi $destinasi): RedirectResponse
    {
        $destinasi->update(['status_aktif' => !$destinasi->status_aktif]);

        $status = $destinasi->status_aktif ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.destinasi.index')
            ->with('success', "Destinasi berhasil {$status}.");
    }
}
