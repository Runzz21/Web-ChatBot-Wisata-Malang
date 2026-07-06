@extends('layouts.main')

@section('title', $destinasi->nama)
@section('meta_description', Str::limit(strip_tags($destinasi->deskripsi), 160))
@section('og_title', $destinasi->nama)
@section('og_description', Str::limit(strip_tags($destinasi->deskripsi), 160))
@section('og_image', $destinasi->foto_url)

@push('styles')
<style>
    .detail-banner {
        position: relative;
        height: 60vh;
        min-height: 400px;
        overflow: hidden;
    }
    .detail-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .detail-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(14, 29, 24, 0.9) 0%,
            rgba(14, 29, 24, 0.4) 40%,
            rgba(14, 29, 24, 0.1) 70%,
            transparent 100%
        );
    }
    .info-stat {
        text-align: center;
        padding: 1.25rem;
        border-radius: 1rem;
        background: rgba(14, 29, 24, 0.03);
        border: 1px solid rgba(14, 29, 24, 0.06);
        transition: all 0.3s ease;
    }
    .info-stat:hover {
        background: rgba(14, 29, 24, 0.06);
        border-color: rgba(14, 29, 24, 0.1);
        transform: translateY(-2px);
    }
    .galeri-item {
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .galeri-item:hover {
        transform: scale(1.03);
    }
</style>
@endpush

@section('content')
    {{-- Banner --}}
    <section class="detail-banner">
        <img src="{{ $destinasi->foto_url }}"
             alt="{{ $destinasi->nama }}">
        <div class="detail-overlay"></div>
        <div class="absolute bottom-0 left-0 right-0 z-10 p-6 sm:p-10 lg:p-16">
            <div class="max-w-7xl mx-auto">
                <div class="max-w-3xl">
                    @if($destinasi->kategori)
                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full backdrop-blur-sm mb-4"
                          style="background: rgba(201, 168, 76, 0.15); color: #C9A84C; border: 1px solid rgba(201, 168, 76, 0.2);">
                        {{ $destinasi->kategori->nama_kategori }}
                    </span>
                    @endif
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-white leading-tight tracking-tight">{{ $destinasi->nama }}</h1>
                    <div class="flex flex-wrap items-center gap-4 mt-4 text-white/60 text-sm">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-gold-500/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $destinasi->lokasi }}
                        </span>
                        @if($destinasi->buka_24jam)
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-gold-500/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Buka 24 Jam
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-10">
                    {{-- Info Stats --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 reveal">
                        @if($destinasi->ketinggian_mdpl)
                        <div class="info-stat">
                            <svg class="w-5 h-5 text-leaf-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            <p class="text-xl font-display font-bold text-ink">{{ number_format($destinasi->ketinggian_mdpl, 0, ',', '.') }}</p>
                            <p class="text-[0.6875rem] text-ink/40 font-medium uppercase tracking-wider mt-0.5">MDPL</p>
                        </div>
                        @endif
                        @if($destinasi->jarak_km)
                        <div class="info-stat">
                            <svg class="w-5 h-5 text-leaf-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            <p class="text-xl font-display font-bold text-ink">{{ $destinasi->formatted_jarak ?? ($destinasi->jarak_km . ' km') }}</p>
                            <p class="text-[0.6875rem] text-ink/40 font-medium uppercase tracking-wider mt-0.5">Jarak</p>
                        </div>
                        @endif
                        <div class="info-stat">
                            <svg class="w-5 h-5 text-leaf-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-xl font-display font-bold text-ink">{{ $destinasi->formatted_harga ?? 'Gratis' }}</p>
                            <p class="text-[0.6875rem] text-ink/40 font-medium uppercase tracking-wider mt-0.5">Harga Tiket</p>
                        </div>
                        <div class="info-stat">
                            <svg class="w-5 h-5 text-leaf-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-xl font-display font-bold text-ink">
                                @if($destinasi->buka_24jam)
                                    24 Jam
                                @elseif($destinasi->jam_buka && $destinasi->jam_tutup)
                                    {{ \Carbon\Carbon::parse($destinasi->jam_buka)->format('H:i') }}
                                @else
                                    -
                                @endif
                            </p>
                            <p class="text-[0.6875rem] text-ink/40 font-medium uppercase tracking-wider mt-0.5">Jam Buka</p>
                        </div>
                    </div>

                    {{-- Status Buka --}}
                    <div class="card-glass p-5 reveal" style="transition-delay: 0.1s">
                        <div class="flex items-center space-x-3">
                            <div class="w-2.5 h-2.5 rounded-full {{ ($destinasi->status_buka === 'Buka' || $destinasi->status_buka === 'Buka 24 Jam') ? 'bg-green-500' : 'bg-red-400' }}"></div>
                            <span class="font-medium text-leaf-700">
                                {{ ($destinasi->status_buka === 'Buka' || $destinasi->status_buka === 'Buka 24 Jam') ? 'Sedang Buka' : 'Sedang Tutup' }}
                            </span>
                            @if(!$destinasi->buka_24jam && $destinasi->jam_buka && $destinasi->jam_tutup)
                            <span class="text-sm text-ink/40">
                                ({{ \Carbon\Carbon::parse($destinasi->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($destinasi->jam_tutup)->format('H:i') }})
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="reveal" style="transition-delay: 0.15s">
                        <h2 class="text-xl font-display font-bold text-ink mb-4">Deskripsi</h2>
                        <div class="prose prose-sm max-w-none text-ink/70 leading-relaxed">
                            {!! nl2br(e($destinasi->deskripsi)) !!}
                        </div>
                    </div>

                    {{-- Fasilitas --}}
                    @if($destinasi->fasilitas_array && count($destinasi->fasilitas_array))
                    <div class="reveal" style="transition-delay: 0.2s">
                        <h2 class="text-xl font-display font-bold text-ink mb-4">Fasilitas</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($destinasi->fasilitas_array as $fasilitas)
                            <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium"
                                  style="background: rgba(45, 74, 62, 0.06); color: #2D4A3E;">
                                <svg class="w-4 h-4 mr-1.5 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ $fasilitas }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Galeri --}}
                    @if($destinasi->galeri && count($destinasi->galeri))
                    <div class="reveal" style="transition-delay: 0.25s">
                        <h2 class="text-xl font-display font-bold text-ink mb-4">Galeri</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($destinasi->galeri as $foto)
                            <a href="{{ $foto->foto_url ?? $foto }}" target="_blank"
                               class="galeri-item block aspect-[4/3] rounded-xl overflow-hidden"
                               style="border: 1px solid rgba(14, 29, 24, 0.06);">
                                <img src="{{ $foto->foto_url ?? $foto }}" alt="Galeri {{ $destinasi->nama }}"
                                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                     loading="lazy">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    @php
                        $q = $destinasi->latitude && $destinasi->longitude
                            ? "{$destinasi->latitude},{$destinasi->longitude}"
                            : urlencode($destinasi->lokasi . ', Malang, Jawa Timur');
                        $mapsUrl = $destinasi->latitude && $destinasi->longitude
                            ? "https://www.google.com/maps/dir/?api=1&destination={$destinasi->latitude},{$destinasi->longitude}"
                            : "https://www.google.com/maps/search/" . urlencode($destinasi->lokasi . ', Malang, Jawa Timur');
                    @endphp
                    <div class="card-glass p-6 lg:sticky lg:top-28 reveal-right">
                        <h3 class="font-display font-semibold text-leaf-700 text-sm uppercase tracking-widest mb-3">Lokasi</h3>
                        <p class="text-sm text-ink/60 mb-4">{{ $destinasi->lokasi }}</p>
                        <div class="aspect-[16/9] rounded-xl overflow-hidden shadow-card" style="border: 1px solid rgba(14, 29, 24, 0.06);">
                            <iframe
                                src="https://www.google.com/maps?q={{ $q }}&hl=id&z=15&output=embed"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        <a href="{{ $mapsUrl }}"
                           target="_blank"
                           class="group/btn mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-300"
                           style="border: 1px solid rgba(14, 29, 24, 0.12); color: #2D4A3E;">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Buka Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Rekomendasi Destinasi Serupa --}}
    @if(isset($rekomendasi) && $rekomendasi->count())
    <section class="py-16 lg:py-20 bg-canvas-alt">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 reveal">
                <span class="text-xs font-medium tracking-widest uppercase text-ink/40">Rekomendasi</span>
                <h2 class="text-2xl sm:text-3xl font-display font-bold text-ink mt-2 tracking-tight">Destinasi Serupa</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($rekomendasi as $item)
                <div class="destination-card card-image group">
                    <div class="relative overflow-hidden aspect-[4/3]">
                        <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}"
                             class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
                             loading="lazy">
                        @if($item->kategori)
                        <span class="absolute top-3 left-3 px-2.5 py-1 text-[0.6875rem] font-medium rounded-full backdrop-blur-sm"
                              style="background: rgba(45, 74, 62, 0.15); color: #F5F0E8; border: 1px solid rgba(245, 240, 232, 0.15);">
                            {{ $item->kategori->nama_kategori }}
                        </span>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-display font-bold text-base text-ink mb-2 group-hover:text-leaf-600 transition-colors duration-300">
                            {{ $item->nama }}
                        </h3>
                        <div class="space-y-1.5 text-sm text-ink/60">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-ink/30 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $item->lokasi }}
                            </div>
                            <div class="flex items-center justify-between">
                                <span>{{ $item->formatted_jarak ?? ($item->jarak_km ? $item->jarak_km . ' km' : '-') }}</span>
                                <span class="font-semibold text-leaf-600">{{ $item->formatted_harga ?? 'Gratis' }}</span>
                            </div>
                        </div>
                        <a href="{{ route('destinasi.show', $item->nama) }}"
                           class="group/btn mt-3 w-full inline-flex items-center justify-center px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300"
                           style="border: 1px solid rgba(14, 29, 24, 0.12); color: #2D4A3E;">
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
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.galeri-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                Swal.fire({
                    imageUrl: href,
                    imageAlt: 'Galeri Foto',
                    background: '#FDFBF7',
                    showConfirmButton: false,
                    width: 'auto',
                    padding: 0,
                    customClass: {
                        image: 'max-w-full max-h-[80vh] object-contain'
                    }
                });
            });
        });
    });
</script>
@endpush
