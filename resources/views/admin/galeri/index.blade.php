@extends('layouts.admin')

@section('title', 'Galeri Foto - ' . $destinasi->nama)

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 reveal">
    <div>
        <span class="text-xs font-mono font-medium tracking-widest uppercase text-gold-500/70">Galeri</span>
        <h1 class="text-2xl font-display font-semibold text-forest-800 mt-1.5 tracking-tight">Galeri — {{ $destinasi->nama }}</h1>
        <p class="text-forest-700/50 mt-1">Kelola foto destinasi wisata</p>
    </div>
    <a href="{{ route('admin.destinasi.index') }}" class="btn-ghost text-sm group">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
</div>

<div class="card-glass p-6 mb-6 reveal" style="transition-delay: 0.1s">
    <h2 class="text-lg font-display font-semibold text-forest-800 mb-4">Upload Foto Baru</h2>
    <form action="{{ route('admin.galeri.store', $destinasi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col sm:flex-row gap-3 items-start">
            <div class="flex-1 w-full">
                <input type="file" name="foto[]" id="foto" multiple accept="image/*"
                       class="input-custom @error('foto.*') border-red-400 @enderror p-2">
                @error('foto.*')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
                @error('foto')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn-solid text-sm flex-shrink-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Upload
            </button>
        </div>
    </form>
</div>

<div class="card-glass p-6 reveal" style="transition-delay: 0.2s">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-display font-semibold text-forest-800">Daftar Foto</h2>
        @if($destinasi->galeri->count() > 0)
            <form action="{{ route('admin.galeri.urutan', $destinasi) }}" method="POST" id="formUrutan">
                @csrf
                @method('PUT')
                <input type="hidden" name="urutan" id="urutanInput" value="">
                <button type="submit" class="btn-solid text-sm" id="simpanUrutanBtn" style="display:none;">
                    Simpan Urutan
                </button>
            </form>
        @endif
    </div>

    @if($destinasi->galeri->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" id="galeriGrid">
            @foreach($destinasi->galeri->sortBy('urutan') as $foto)
                <div class="relative group rounded-xl overflow-hidden" style="background: rgba(45, 74, 62, 0.03); border: 1px solid rgba(45, 74, 62, 0.06);" data-id="{{ $foto->id }}">
                    <img src="{{ asset('storage/' . $foto->url_foto) }}" alt="Foto {{ $destinasi->nama }}"
                         class="w-full h-40 object-cover">
                    <div class="absolute inset-0 bg-forest-900/0 group-hover:bg-forest-900/40 transition-all flex items-center justify-center gap-2">
                        <form action="{{ route('admin.galeri.destroy', [$destinasi, $foto]) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500/90 text-white p-2.5 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600 shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                    <div class="absolute top-2 left-2 font-mono text-[0.6875rem] px-2 py-1 rounded-lg backdrop-blur-sm"
                         style="background: rgba(45, 74, 62, 0.6); color: #F5F0E8;">
                        {{ $foto->urutan }}
                    </div>
                    <div class="absolute top-2 right-2 cursor-move rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-opacity handle shadow-warm"
                         style="background: rgba(253, 251, 247, 0.9);">
                        <svg class="w-4 h-4 text-forest-700/50" fill="currentColor" viewBox="0 0 24 24"><path d="M8 6h2v2H8V6zm6 0h2v2h-2V6zM8 11h2v2H8v-2zm6 0h2v2h-2v-2zm-6 5h2v2H8v-2zm6 0h2v2h-2v-2z"/></svg>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 text-forest-700/50">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl flex items-center justify-center" style="background: rgba(45, 74, 62, 0.05);">
                <svg class="w-8 h-8 text-forest-700/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <p class="font-display font-semibold text-forest-700">Belum ada foto</p>
            <p class="text-sm mt-1">Upload foto untuk destinasi ini</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    var galeriGrid = document.getElementById('galeriGrid');
    if (galeriGrid) {
        var sortable = new Sortable(galeriGrid, {
            handle: '.handle',
            animation: 200,
            onEnd: function() {
                var urutan = [];
                galeriGrid.querySelectorAll('[data-id]').forEach(function(el, index) {
                    urutan.push({ id: el.dataset.id, urutan: index + 1 });
                    var badge = el.querySelector('.absolute.top-2.left-2');
                    if (badge) badge.textContent = index + 1;
                });
                document.getElementById('urutanInput').value = JSON.stringify(urutan);
                document.getElementById('simpanUrutanBtn').style.display = 'inline-flex';
            }
        });
    }
</script>
@endpush
