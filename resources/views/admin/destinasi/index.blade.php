@extends('layouts.admin')

@section('title', 'Kelola Destinasi')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-display font-bold text-ink tracking-tight">Destinasi Wisata</h1>
            <p class="text-ink/50 text-sm mt-1">Kelola data destinasi wisata alam</p>
        </div>
        <a href="{{ route('admin.destinasi.create') }}" class="btn-primary text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Destinasi
        </a>
    </div>

    <div class="card-glass overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-ink/5">
                        <th class="text-left px-5 py-4 font-display font-semibold text-ink/60 text-xs uppercase tracking-widest">Foto</th>
                        <th class="text-left px-5 py-4 font-display font-semibold text-ink/60 text-xs uppercase tracking-widest">Nama</th>
                        <th class="text-left px-5 py-4 font-display font-semibold text-ink/60 text-xs uppercase tracking-widest hidden md:table-cell">Kategori</th>
                        <th class="text-left px-5 py-4 font-display font-semibold text-ink/60 text-xs uppercase tracking-widest hidden lg:table-cell">Lokasi</th>
                        <th class="text-left px-5 py-4 font-display font-semibold text-ink/60 text-xs uppercase tracking-widest hidden sm:table-cell">Harga</th>
                        <th class="text-right px-5 py-4 font-display font-semibold text-ink/60 text-xs uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinasi as $item)
                    <tr class="border-b border-ink/5 hover:bg-leaf-600/5 transition-colors">
                        <td class="px-5 py-4">
                            <div class="w-12 h-12 rounded-xl overflow-hidden" style="border: 1px solid rgba(14,29,24,0.06);">
                                <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="px-5 py-4 font-medium text-ink">{{ $item->nama }}</td>
                        <td class="px-5 py-4 text-ink/60 hidden md:table-cell">
                            <span class="badge-leaf">{{ $item->kategori->nama_kategori ?? '-' }}</span>
                        </td>
                        <td class="px-5 py-4 text-ink/60 hidden lg:table-cell max-w-[200px] truncate">{{ $item->lokasi }}</td>
                        <td class="px-5 py-4 hidden sm:table-cell">
                            <span class="font-semibold text-leaf-600">{{ $item->formatted_harga ?? 'Gratis' }}</span>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.destinasi.edit', $item->id_destinasi) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors" style="background: rgba(45,74,62,0.06); color: #2D4A3E; border: 1px solid rgba(14,29,24,0.08);">Edit</a>
                                <form action="{{ route('admin.destinasi.destroy', $item->id_destinasi) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors" style="background: rgba(239,68,68,0.06); color: #DC2626; border: 1px solid rgba(239,68,68,0.12);" onclick="return confirm('Hapus destinasi ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center text-ink/40">Belum ada data destinasi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $destinasi->links() }}
    </div>
</div>
@endsection
