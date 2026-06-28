@extends('layouts.admin')

@section('title', 'Data Kategori')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <span class="text-xs font-mono font-medium tracking-widest uppercase" style="color: rgba(201, 168, 76, 0.6);">Kelola</span>
        <h1 class="text-2xl font-display font-semibold text-forest-800 mt-1.5 tracking-tight">Data Kategori</h1>
        <p class="text-forest-700/40 mt-1">Kelola kategori destinasi wisata</p>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="btn-solid text-sm group">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Tambah Kategori
    </a>
</div>

<div class="card-glass p-6">
    <form action="{{ route('admin.kategori.index') }}" method="GET" class="mb-6">
        <div class="flex gap-3">
            <input type="text" name="search" placeholder="Cari kategori..." value="{{ request('search') }}"
                   class="input-custom max-w-xs">
            <button type="submit" class="btn-solid text-sm">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.kategori.index') }}" class="btn-ghost text-sm">Reset</a>
            @endif
        </div>
    </form>

    <div class="overflow-x-auto -mx-6">
        <div class="inline-block min-w-full align-middle px-6">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-forest-600/10">
                        <th class="py-3.5 pr-4 font-semibold text-forest-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">No</th>
                        <th class="py-3.5 px-4 font-semibold text-forest-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Nama Kategori</th>
                        <th class="py-3.5 px-4 font-semibold text-forest-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Slug</th>
                        <th class="py-3.5 px-4 font-semibold text-forest-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Warna</th>
                        <th class="py-3.5 px-4 font-semibold text-forest-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Icon</th>
                        <th class="py-3.5 px-4 font-semibold text-forest-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Jumlah</th>
                        <th class="py-3.5 pl-4 font-semibold text-forest-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $item)
                        <tr class="border-b border-forest-600/5 hover:bg-forest-600/[0.03] transition-colors duration-200">
                            <td class="py-3.5 pr-4 text-forest-700/40 font-mono text-[0.75rem] whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="py-3.5 px-4 font-medium text-forest-700 whitespace-nowrap">{{ $item->nama_kategori }}</td>
                            <td class="py-3.5 px-4 text-forest-700/40 font-mono text-[0.75rem] whitespace-nowrap">{{ $item->slug }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-lg" style="background-color: {{ $item->warna_badge }}; border: 1px solid rgba(45, 74, 62, 0.08);"></span>
                                    <span class="text-forest-700/40 font-mono text-[0.6875rem]">{{ $item->warna_badge }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-forest-700/50 whitespace-nowrap">
                                @if($item->icon)
                                    <code class="text-[0.75rem] font-mono text-forest-700/40">{{ $item->icon }}</code>
                                @else
                                    <span class="text-forest-700/25">-</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 font-mono text-[0.75rem] text-forest-700/50 whitespace-nowrap">{{ $item->destinasi_count ?? $item->destinasions->count() }}</td>
                            <td class="py-3.5 pl-4 whitespace-nowrap">
                                <div class="flex items-center gap-0.5">
                                    <a href="{{ route('admin.kategori.edit', $item) }}"
                                       class="p-2 rounded-lg text-forest-700/30 hover:text-forest-600 hover:bg-forest-600/5 transition-all duration-200 hover:scale-105" title="Edit kategori">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.kategori.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-forest-700/30 hover:text-red-500 hover:bg-red-50 transition-all duration-200 hover:scale-105" title="Hapus kategori">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-20 text-center text-forest-700/50">
                                <div class="w-12 h-12 mx-auto mb-3 rounded-xl flex items-center justify-center" style="background: rgba(45, 74, 62, 0.05);">
                                    <svg class="w-6 h-6 text-forest-700/25" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                </div>
                                <p class="font-display font-semibold text-forest-600">Belum ada data kategori</p>
                                <p class="text-sm text-forest-700/30 mt-1">Mulai dengan menambah kategori baru</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 pt-4 border-t border-forest-600/5">
        {{ $kategori->appends(request()->query())->links() }}
    </div>
</div>
@endsection
