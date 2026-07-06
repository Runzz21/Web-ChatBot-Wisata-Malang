@extends('layouts.admin')

@section('title', 'Riwayat Pencarian Chatbot')

@section('content')
<div class="mb-8">
    <span class="text-xs font-mono font-medium tracking-widest uppercase" style="color: rgba(201, 168, 76, 0.6);">Chatbot</span>
    <h1 class="text-2xl font-display font-semibold text-ink mt-1.5 tracking-tight">Riwayat Pencarian Chatbot</h1>
    <p class="text-ink/40 mt-1">Lihat riwayat pencarian pengguna melalui Kang Lereng</p>
</div>

<div class="card-glass p-6 mb-6">
    <form action="{{ route('admin.chatbot-log.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-end">
        <div>
            <label class="block font-mono text-[0.6875rem] font-medium text-ink/40 mb-1.5 tracking-wider">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ request('tanggal_mulai') }}" class="input-field">
        </div>
        <div>
            <label class="block font-mono text-[0.6875rem] font-medium text-ink/40 mb-1.5 tracking-wider">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="input-field">
        </div>
        <div>
            <label class="block font-mono text-[0.6875rem] font-medium text-ink/40 mb-1.5 tracking-wider">Kategori</label>
            <select name="kategori" id="kategori" class="select-field">
                <option value="">Semua</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-mono text-[0.6875rem] font-medium text-ink/40 mb-1.5 tracking-wider">Cari</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" class="input-field" placeholder="Cari sesi...">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="btn-primary text-sm">Filter</button>
            @if(request()->anyFilled(['tanggal_mulai', 'tanggal_akhir', 'kategori', 'search']))
                <a href="{{ route('admin.chatbot-log.index') }}" class="btn-ghost text-sm">Reset</a>
            @endif
        </div>
    </form>
</div>

<div class="card-glass p-6">
    <div class="flex items-center justify-between mb-4">
        <p class="text-xs text-ink/40 font-mono tracking-wide">
            {{ $logs->firstItem() ?? 0 }}–{{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }}
        </p>
        <a href="{{ route('admin.chatbot-log.export', request()->query()) }}" class="btn-primary text-sm group">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Export CSV
        </a>
    </div>

    <div class="overflow-x-auto -mx-6">
        <div class="inline-block min-w-full align-middle px-6">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-ink/10">
                        <th class="py-3.5 pr-4 font-semibold text-leaf-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">No</th>
                        <th class="py-3.5 px-4 font-semibold text-leaf-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Sesi ID</th>
                        <th class="py-3.5 px-4 font-semibold text-leaf-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Kategori</th>
                        <th class="py-3.5 px-4 font-semibold text-leaf-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Jarak</th>
                        <th class="py-3.5 px-4 font-semibold text-leaf-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Anggaran</th>
                        <th class="py-3.5 px-4 font-semibold text-leaf-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Hasil</th>
                        <th class="py-3.5 pl-4 font-semibold text-leaf-700 font-mono text-[0.6875rem] tracking-wider whitespace-nowrap">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr class="border-b border-ink/5 hover:bg-leaf-600/5 transition-colors duration-200">
                            <td class="py-3.5 pr-4 text-ink/40 font-mono text-[0.75rem] whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="py-3.5 px-4 font-mono text-[0.75rem] text-ink/40 whitespace-nowrap">{{ $log->sesi_id }}</td>
                            <td class="py-3.5 px-4 text-leaf-700 whitespace-nowrap">{{ $log->kategori?->nama_kategori ?? '-' }}</td>
                            <td class="py-3.5 px-4 text-ink/40 font-mono text-[0.75rem] whitespace-nowrap">{{ $log->jarak_pilihan ?? '-' }}</td>
                            <td class="py-3.5 px-4 text-ink/40 font-mono text-[0.75rem] whitespace-nowrap">{{ $log->anggaran_pilihan ?? '-' }}</td>
                            <td class="py-3.5 px-4 font-mono text-[0.75rem] text-ink/50 whitespace-nowrap">{{ $log->jumlah_hasil }}</td>
                            <td class="py-3.5 pl-4 text-ink/40 font-mono text-[0.75rem] whitespace-nowrap">{{ \Carbon\Carbon::parse($log->dibuat_pada)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-20 text-center text-ink/50">
                                <div class="w-12 h-12 mx-auto mb-3 rounded-xl flex items-center justify-center" style="background: rgba(14, 29, 24, 0.05);">
                                    <svg class="w-6 h-6 text-ink/25" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                </div>
                                <p class="font-display font-semibold text-leaf-600">Belum ada riwayat pencarian</p>
                                <p class="text-sm text-ink/30 mt-1">Pengguna belum menggunakan fitur rekomendasi</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 pt-4 border-t border-ink/5">
        {{ $logs->appends(request()->query())->links() }}
    </div>
</div>
@endsection
