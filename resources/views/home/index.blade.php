@extends('layouts.main')

@section('title', 'Beranda')
@section('meta_description', 'Jelajahi keindahan alam Malang. Temukan destinasi wisata alam terbaik di Malang Raya bersama Wisata Alam Malang.')

@push('styles')
<style>
    .hero-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #0E1D18;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse at 20% 50%, rgba(45, 74, 62, 0.6) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 20%, rgba(201, 168, 76, 0.08) 0%, transparent 40%),
            linear-gradient(to bottom, rgba(14, 29, 24, 0.3) 0%, rgba(14, 29, 24, 0.6) 50%, rgba(14, 29, 24, 0.95) 100%);
        z-index: 1;
    }
    .hero-bg-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        filter: saturate(0.85) brightness(0.7);
    }
    .hero-content {
        position: relative;
        z-index: 2;
    }
    .hero-scroll-indicator {
        position: absolute;
        bottom: 2.5rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
        animation: float 3s ease-in-out infinite;
    }
    .stat-divider {
        width: 1px;
        height: 3rem;
        background: rgba(45, 74, 62, 0.12);
    }
    .category-card {
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .category-card:hover {
        transform: translateY(-6px) scale(1.02);
    }
    .destination-card {
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .destination-card:hover {
        transform: translateY(-8px) rotate(-0.5deg);
    }
    .cta-section {
        position: relative;
        background: #0E1D18;
        overflow: hidden;
    }
    .cta-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse at 30% 50%, rgba(45, 74, 62, 0.5) 0%, transparent 50%),
            radial-gradient(ellipse at 70% 50%, rgba(201, 168, 76, 0.05) 0%, transparent 50%);
        z-index: 1;
    }
