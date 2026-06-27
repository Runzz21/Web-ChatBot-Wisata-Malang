@extends('layouts.main')

@section('title', 'Beranda')
@section('meta_description', 'Jelajahi keindahan alam Malang. Temukan destinasi wisata alam terbaik di Malang Raya bersama Wisata Alam Malang.')

@push('styles')
<style>
    .hero-gradient {
        background: linear-gradient(135deg, #064E3B 0%, #059669 50%, #10B981 100%);
    }
    .hero-waves {
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
    }
</style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="hero-gradient relative overflow-hidden min-h-[85vh] flex items-center">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-emerald-200 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="max-w-3xl">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-white leading-tight mb-6">
                    Jelajahi Keindahan Alam Malang
                </h1>
                <p class="text-lg sm:text-xl text-emerald-100 leading-relaxed mb-10 max-w-2xl">
                    Temukan berbagai destinasi wisata alam terbaik di Malang Raya. Dari pegunungan yang menakjubkan hingga air terjun yang mempesona, semuanya ada di sini.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('destinasi.index') }}"
                       class="inline-flex items-center px-8 py-4 bg-white text-primary-700 font-semibold rounded-xl shadow-lg hover:shadow-xl hover:bg-emerald-50 transition-all duration-300">
                        Jelajahi Destinasi
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                    <a href="{{ route('chatbot.index') }}"
                       class="inline-flex items-center px-8 py-4 border-2 border-emerald-300 text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        Dapatkan Rekomendasi
                    </a>
                </div>
            </div>
        </div>

        <div class="hero-waves">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 60L60 70C120 80 240 100 360 100C480 100 600 80 720 65C840 50 960 40 1080 45C1200 50 1320 70 1380 80L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V60Z" fill="#F9FAFB"/>
            </svg>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <p class="text-4xl font-display font-bold text-gray-900">{{ $totalDestinasi }}</p>
                    <p class="text-gray-500 mt-2">Destinasi Wisata</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                    <p class="text-4xl font-display font-bold text-gray-900">{{ $totalKategori }}</p>
                    <p class="text-gray-500 mt-2">Kategori Wisata</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori Populer Section --}}
    @if(isset($kategoriPopuler) && $kategoriPopuler->count())
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-display font-bold text-gray-900">Kategori Populer</h2>
                <p class="text-gray-500 mt-3 max-w-xl mx-auto">Temukan destinasi berdasarkan kategori yang kamu sukai</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($kategoriPopuler as $kategori)
                <a href="{{ route('destinasi.index', ['kategori' => $kategori->slug ?? $kategori->id]) }}"
                   class="group bg-gray-50 rounded-2xl p-6 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-transparent hover:border-{{ $kategori->warna_badge ?? 'primary' }}-200">
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center text-2xl">
                        {!! $kategori->icon ?? '<svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>' !!}
                    </div>
                    <h3 class="font-display font-semibold text-gray-900 group-hover:text-{{ $kategori->warna_badge ?? 'primary' }}-600 transition-colors">
                        {{ $kategori->nama_kategori }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $kategori->jumlah_destinasi }} destinasi</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Destinasi Populer Section --}}
    @if(isset($destinasiPopuler) && $destinasiPopuler->count())
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-display font-bold text-gray-900">Destinasi Populer</h2>
                    <p class="text-gray-500 mt-3">Destinasi wisata alam yang paling banyak dikunjungi</p>
                </div>
                <a href="{{ route('destinasi.index') }}" class="mt-4 sm:mt-0 inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($destinasiPopuler as $item)
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
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                    {{ $item->formatted_jarak ?? ($item->jarak_km ? $item->jarak_km . ' km' : '-') }}
                                </span>
                                <span class="font-semibold text-primary-600">
                                    {{ $item->formatted_harga ?? 'Gratis' }}
                                </span>
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

    {{-- CTA Section --}}
    <section class="hero-gradient relative overflow-hidden py-20">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-emerald-200 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-display font-bold text-white mb-4">
                Siap Menjelajahi Keindahan Alam Malang?
            </h2>
            <p class="text-lg text-emerald-100 mb-8 max-w-2xl mx-auto">
                Temukan destinasi wisata alam yang sesuai dengan keinginanmu. Dapatkan rekomendasi destinasi terbaik hanya dalam beberapa klik.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('destinasi.index') }}"
                   class="inline-flex items-center px-8 py-4 bg-white text-primary-700 font-semibold rounded-xl shadow-lg hover:shadow-xl hover:bg-emerald-50 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Lihat Destinasi
                </a>
                <a href="{{ route('chatbot.index') }}"
                   class="inline-flex items-center px-8 py-4 border-2 border-emerald-300 text-white font-semibold rounded-xl hover:bg-white/10 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Dapatkan Rekomendasi
                </a>
            </div>
        </div>
    </section>
@endsection
