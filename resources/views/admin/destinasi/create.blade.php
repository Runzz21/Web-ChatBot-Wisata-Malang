@extends('layouts.admin')

@section('title', 'Tambah Destinasi')

@section('content')
<div class="mb-8 reveal">
    <span class="text-xs font-mono font-medium tracking-widest uppercase text-gold-500/70">Destinasi</span>
    <h1 class="text-2xl font-display font-semibold text-forest-800 mt-1.5 tracking-tight">Tambah Destinasi</h1>
    <p class="text-forest-700/50 mt-1">Buat destinasi wisata alam baru</p>
</div>

<div class="card-glass p-6 max-w-3xl reveal" style="transition-delay: 0.1s">
    <form action="{{ route('admin.destinasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label for="nama" class="block text-sm font-medium text-forest-700 mb-1.5">Nama Destinasi <span class="text-red-400">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                       class="input-custom @error('nama') border-red-400 @enderror"
                       placeholder="Misal: Gunung Semeru" required>
                @error('nama')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="id_kategori" class="block text-sm font-medium text-forest-700 mb-1.5">Kategori <span class="text-red-400">*</span></label>
                <select name="id_kategori" id="id_kategori" class="select-custom @error('id_kategori') border-red-400 @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
                @error('id_kategori')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lokasi" class="block text-sm font-medium text-forest-700 mb-1.5">Lokasi <span class="text-red-400">*</span></label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                       class="input-custom @error('lokasi') border-red-400 @enderror"
                       placeholder="Kec. Poncokusumo, Kab. Malang" required>
                @error('lokasi')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="ketinggian_mdpl" class="block text-sm font-medium text-forest-700 mb-1.5">Ketinggian (mdpl)</label>
                <input type="number" name="ketinggian_mdpl" id="ketinggian_mdpl" value="{{ old('ketinggian_mdpl') }}"
                       class="input-custom @error('ketinggian_mdpl') border-red-400 @enderror"
                       placeholder="3676" min="0">
                @error('ketinggian_mdpl')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jarak_km" class="block text-sm font-medium text-forest-700 mb-1.5">Jarak (km)</label>
                <input type="number" name="jarak_km" id="jarak_km" value="{{ old('jarak_km') }}"
                       class="input-custom @error('jarak_km') border-red-400 @enderror"
                       placeholder="25.5" step="0.01" min="0">
                @error('jarak_km')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="harga_tiket" class="block text-sm font-medium text-forest-700 mb-1.5">Harga Tiket (Rp)</label>
                <input type="number" name="harga_tiket" id="harga_tiket" value="{{ old('harga_tiket') }}"
                       class="input-custom @error('harga_tiket') border-red-400 @enderror"
                       placeholder="15000" min="0">
                @error('harga_tiket')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jam_buka" class="block text-sm font-medium text-forest-700 mb-1.5">Jam Buka</label>
                <input type="time" name="jam_buka" id="jam_buka" value="{{ old('jam_buka') }}"
                       class="input-custom @error('jam_buka') border-red-400 @enderror">
                @error('jam_buka')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jam_tutup" class="block text-sm font-medium text-forest-700 mb-1.5">Jam Tutup</label>
                <input type="time" name="jam_tutup" id="jam_tutup" value="{{ old('jam_tutup') }}"
                       class="input-custom @error('jam_tutup') border-red-400 @enderror">
                @error('jam_tutup')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-colors" style="background: rgba(45, 74, 62, 0.03);">
                    <input type="checkbox" name="buka_24jam" id="buka_24jam" value="1" {{ old('buka_24jam') ? 'checked' : '' }}
                           class="w-4 h-4 text-forest-600 rounded focus:ring-forest-600/30 border-forest-600/20">
                    <span class="text-sm font-medium text-forest-700">Buka 24 Jam</span>
                </label>
            </div>

            <div class="md:col-span-2">
                <label for="deskripsi" class="block text-sm font-medium text-forest-700 mb-1.5">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="5"
                          class="input-custom @error('deskripsi') border-red-400 @enderror"
                          placeholder="Deskripsikan destinasi wisata ini...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="foto_utama" class="block text-sm font-medium text-forest-700 mb-1.5">Foto Utama</label>
                <input type="file" name="foto_utama" id="foto_utama" accept="image/*"
                       class="input-custom @error('foto_utama') border-red-400 @enderror p-2">
                @error('foto_utama')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="fasilitas" class="block text-sm font-medium text-forest-700 mb-1.5">Fasilitas</label>
                <input type="text" name="fasilitas" id="fasilitas" value="{{ old('fasilitas') }}"
                       class="input-custom @error('fasilitas') border-red-400 @enderror"
                       placeholder="Toilet, Area Parkir, Warung Makan">
                <p class="mt-1 text-xs text-forest-700/40">Pisahkan dengan koma</p>
                @error('fasilitas')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-colors" style="background: rgba(45, 74, 62, 0.03);">
                    <input type="checkbox" name="status_aktif" id="status_aktif" value="1" {{ old('status_aktif', '1') ? 'checked' : '' }}
                           class="w-4 h-4 text-forest-600 rounded focus:ring-forest-600/30 border-forest-600/20">
                    <span class="text-sm font-medium text-forest-700">Status Aktif</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-8 pt-6 border-t border-forest-600/10">
            <button type="submit" class="btn-solid text-sm">Simpan</button>
            <a href="{{ route('admin.destinasi.index') }}" class="btn-ghost text-sm">Kembali</a>
        </div>
    </form>
</div>
@endsection