</style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="hero-section">
        <img src="{{ asset('images/hero-bg.jpg') }}"
             alt="Keindahan Alam Malang"
             class="hero-bg-img"
             onerror="this.style.display='none'">
        <div class="hero-content w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-40">
                <div class="max-w-3xl">
                    <div class="reveal-fade">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-medium tracking-wider uppercase mb-6"
                              style="background: rgba(201, 168, 76, 0.15); color: #C9A84C; border: 1px solid rgba(201, 168, 76, 0.2);">
                            Jelajahi Keindahan
                        </span>
                    </div>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-bold text-white leading-[1.08] tracking-tight mb-6 reveal" style="transition-delay: 0.1s">
                        Alam Malang<br>
                        <span class="text-gold-500" style="text-shadow: 0 0 30px rgba(201, 168, 76, 0.15);">Menantimu</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-cream-50/70 leading-relaxed mb-10 max-w-xl reveal" style="transition-delay: 0.2s">
                        Temukan berbagai destinasi wisata alam terbaik di Malang Raya. Dari pegunungan yang menakjubkan hingga air terjun yang mempesona.
                    </p>
                    <div class="flex flex-wrap gap-4 reveal" style="transition-delay: 0.3s">
                        <a href="{{ route('destinasi.index') }}"
                           class="btn-solid group text-base">
                            Jelajahi Destinasi
                            <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                        <a href="{{ route('chatbot.index') }}"
                           class="btn-white group text-base">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                            Dapatkan Rekomendasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-scroll-indicator">
            <svg class="w-6 h-6 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="relative py-20 lg:py-24 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-8 sm:gap-16 reveal">
                <div class="text-center">
                    <p class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-forest-600 tracking-tight">{{ $totalDestinasi }}</p>
                    <div class="w-8 h-[2px] bg-gold-500/60 mx-auto mt-2 mb-2"></div>
                    <p class="text-sm font-medium text-forest-700/60 tracking-wide uppercase">Destinasi Wisata</p>
                </div>
                <div class="stat-divider hidden sm:block"></div>
                <div class="text-center">
                    <p class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-forest-600 tracking-tight">{{ $totalKategori }}</p>
                    <div class="w-8 h-[2px] bg-gold-500/60 mx-auto mt-2 mb-2"></div>
                    <p class="text-sm font-medium text-forest-700/60 tracking-wide uppercase">Kategori Wisata</p>
                </div>
                <div class="stat-divider hidden sm:block"></div>
                <div class="text-center">
                    <p class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-forest-600 tracking-tight">4.8</p>
                    <div class="w-8 h-[2px] bg-gold-500/60 mx-auto mt-2 mb-2"></div>
                    <p class="text-sm font-medium text-forest-700/60 tracking-wide uppercase">Rating Pengunjung</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori Populer Section --}}
    @if(isset($kategoriPopuler) && $kategoriPopuler->count())
    <section class="relative py-20 lg:py-24 bg-cream-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-14 reveal">
                <div>
                    <span class="text-xs font-medium tracking-widest uppercase text-forest-700/40">Kategori</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-forest-800 mt-2 tracking-tight">Jelajahi Berdasarkan<br><span class="text-forest-600">Minatmu</span></h2>
                </div>
                <p class="text-forest-700/50 mt-2 sm:mt-0 max-w-sm leading-relaxed">Temukan destinasi berdasarkan kategori yang kamu sukai</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
                @foreach($kategoriPopuler as $kategori)
                <a href="{{ route('destinasi.index', ['kategori' => $kategori->slug ?? $kategori->id_kategori]) }}"
                   class="category-card group relative flex flex-col items-center p-6 sm:p-8 rounded-2xl text-center overflow-hidden"
                   style="background: rgba(45, 74, 62, 0.03); border: 1px solid rgba(45, 74, 62, 0.06);">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4 text-2xl transition-all duration-300 group-hover:scale-110"
                         style="background: rgba(45, 74, 62, 0.06);">
                        {!! $kategori->icon ?? '
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>' !!}
                    </div>
                    <h3 class="font-display font-semibold text-forest-700 text-sm group-hover:text-forest-600 transition-colors">
                        {{ $kategori->nama_kategori }}
                    </h3>
                    <p class="text-xs text-forest-700/40 mt-1">{{ $kategori->jumlah_destinasi ?? $kategori->destinasi_count ?? 0 }} destinasi</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Destinasi Populer Section --}}
    @if(isset($destinasiPopuler) && $destinasiPopuler->count())
    <section class="relative py-20 lg:py-24 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-14 reveal">
                <div>
                    <span class="text-xs font-medium tracking-widest uppercase text-forest-700/40">Destinasi</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-forest-800 mt-2 tracking-tight">Paling<br><span class="text-forest-600">Populer</span></h2>
                </div>
                <a href="{{ route('destinasi.index') }}" class="group inline-flex items-center text-sm font-medium text-forest-600 mt-2 sm:mt-0 hover:text-forest-700 transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4 ml-1.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
            <div class="masonry-grid">
                @foreach($destinasiPopuler as $item)
                <div class="destination-card card-elevated group" style="animation-delay: {{ $loop->index * 0.05 }}s">
                    <div class="relative overflow-hidden aspect-[4/3]">
                        <img src="{{ $item->foto_url }}"
                             alt="{{ $item->nama }}"
                             class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
                             loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-forest-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        @if($item->kategori)
                        <span class="absolute top-4 left-4 px-3 py-1 text-xs font-medium rounded-full backdrop-blur-sm"
                              style="background: rgba(45, 74, 62, 0.15); color: #F5F0E8; border: 1px solid rgba(245, 240, 232, 0.15);">
                            {{ $item->kategori->nama_kategori }}
                        </span>
                        @endif
                        @if($item->buka_24jam)
                        <span class="absolute top-4 right-4 px-3 py-1 text-xs font-medium rounded-full backdrop-blur-sm"
                              style="background: rgba(201, 168, 76, 0.2); color: #C9A84C; border: 1px solid rgba(201, 168, 76, 0.2);">
                            Buka 24 Jam
                        </span>
                        @endif
                    </div>
                    <div class="p-5 sm:p-6">
                        <h3 class="font-display font-bold text-lg text-forest-800 mb-3 group-hover:text-forest-600 transition-colors duration-300">
                            {{ $item->nama }}
                        </h3>
                        <div class="space-y-2.5 text-sm text-forest-700/60">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2.5 text-forest-700/30 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $item->lokasi }}
                            </div>
                            <div class="flex items-center justify-between pt-1">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-forest-700/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                    {{ $item->formatted_jarak ?? ($item->jarak_km ? $item->jarak_km . ' km' : '-') }}
                                </span>
                                <span class="font-semibold text-forest-600">
                                    {{ $item->formatted_harga ?? 'Gratis' }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('destinasi.show', $item->nama) }}"
                           class="group/btn mt-5 w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-300"
                           style="border: 1px solid rgba(45, 74, 62, 0.12); color: #2D4A3E;">
                            Lihat Detail
                            <svg class="w-4 h-4 ml-1.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    <section class="cta-section py-24 lg:py-32">
        <div class="relative z-10 max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="reveal">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-medium tracking-wider uppercase mb-6"
                      style="background: rgba(201, 168, 76, 0.12); color: #C9A84C; border: 1px solid rgba(201, 168, 76, 0.15);">
                    Mulai Petualanganmu
                </span>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-white leading-tight mb-4 reveal" style="transition-delay: 0.1s">
                Siap Menjelajahi<br>
                <span class="text-gold-500">Keindahan Alam Malang?</span>
            </h2>
            <p class="text-lg text-cream-50/60 mb-10 max-w-xl mx-auto reveal" style="transition-delay: 0.2s">
                Temukan destinasi wisata alam yang sesuai dengan keinginanmu. Dapatkan rekomendasi destinasi terbaik hanya dalam beberapa klik.
            </p>
            <div class="flex flex-wrap justify-center gap-4 reveal" style="transition-delay: 0.3s">
                <a href="{{ route('destinasi.index') }}"
                   class="btn-solid group text-base">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Lihat Destinasi
                </a>
                <a href="{{ route('chatbot.index') }}"
                   class="btn-white group text-base">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Dapatkan Rekomendasi
                </a>
            </div>
        </div>
    </section>
@endsection
