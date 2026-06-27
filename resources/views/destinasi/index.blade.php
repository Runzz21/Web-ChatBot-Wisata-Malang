@extends('layouts.main')

@section('title', 'Destinasi Wisata')
@section('meta_description', 'Jelajahi berbagai destinasi wisata alam di Malang Raya. Temukan informasi lengkap tentang lokasi, harga tiket, dan fasilitas.')

@push('styles')
<style>
    .filter-panel {
        scrollbar-width: thin;
        scrollbar-color: #D1D5DB transparent;
    }
    .filter-panel::-webkit-scrollbar { width: 4px; }
    .filter-panel::-webkit-scrollbar-thumb { background-color: #D1D5DB; border-radius: 4px; }
</style>
@endpush

@section('content')
<section class="py-10 lg:py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl lg:text-4xl font-display font-bold text-gray-900">Destinasi Wisata Alam</h1>
            <p class="text-gray-500 mt-2">Temukan destinasi wisata alam favoritmu di Malang Raya</p>
        </div>

        {{-- Search & Sort Bar --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <div class="relative flex-1">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" form="filter-form"
                       value="{{ $search ?? request('search') }}"
                       placeholder="Cari destinasi wisata..."
                       onkeypress="if(event.key==='Enter')this.form.submit()"
                       class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow">
            </div>
            <div class="flex gap-2">
                <button type="button" onclick="document.getElementById('filter-toggle').classList.toggle('hidden'); document.getElementById('filter-toggle').classList.toggle('flex')"
                        class="inline-flex items-center px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors lg:hidden">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Filter
                </button>
                <select name="sort_by" form="filter-form" onchange="this.form.submit()"
                        class="px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                    <option value="nama" {{ (request('sort_by') == 'nama') ? 'selected' : '' }}>Nama</option>
                    <option value="harga_tiket" {{ (request('sort_by') == 'harga_tiket') ? 'selected' : '' }}>Harga Tiket</option>
                    <option value="jarak_km" {{ (request('sort_by') == 'jarak_km') ? 'selected' : '' }}>Jarak</option>
                    <option value="dibuat_pada" {{ (request('sort_by') == 'dibuat_pada') ? 'selected' : '' }}>Terbaru</option>
                </select>
                <select name="sort_order" form="filter-form" onchange="this.form.submit()"
                        class="px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                    <option value="asc" {{ (request('sort_order') == 'asc') ? 'selected' : '' }}>A-Z</option>
                    <option value="desc" {{ (request('sort_order') == 'desc') ? 'selected' : '' }}>Z-A</option>
                </select>
            </div>
        </div>

        <div class="flex gap-8">
            {{-- Filter Sidebar --}}
            <div id="filter-toggle" class="hidden lg:flex flex-col w-full lg:w-72 flex-shrink-0">
                <form id="filter-form" method="GET" action="{{ route('destinasi.index') }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6 filter-panel overflow-y-auto max-h-[calc(100vh-240px)] lg:sticky lg:top-24">
                    {{-- Kategori --}}
                    <div>
                        <h3 class="font-display font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wider">Kategori</h3>
                            <select name="kategori"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none"
                                    onchange="this.form.submit()">
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
                        <h3 class="font-display font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wider">Jarak (km)</h3>
                        <div class="space-y-2">
                            @php $jarak = request('jarak'); @endphp
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="radio" name="jarak" value="" {{ !$jarak ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500" onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-gray-600">Semua Jarak</span>
                            </label>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="radio" name="jarak" value="<10" {{ $jarak == '<10' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500" onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-gray-600">&lt; 10 km</span>
                            </label>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="radio" name="jarak" value="10-25" {{ $jarak == '10-25' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500" onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-gray-600">10 - 25 km</span>
                            </label>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="radio" name="jarak" value="25-50" {{ $jarak == '25-50' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500" onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-gray-600">25 - 50 km</span>
                            </label>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="radio" name="jarak" value=">50" {{ $jarak == '>50' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500" onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-gray-600">&gt; 50 km</span>
                            </label>
                        </div>
                    </div>

                    {{-- Harga --}}
                    <div>
                        <h3 class="font-display font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wider">Harga Tiket</h3>
                        <div class="space-y-2">
                            @php $harga = request('harga'); @endphp
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="radio" name="harga" value="" {{ !$harga ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500" onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-gray-600">Semua Harga</span>
                            </label>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="radio" name="harga" value="gratis" {{ $harga == 'gratis' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500" onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-gray-600">Gratis</span>
                            </label>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="radio" name="harga" value="<10000" {{ $harga == '<10000' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500" onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-gray-600">&lt; Rp 10.000</span>
                            </label>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="radio" name="harga" value="10000-20000" {{ $harga == '10000-20000' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500" onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-gray-600">Rp 10.000 - Rp 20.000</span>
                            </label>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <input type="radio" name="harga" value=">20000" {{ $harga == '>20000' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500" onchange="this.form.submit()">
                                <span class="ml-3 text-sm text-gray-600">&gt; Rp 20.000</span>
                            </label>
                        </div>
                    </div>

                    {{-- Buka 24 Jam --}}
                    <div>
                        <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                            <input type="checkbox" name="buka_24jam" value="1" {{ request('buka_24jam') ? 'checked' : '' }} class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500" onchange="this.form.submit()">
                            <span class="ml-3 text-sm text-gray-600">Buka 24 Jam</span>
                        </label>
                    </div>

                    {{-- Reset --}}
                    <button type="button" onclick="window.location.href='{{ route('destinasi.index') }}'"
                            class="w-full py-2.5 text-sm text-gray-500 hover:text-gray-700 hover:bg-gray-50 rounded-xl transition-colors border border-gray-200">
                        Reset Filter
                    </button>
                </form>
            </div>

            {{-- Destinasi Grid --}}
            <div class="flex-1">
                @if($destinasi->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($destinasi as $item)
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
                            @if($item->buka_24jam)
                            <span class="absolute top-3 right-3 px-3 py-1 text-xs font-semibold rounded-full bg-blue-500 text-white shadow">
                                Buka 24 Jam
                            </span>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-display font-bold text-lg text-gray-900 mb-3 group-hover:text-primary-600 transition-colors">
                                {{ $item->nama }}
                            </h3>
                            <div class="space-y-2 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $item->lokasi }}
                                </div>
                                @if($item->ketinggian_mdpl)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                    {{ number_format($item->ketinggian_mdpl, 0, ',', '.') }} MDPL
                                </div>
                                @endif
                                <div class="flex items-center justify-between pt-1">
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

                {{-- Pagination --}}
                <div class="mt-10">
                    {{ $destinasi->appends(request()->query())->links() }}
                </div>
                @else
                <div class="text-center py-20">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <h3 class="text-xl font-display font-semibold text-gray-500 mb-2">Destinasi Tidak Ditemukan</h3>
                    <p class="text-gray-400">Coba sesuaikan filter atau kata kunci pencarian kamu</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filter-form');
        const inputs = filterForm.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('change', function() {
                filterForm.submit();
            });
        });
    });
</script>
@endpush
@endsection
