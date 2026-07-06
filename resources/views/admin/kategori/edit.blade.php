@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="mb-8 reveal">
    <span class="text-xs font-mono font-medium tracking-widest uppercase text-gold-500/70">Kategori</span>
    <h1 class="text-2xl font-display font-semibold text-ink mt-1.5 tracking-tight">Edit Kategori</h1>
    <p class="text-ink/50 mt-1">Perbarui data kategori destinasi wisata</p>
</div>

<div class="card-glass p-6 max-w-2xl reveal" style="transition-delay: 0.1s">
    <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label for="nama_kategori" class="block text-sm font-medium text-leaf-700 mb-1.5">Nama Kategori <span class="text-red-400">*</span></label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                   class="input-field @error('nama_kategori') border-red-400 @enderror"
                   placeholder="Misal: Gunung, Air Terjun" required>
            @error('nama_kategori')
                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="slug" class="block text-sm font-medium text-leaf-700 mb-1.5">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $kategori->slug) }}"
                   class="input-field @error('slug') border-red-400 @enderror"
                   placeholder="nama-kategori">
            <p class="mt-1 text-xs text-ink/40">Kosongkan untuk generate otomatis</p>
            @error('slug')
                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="warna_badge" class="block text-sm font-medium text-leaf-700 mb-1.5">Warna Badge</label>
            <div class="flex items-center gap-3">
                <input type="color" name="warna_badge" id="warna_badge" value="{{ old('warna_badge', $kategori->warna_badge) }}"
                       class="w-10 h-10 rounded-lg cursor-pointer" style="border: 1px solid rgba(14, 29, 24, 0.1);">
                <input type="text" name="warna_badge_text" id="warna_badge_text" value="{{ old('warna_badge', $kategori->warna_badge) }}"
                       class="input-field flex-1 font-mono text-[0.75rem]" placeholder="#2D4A3E" maxlength="7">
            </div>
            @error('warna_badge')
                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="icon" class="block text-sm font-medium text-leaf-700 mb-1.5">Icon</label>
            <input type="text" name="icon" id="icon" value="{{ old('icon', $kategori->icon) }}"
                   class="input-field @error('icon') border-red-400 @enderror"
                   placeholder="fas fa-mountain">
            <p class="mt-1 text-xs text-ink/40">Nama icon Font Awesome</p>
            @error('icon')
                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3 pt-6 border-t border-ink/10">
            <button type="submit" class="btn-primary text-sm">Perbarui</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn-ghost text-sm">Kembali</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('warna_badge').addEventListener('input', function() {
        document.getElementById('warna_badge_text').value = this.value;
    });
    document.getElementById('warna_badge_text').addEventListener('input', function() {
        document.getElementById('warna_badge').value = this.value;
    });
</script>
@endpush
