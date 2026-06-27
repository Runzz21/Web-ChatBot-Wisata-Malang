<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\Kategori;
use App\Services\KategoriService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function __construct(
        private KategoriService $kategoriService
    ) {}

    public function index(Request $request): View
    {
        $search = $request->input('search');

        if ($search) {
            $kategori = $this->kategoriService->search($search);
        } else {
            $kategori = $this->kategoriService->paginate(10);
        }

        return view('admin.kategori.index', compact('kategori', 'search'));
    }

    public function create(): View
    {
        return view('admin.kategori.create');
    }

    public function store(StoreKategoriRequest $request): RedirectResponse
    {
        $this->kategoriService->create($request->validated());

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori): View
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(UpdateKategoriRequest $request, Kategori $kategori): RedirectResponse
    {
        $this->kategoriService->update($kategori, $request->validated());

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori): RedirectResponse
    {
        try {
            $this->kategoriService->delete($kategori);
            return redirect()->route('admin.kategori.index')
                ->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori.index')
                ->with('error', $e->getMessage());
        }
    }
}
