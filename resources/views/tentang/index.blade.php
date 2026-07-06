@extends('layouts.main')

@section('title', 'Tentang')
@section('meta_description', 'Pelajari lebih lanjut tentang Wisata Alam Malang, platform informasi wisata alam terbaik di Malang Raya.')

@section('content')
    {{-- Hero --}}
    <section class="relative pt-32 pb-20 lg:pb-28 overflow-hidden" style="background: #0E1D18;">
        <div class="absolute inset-0" style="background: radial-gradient(ellipse at 30% 50%, rgba(45, 74, 62, 0.4) 0%, transparent 60%), radial-gradient(ellipse at 70% 50%, rgba(201, 168, 76, 0.05) 0%, transparent 40%);"></div>
        <div class="relative z-10 max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-medium tracking-wider uppercase mb-6"
                  style="background: rgba(201, 168, 76, 0.12); color: #C9A84C; border: 1px solid rgba(201, 168, 76, 0.15);">
                Tentang Kami
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-white leading-tight tracking-tight mb-6">
                Tentang Wisata Alam Malang
            </h1>
            <p class="text-lg sm:text-xl text-white/60 leading-relaxed max-w-2xl mx-auto">
                Platform informasi wisata alam terpercaya yang membantu kamu menemukan dan menjelajahi keindahan alam Malang Raya.
            </p>
        </div>
    </section>

    {{-- Visi & Misi --}}
    <section class="py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="reveal-left">
                    <span class="text-xs font-medium tracking-widest uppercase text-ink/40">Visi</span>
                    <h2 class="text-3xl sm:text-4xl font-display font-bold text-ink mt-3 mb-6 tracking-tight">Visi Kami</h2>
                    <p class="text-ink/60 leading-relaxed text-lg">
                        Menjadi platform informasi wisata alam terdepan di Indonesia yang memudahkan setiap orang untuk menemukan, menjelajahi, dan menikmati keindahan alam Malang Raya.
                    </p>
                </div>
                <div class="reveal-right p-8 lg:p-10 rounded-2xl" style="background: rgba(45, 74, 62, 0.03); border: 1px solid rgba(14, 29, 24, 0.06);">
                    <span class="text-xs font-medium tracking-widest uppercase text-ink/40">Misi</span>
                    <h2 class="text-3xl sm:text-4xl font-display font-bold text-ink mt-3 mb-8 tracking-tight">Misi Kami</h2>
                    <ul class="space-y-5">
                        @foreach([
                            'Menyediakan informasi lengkap dan akurat tentang destinasi wisata alam di Malang Raya.',
                            'Membantu wisatawan menemukan destinasi yang sesuai dengan preferensi dan kebutuhan mereka.',
                            'Mempromosikan keindahan dan kekayaan alam Malang Raya kepada wisatawan lokal maupun mancanegara.',
                            'Mendukung pengembangan wisata alam yang berkelanjutan dan ramah lingkungan.',
                        ] as $i => $misi)
                        <li class="flex items-start space-x-4 group">
                            <span class="flex-shrink-0 w-8 h-8 rounded-xl flex items-center justify-center text-sm font-bold transition-all duration-300 group-hover:scale-105"
                                  style="background: rgba(45, 74, 62, 0.08); color: #2D4A3E;">
                                {{ $i + 1 }}
                            </span>
                            <span class="text-ink/60 pt-1">{{ $misi }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Description --}}
    <section class="py-16 lg:py-20 bg-canvas-alt">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center reveal">
                <span class="text-xs font-medium tracking-widest uppercase text-ink/40">Tentang</span>
                <h2 class="text-3xl sm:text-4xl font-display font-bold text-ink mt-3 mb-8 tracking-tight">Apa Itu Wisata Alam Malang?</h2>
                <div class="text-ink/60 leading-relaxed space-y-5 text-lg">
                    <p>
                        Wisata Alam Malang adalah platform informasi wisata alam yang menyediakan data lengkap tentang berbagai destinasi wisata alam di Malang Raya. Mulai dari gunung, air terjun, pantai, hingga pemandian air panas, semua bisa kamu temukan di sini.
                    </p>
                    <p>
                        Kami menyajikan informasi detail seperti lokasi, harga tiket masuk, jarak tempuh, fasilitas yang tersedia, jam operasional, dan galeri foto untuk setiap destinasi. Dengan sistem rekomendasi cerdas kami, kamu bisa dengan mudah menemukan destinasi wisata yang sesuai dengan keinginanmu.
                    </p>
                    <p>
                        Dibangun dengan semangat untuk mempromosikan keindahan alam Malang Raya, kami berkomitmen untuk terus memperbarui dan menambah informasi destinasi wisata agar kamu selalu mendapatkan informasi terbaru dan terpercaya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Statistik --}}
    <section class="py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-8 sm:gap-16 reveal">
                <div class="text-center">
                    <p data-counter="{{ $totalDestinasi ?? '0' }}" class="counter-value">{{ $totalDestinasi ?? '0' }}+</p>
                    <div class="w-8 h-[2px] bg-gold-500/60 mx-auto mt-2 mb-2"></div>
                    <p class="text-sm font-medium text-ink/60 tracking-wide uppercase">Destinasi Wisata</p>
                </div>
                <div class="w-px h-12 bg-ink/10 hidden sm:block"></div>
                <div class="text-center">
                    <p data-counter="{{ $totalKategori ?? '0' }}" class="counter-value">{{ $totalKategori ?? '0' }}+</p>
                    <div class="w-8 h-[2px] bg-gold-500/60 mx-auto mt-2 mb-2"></div>
                    <p class="text-sm font-medium text-ink/60 tracking-wide uppercase">Kategori Wisata</p>
                </div>
                <div class="w-px h-12 bg-ink/10 hidden sm:block"></div>
                <div class="text-center">
                    <p class="counter-value">{{ $totalKunjungan ?? '0' }}+</p>
                    <div class="w-8 h-[2px] bg-gold-500/60 mx-auto mt-2 mb-2"></div>
                    <p class="text-sm font-medium text-ink/60 tracking-wide uppercase">Kunjungan</p>
                </div>
            </div>
        </div>
    </section>
@endsection
