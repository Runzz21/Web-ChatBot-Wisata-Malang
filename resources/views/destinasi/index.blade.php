@extends('layouts.main')

@section('title', 'Destinasi Wisata')
@section('meta_description', 'Jelajahi berbagai destinasi wisata alam di Malang Raya. Temukan informasi lengkap tentang lokasi, harga tiket, dan fasilitas.')

@section('content')
<section class="pt-28 pb-16 lg:pb-24 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-10 reveal">
            <span class="text-xs font-medium tracking-widest uppercase text-forest-700/40">Destinasi</span>
            <h1 class="text-3xl lg:text-4xl font-display font-bold text-forest-800 mt-2 tracking-tight">Jelajahi Semua<br><span class="text-forest-600">Destinasi Wisata</span></h1>
        </div>

        {{-- Search & Sort Bar --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-10 reveal" style="transition-delay: 0.1s">
            <div class="relative flex-1">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-forest-700/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" form="filter-form"
                       value="{{ $search ?? request('search') }}"
                       placeholder="Cari destinasi wisata..."
                       onkeypress="if(event.key==='Enter')this.form.submit()"
                       class="input-custom pl-11">
            </div>
            <div class="flex gap-2">
                <button type="button" onclick="document.getElementById('filter-toggle').classList.toggle('hidden'); document.getElementById('filter-toggle').classList.toggle('flex')"
                        class="inline-flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all duration-300 lg:hidden"
                        style="border: 1px solid rgba(45, 74, 62, 0.1); color: #2D4A3E;">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Filter
                </button>
                <select name="sort_by" form="filter-form" onchange="this.form.submit()" class="select-custom text-sm min-w-[120px]">
                    <option value="nama" {{ (request('sort_by') == 'nama') ? 'selected' : '' }}>Nama</option>
                    <option value="harga_tiket" {{ (request('sort_by') == 'harga_tiket') ? 'selected' : '' }}>Harga Tiket</option>
                    <option value="jarak_km" {{ (request('sort_by') == 'jarak_km') ? 'selected' : '' }}>Jarak</option>
                    <option value="dibuat_pada" {{ (request('sort_by') == 'dibuat_pada') ? 'selected' : '' }}>Terbaru</option>
                </select>
                <select name="sort_order" form="filter-form" onchange="this.form.submit()" class="select-custom text-sm min-w-[80px]">
                    <option value="asc" {{ (request('sort_order') == 'asc') ? 'selected' : '' }}>A-Z</option>
                    <option value="desc" {{ (request('sort_order') == 'desc') ? 'selected' : '' }}>Z-A</option>
                </select>
            </div>
        </div>

        <div class="flex gap-10">
            {{-- Filter Sidebar --}}
            <div id="filter-toggle" class="hidden lg:flex flex-col w-full lg:w-64 xl:w-72 flex-shrink-0">
                <form id="filter-form" method="GET" action="{{ route('destinasi.index') }}" class="card-glass p-6 space-y-8 scrollbar-thin overflow-y-auto max-h-[calc(100vh-200px)] lg:sticky lg:top-28 reveal-left">
                    {{-- Kategori --}}
                    <div>
                        <h3 class="font-display font-semibold text-forest-700 mb-3 text-xs uppercase tracking-widest">Kategori</h3>
                        <select name="kategori" class="select-custom text-sm" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            @if(isset($kategoriList))
                                @foreach($kategoriList as $kat)
                                <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- Jarak --}}
                    <div>
                        <h3 class="font-display font-semibold text-forest-700 mb-3 text-xs uppercase tracking-widest">Jarak (km)</h3>
                        <div class="space-y-2">
                            @php $jarak = request('jarak'); @endphp
                            @foreach([
                                ['value' => '', 'label' => 'Semua Jarak'],
                                ['value' => '<10', 'label' => '< 10 km'],
                                ['value' => '10-25', 'label' => '10 - 25 km'],
                                ['value' => '25-50', 'label' => '25 - 50 km'],
                                ['value' => '>50', 'label' => '> 50 km'],
                            ] as $opt)
                            <label class="flex items-center p-2 rounded-lg hover:bg-forest-600/5 cursor-pointer transition-colors">
                                <input type="radio" name="jarak" value="{{ $opt['value'] }}" {{ !$jarak && $opt['value'] === '' ? 'checked' : ($jarak == $opt['value'] ? 'checked' : '') }}
                                       class="w-4 h-4 text-forest-600 rounded-full focus:ring-forest-600/30 border-forest-600/20"
                                       onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-forest-700/60">{{ $opt['label'] }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Harga --}}
                    <div>
                        <h3 class="font-display font-semibold text-forest-700 mb-3 text-xs uppercase tracking-widest">Harga Tiket</h3>
                        <div class="space-y-2">
                            @php $harga = request('harga'); @endphp
                            @foreach([
                                ['value' => '', 'label' => 'Semua Harga'],
                                ['value' => 'gratis', 'label' => 'Gratis'],
                                ['value' => '<10000', 'label' => '< Rp 10.000'],
                                ['value' => '10000-20000', 'label' => 'Rp 10.000 - Rp 20.000'],
                                ['value' => '>20000', 'label' => '> Rp 20.000'],
                            ] as $opt)
                            <label class="flex items-center p-2 rounded-lg hover:bg-forest-600/5 cursor-pointer transition-colors">
                                <input type="radio" name="harga" value="{{ $opt['value'] }}" {{ !$harga && $opt['value'] === '' ? 'checked' : ($harga == $opt['value'] ? 'checked' : '') }}
                                       class="w-4 h-4 text-forest-600 rounded-full focus:ring-forest-600/30 border-forest-600/20"
                                       onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-forest-700/60">{{ $opt['label'] }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Buka 24 Jam --}}
                    <div>
                        <label class="flex items-center p-2 rounded-lg hover:bg-forest-600/5 cursor-pointer transition-colors">
                            <input type="checkbox" name="buka_24jam" value="1" {{ request('buka_24jam') ? 'checked' : '' }}
                                   class="w-4 h-4 text-forest-600 rounded focus:ring-forest-600/30 border-forest-600/20"
                                   onchange="this.form.submit()">
                            <span class="ml-3 text-sm text-forest-700/60">Buka 24 Jam</span>
                        </label>
                    </div>

                    {{-- Reset --}}
                    <button type="button" onclick="window.location.href='{{ route('destinasi.index') }}'"
                            class="w-full py-2.5 text-sm text-forest-700/50 hover:text-forest-600 rounded-lg transition-colors border border-forest-600/10 hover:border-forest-600/20">
                        Reset Filter
                    </button>
                </form>
            </div>

            {{-- Destinasi Grid --}}
            <div class="flex-1">
                @if($destinasi->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    @foreach($destinasi as $item)
                    <div class="destination-card card-elevated group" style="animation-delay: {{ $loop->index * 0.03 }}s">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}"
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
                        <div class="p-5">
                            <h3 class="font-display font-bold text-base text-forest-800 mb-3 group-hover:text-forest-600 transition-colors duration-300">
                                {{ $item->nama }}
                            </h3>
                            <div class="space-y-2 text-sm text-forest-700/60">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-forest-700/30 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $item->lokasi }}
                                </div>
                                @if($item->ketinggian_mdpl)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-forest-700/30 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                    {{ number_format($item->ketinggian_mdpl, 0, ',', '.') }} MDPL
                                </div>
                                @endif
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
                               class="group/btn mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-300"
                               style="border: 1px solid rgba(45, 74, 62, 0.12); color: #2D4A3E;">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-1.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12 reveal">
                    {{ $destinasi->appends(request()->query())->links() }}
                </div>
                @else
                <div class="text-center py-24 reveal">
                    <div class="w-16 h-16 mx-auto mb-5 rounded-2xl flex items-center justify-center" style="background: rgba(45, 74, 62, 0.05);">
                        <svg class="w-7 h-7 text-forest-700/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="font-display font-semibold text-forest-700 mb-2">Destinasi Tidak Ditemukan</h3>
                    <p class="text-sm text-forest-700/40">Coba sesuaikan filter atau kata kunci pencarian kamu</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
