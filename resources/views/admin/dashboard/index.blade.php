@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-display font-bold text-ink tracking-tight">Dashboard</h1>
        <p class="text-ink/50 text-sm mt-1">Selamat datang kembali, {{ session('admin_username') }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
        @php
            $stats = [
                ['label' => 'Total Destinasi', 'value' => $totalDestinasi ?? 0, 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'color' => 'from-leaf-600 to-leaf-800'],
                ['label' => 'Total Kategori', 'value' => $totalKategori ?? 0, 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z', 'color' => 'from-gold-500 to-yellow-700'],
                ['label' => 'Total Foto Galeri', 'value' => $totalGaleri ?? 0, 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'from-moss to-leaf-700'],
                ['label' => 'Total Chat', 'value' => $totalChat ?? 0, 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z', 'color' => 'from-bark to-amber-900'],
            ];
        @endphp
        @foreach($stats as $stat)
        <div class="card-glass p-6 reveal" style="transition-delay: {{ $loop->index * 0.05 }}s">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-medium tracking-widest uppercase text-ink/40">{{ $stat['label'] }}</span>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(45, 74, 62, 0.08);">
                    <svg class="w-5 h-5 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/></svg>
                </div>
            </div>
            <p class="text-3xl font-display font-bold text-ink">{{ $stat['value'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
