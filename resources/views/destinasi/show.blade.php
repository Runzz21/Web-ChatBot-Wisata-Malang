@extends('layouts.main')

@section('title', $destinasi->nama)
@section('meta_description', Str::limit(strip_tags($destinasi->deskripsi), 160))
@section('og_title', $destinasi->nama)
@section('og_description', Str::limit(strip_tags($destinasi->deskripsi), 160))
@section('og_image', $destinasi->foto_url)

@push('styles')
<style>
    .banner-gradient {
        background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.1) 100%);
    }
</style>
@endpush

@section('content')
    {{-- Banner --}}
    <section class="relative h-[400px] overflow-hidden">
        <img src="{{ $destinasi->foto_url }}"
             alt="{{ $destinasi->nama }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 banner-gradient"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-10 lg:p-16">
            <div class="max-w-7xl mx-auto">
                @if($destinasi->kategori)
                <span class="inline-block px-4 py-1.5 text-sm font-semibold rounded-full text-white shadow mb-4"
                      style="background-color: {{ $destinasi->kategori->warna_badge ?? '#059669' }}">
                    {{ $destinasi->kategori->nama_kategori }}
                </span>
                @endif
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-white">{{ $destinasi->nama }}</h1>
                <div class="flex flex-wrap items-center gap-4 mt-3 text-white/80 text-sm">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $destinasi->lokasi }}
                    </span>
                    @if($destinasi->buka_24jam)
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Buka 24 Jam
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-10 lg:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- Info Cards --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @if($destinasi->ketinggian_mdpl)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center">
                            <svg class="w-6 h-6 text-primary-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            <p class="text-lg font-display font-bold text-gray-900">{{ number_format($destinasi->ketinggian_mdpl, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500">MDPL</p>
                        </div>
                        @endif
                        @if($destinasi->jarak_km)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center">
                            <svg class="w-6 h-6 text-primary-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            <p class="text-lg font-display font-bold text-gray-900">{{ $destinasi->formatted_jarak ?? ($destinasi->jarak_km . ' km') }}</p>
                            <p class="text-xs text-gray-500">Jarak</p>
                        </div>
                        @endif
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center">
                            <svg class="w-6 h-6 text-primary-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-lg font-display font-bold text-gray-900">{{ $destinasi->formatted_harga ?? 'Gratis' }}</p>
                            <p class="text-xs text-gray-500">Harga Tiket</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center">
                            <svg class="w-6 h-6 text-primary-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-lg font-display font-bold text-gray-900">
                                @if($destinasi->buka_24jam)
                                    <span class="text-green-600">24 Jam</span>
                                @elseif($destinasi->jam_buka && $destinasi->jam_tutup)
                                    {{ \Carbon\Carbon::parse($destinasi->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($destinasi->jam_tutup)->format('H:i') }}
                                @else
                                    -
                                @endif
                            </p>
                            <p class="text-xs text-gray-500">Jam Operasional</p>
                        </div>
                    </div>

                    {{-- Status Buka --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 rounded-full {{ $destinasi->status_buka === 'Buka' || $destinasi->status_buka === 'Buka 24 Jam' ? 'bg-green-500' : 'bg-red-500' }} animate-pulse"></div>
                            <span class="font-semibold text-gray-900">
                                {{ $destinasi->status_buka === 'Buka' || $destinasi->status_buka === 'Buka 24 Jam' ? 'Sedang Buka' : 'Sedang Tutup' }}
                            </span>
                            @if(!$destinasi->buka_24jam && $destinasi->jam_buka && $destinasi->jam_tutup)
                            <span class="text-sm text-gray-500">
                                ({{ \Carbon\Carbon::parse($destinasi->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($destinasi->jam_tutup)->format('H:i') }})
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h2 class="text-xl font-display font-bold text-gray-900 mb-4">Deskripsi</h2>
                        <div class="prose prose-gray max-w-none">
                            {!! nl2br(e($destinasi->deskripsi)) !!}
                        </div>
                    </div>

                    {{-- Fasilitas --}}
                    @if($destinasi->fasilitas_array && count($destinasi->fasilitas_array))
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h2 class="text-xl font-display font-bold text-gray-900 mb-4">Fasilitas</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($destinasi->fasilitas_array as $fasilitas)
                            <span class="inline-flex items-center px-4 py-2 bg-primary-50 text-primary-700 rounded-xl text-sm font-medium">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ $fasilitas }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Galeri --}}
                    @if($destinasi->galeri && count($destinasi->galeri))
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h2 class="text-xl font-display font-bold text-gray-900 mb-4">Galeri</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach($destinasi->galeri as $foto)
                            <a href="{{ $foto->foto_url ?? $foto }}" target="_blank"
                               class="block aspect-[4/3] rounded-xl overflow-hidden group">
                                <img src="{{ $foto->foto_url ?? $foto }}" alt="Galeri {{ $destinasi->nama }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     loading="lazy">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    {{-- Lokasi Map Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-display font-semibold text-gray-900 mb-3">Lokasi</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $destinasi->lokasi }}</p>
                        @if($destinasi->latitude && $destinasi->longitude)
                        <div class="aspect-[16/9] rounded-xl bg-gray-200 overflow-hidden">
                            <iframe
                                src="https://www.google.com/maps?q={{ $destinasi->latitude }},{{ $destinasi->longitude }}&hl=id&z=15&output=embed"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        @endif
                        @if($destinasi->latitude && $destinasi->longitude)
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $destinasi->latitude }},{{ $destinasi->longitude }}"
                           target="_blank"
                           class="mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 bg-primary-600 text-white text-sm font-semibold rounded-xl hover:bg-primary-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Buka Google Maps
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Rekomendasi Destinasi Serupa --}}
    @if(isset($rekomendasi) && $rekomendasi->count())
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl font-display font-bold text-gray-900 mb-8">Destinasi Serupa</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($rekomendasi as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="relative overflow-hidden aspect-[4/3]">
                        <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             loading="lazy">
                        @if($item->kategori)
                        <span class="absolute top-3 left-3 px-3 py-1 text-xs font-semibold rounded-full text-white shadow"
                              style="background-color: {{ $item->kategori->warna_badge ?? '#059669' }}">
                            {{ $item->kategori->nama_kategori }}
                        </span>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-display font-bold text-lg text-gray-900 mb-2 group-hover:text-primary-600 transition-colors">
                            {{ $item->nama }}
                        </h3>
                        <div class="space-y-2 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $item->lokasi }}
                            </div>
                            <div class="flex items-center justify-between">
                                <span>{{ $item->formatted_jarak ?? ($item->jarak_km ? $item->jarak_km . ' km' : '-') }}</span>
                                <span class="font-semibold text-primary-600">{{ $item->formatted_harga ?? 'Gratis' }}</span>
                            </div>
                        </div>
                        <a href="{{ route('destinasi.show', $item->nama) }}"
                           class="mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 bg-primary-600 text-white text-sm font-semibold rounded-xl hover:bg-primary-700 transition-colors">
                            Lihat Detail
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
