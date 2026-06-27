@extends('layouts.admin')

@section('title', 'Data Destinasi')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <span class="label-mono text-accent mb-2 block">KELOLA</span>
        <h1 class="text-2xl font-display font-semibold text-primary-800">Data Destinasi</h1>
        <p class="text-[#5A6B55] mt-1">Kelola destinasi wisata alam</p>
    </div>
    <a href="{{ route('admin.destinasi.create') }}" class="inline-flex items-center px-5 py-2.5 bg-accent text-white font-medium rounded-xl hover:bg-accent/90 transition-colors shadow-lereng-sm text-sm">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Destinasi
    </a>
</div>

<div class="card p-6">
    <form action="{{ route('admin.destinasi.index') }}" method="GET" class="mb-6 flex flex-col sm:flex-row gap-3">
        <input type="text" name="search" placeholder="Cari destinasi..." value="{{ request('search') }}"
               class="input-field max-w-xs">
        <select name="kategori" class="select-field max-w-[200px]">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $kat)
                <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-primary text-sm">Cari</button>
        @if(request('search') || request('kategori'))
            <a href="{{ route('admin.destinasi.index') }}" class="btn-secondary text-sm">Reset</a>
        @endif
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b border-primary-200">
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">No</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Nama</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Kategori</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Lokasi</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Harga</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Status</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($destinasi as $item)
                    <tr class="border-b border-primary-100 hover:bg-primary-50/50 transition-colors even:bg-black/[0.015]">
                        <td class="py-3.5 px-4 text-[#5A6B55] font-mono text-[0.75rem]">{{ $loop->iteration }}</td>
                        <td class="py-3.5 px-4 font-medium text-primary-800">{{ $item->nama }}</td>
                        <td class="py-3.5 px-4">
                            @if($item->kategori)
                            <span class="badge-category" style="background-color: {{ $item->kategori->warna_badge ?? '#2a4f3c' }}1A; color: {{ $item->kategori->warna_badge ?? '#2a4f3c' }}">
                                {{ $item->kategori->nama_kategori }}
                            </span>
                            @else
                            <span class="text-[#5A6B55]">-</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-[#5A6B55]">{{ $item->lokasi }}</td>
                        <td class="py-3.5 px-4 text-[#5A6B55] font-mono text-[0.75rem]">
                            @if($item->harga_tiket > 0)
                                Rp{{ number_format($item->harga_tiket, 0, ',', '.') }}
                            @else
                                <span class="text-[#5A6B55]/60">Gratis</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            @if($item->status_aktif)
                                <span class="badge-category bg-accent/10 text-accent">Aktif</span>
                            @else
                                <span class="badge-category bg-red-100 text-red-600">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-1">
                                <a href="{{ route('admin.destinasi.edit', $item) }}"
                                   class="p-2 rounded-lg text-[#5A6B55] hover:text-accent hover:bg-accent/5 transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.destinasi.toggle-status', $item) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="p-2 rounded-lg {{ $item->status_aktif ? 'text-[#5A6B55] hover:text-accent hover:bg-accent/5' : 'text-accent hover:bg-accent/5' }} transition-colors"
                                            title="{{ $item->status_aktif ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.destinasi.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus destinasi ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg text-[#5A6B55] hover:text-red-500 hover:bg-red-50 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-[#5A6B55]">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-primary-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#5A6B55]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            </div>
                            Belum ada data destinasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $destinasi->links() }}
    </div>
</div>
@endsection
