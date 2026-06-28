@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-10">
    <span class="text-xs font-mono font-medium tracking-widest uppercase" style="color: rgba(201, 168, 76, 0.6);">Admin</span>
    <h1 class="text-2xl font-display font-semibold text-forest-800 mt-1.5 tracking-tight">Dashboard</h1>
    <p class="text-forest-700/40 mt-1">Selamat datang di panel admin</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    @foreach([
        ['label' => 'Total Destinasi', 'value' => $totalDestinasi, 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
        ['label' => 'Total Kategori', 'value' => $totalKategori, 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
        ['label' => 'Total Galeri', 'value' => $totalGaleri, 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['label' => 'Pencarian Chatbot', 'value' => $totalChatbot, 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
    ] as $stat)
    <div class="card-glass p-5 flex items-center space-x-4 group cursor-default transition-all duration-300 hover:shadow-warm-lg hover:scale-[1.01]">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-300 group-hover:scale-110 group-hover:bg-forest-600/10" style="background: rgba(45, 74, 62, 0.06);">
            <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/></svg>
        </div>
        <div>
            <p class="text-2xl font-display font-semibold text-forest-800">{{ $stat['value'] }}</p>
            <p class="text-xs text-forest-700/40 font-medium tracking-wide">{{ $stat['label'] }}</p>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-10">
    <h2 class="text-lg font-display font-semibold text-forest-800 mb-5 tracking-tight">Akses Cepat</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach([
            ['route' => 'admin.destinasi.index', 'label' => 'Kelola Destinasi', 'desc' => 'Tambah, edit, hapus destinasi', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
            ['route' => 'admin.kategori.index', 'label' => 'Kelola Kategori', 'desc' => 'Atur kategori destinasi', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
            ['route' => 'admin.chatbot-log.index', 'label' => 'Lihat Chatbot Log', 'desc' => 'Analisis preferensi wisatawan', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
            ['route' => 'admin.destinasi.create', 'label' => 'Tambah Destinasi Baru', 'desc' => 'Lengkapi data destinasi wisata', 'icon' => 'M12 4v16m8-8H4'],
        ] as $link)
        @php $dashed = $loop->last; @endphp
        <a href="{{ route($link['route']) }}"
           class="card-glass p-5 flex items-center gap-4 group transition-all duration-300 hover:shadow-warm-lg hover:scale-[1.01] {{ $dashed ? 'border-dashed' : '' }}"
           @if($dashed) style="border-style: dashed; border-color: rgba(45, 74, 62, 0.15);" @endif>
            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-300 group-hover:scale-110 group-hover:bg-forest-600/10" style="background: rgba(45, 74, 62, 0.06);">
                <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-medium text-forest-700 text-sm group-hover:text-forest-600 transition-colors truncate">{{ $link['label'] }}</p>
                <p class="text-xs text-forest-700/40 mt-0.5 truncate">{{ $link['desc'] }}</p>
            </div>
            <svg class="w-4 h-4 text-forest-700/25 group-hover:text-forest-600 group-hover:translate-x-0.5 transition-all duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
        @endforeach
    </div>
</div>
@endsection
