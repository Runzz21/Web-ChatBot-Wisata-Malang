@extends('layouts.admin')

@section('title', 'Riwayat Pencarian Chatbot')

@section('content')
<div class="mb-8">
    <span class="label-mono text-accent mb-2 block">CHATBOT</span>
    <h1 class="text-2xl font-display font-semibold text-primary-800">Riwayat Pencarian Chatbot</h1>
    <p class="text-[#5A6B55] mt-1">Lihat riwayat pencarian pengguna melalui Kang Lereng</p>
</div>

<div class="card p-6 mb-6">
    <form action="{{ route('admin.chatbot-log.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-end">
        <div>
            <label for="tanggal_mulai" class="block font-mono text-[0.6875rem] font-medium text-[#5A6B55] mb-1 tracking-wide">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                   class="input-field">
        </div>
        <div>
            <label for="tanggal_akhir" class="block font-mono text-[0.6875rem] font-medium text-[#5A6B55] mb-1 tracking-wide">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                   class="input-field">
        </div>
        <div>
            <label for="kategori" class="block font-mono text-[0.6875rem] font-medium text-[#5A6B55] mb-1 tracking-wide">Kategori</label>
            <select name="kategori" id="kategori" class="select-field">
                <option value="">Semua</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="search" class="block font-mono text-[0.6875rem] font-medium text-[#5A6B55] mb-1 tracking-wide">Cari</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                   class="input-field" placeholder="Cari sesi...">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="btn-primary text-sm">Filter</button>
            @if(request()->anyFilled(['tanggal_mulai', 'tanggal_akhir', 'kategori', 'search']))
                <a href="{{ route('admin.chatbot-log.index') }}" class="btn-secondary text-sm">Reset</a>
            @endif
        </div>
    </form>
</div>

<div class="card p-6">
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-[#5A6B55] font-mono tracking-wide">
            {{ $logs->firstItem() ?? 0 }}–{{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }}
        </p>
        <a href="{{ route('admin.chatbot-log.export', request()->query()) }}" class="inline-flex items-center px-4 py-2 bg-accent text-white text-sm font-medium rounded-xl hover:bg-accent/90 transition-colors shadow-lereng-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Export CSV
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b border-primary-200">
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">No</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Sesi ID</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Kategori</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Jarak</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Anggaran</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Hasil</th>
                    <th class="py-3 px-4 font-semibold text-primary-800 font-mono text-[0.6875rem] tracking-wider">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr class="border-b border-primary-100 hover:bg-primary-50/50 transition-colors even:bg-black/[0.015]">
                        <td class="py-3.5 px-4 text-[#5A6B55] font-mono text-[0.75rem]">{{ $loop->iteration }}</td>
                        <td class="py-3.5 px-4 font-mono text-[0.75rem] text-[#5A6B55]">{{ $log->sesi_id }}</td>
                        <td class="py-3.5 px-4 text-primary-800">{{ $log->kategori?->nama_kategori ?? '-' }}</td>
                        <td class="py-3.5 px-4 text-[#5A6B55] font-mono text-[0.75rem]">{{ $log->jarak_pilihan ?? '-' }}</td>
                        <td class="py-3.5 px-4 text-[#5A6B55] font-mono text-[0.75rem]">{{ $log->anggaran_pilihan ?? '-' }}</td>
                        <td class="py-3.5 px-4 font-mono text-[0.75rem] text-[#5A6B55]">{{ $log->jumlah_hasil }}</td>
                        <td class="py-3.5 px-4 text-[#5A6B55] font-mono text-[0.75rem] whitespace-nowrap">{{ \Carbon\Carbon::parse($log->dibuat_pada)->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-[#5A6B55]">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-primary-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#5A6B55]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                            </div>
                            Belum ada riwayat pencarian.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $logs->appends(request()->query())->links() }}
    </div>
</div>
@endsection
