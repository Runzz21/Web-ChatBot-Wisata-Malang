@extends('layouts.main')

@section('title', 'Destinasi Wisata')
@section('meta_description', 'Jelajahi berbagai destinasi wisata alam di Malang Raya. Temukan informasi lengkap tentang lokasi, harga tiket, dan fasilitas.')

@section('content')
<section class="pt-28 pb-16 lg:pb-24 min-h-screen"
    x-data="filterApp()"
    x-init="init()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-10 reveal">
            <span class="text-xs font-medium tracking-widest uppercase text-ink/40">Destinasi</span>
            <h1 class="text-3xl lg:text-4xl font-display font-bold text-ink mt-2 tracking-tight">Jelajahi Semua<br><span class="text-leaf-600">Destinasi Wisata</span></h1>
        </div>

        {{-- Search & Sort Bar --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-10 reveal" style="transition-delay: 0.1s">
            <div class="relative flex-1">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" x-model="params.search"
                       @input="debouncedFetch()"
                       placeholder="Cari destinasi wisata..."
                       class="input-field pl-11">
            </div>
            <div class="flex gap-2">
                <button @click="showFilter = !showFilter"
                        class="inline-flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300 lg:hidden"
                        :class="showFilter ? 'bg-leaf-600 text-white' : 'text-leaf-600'"
                        style="border: 1px solid rgba(14, 29, 24, 0.1);">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Filter
                </button>
                <select x-model="params.sort_by" @change="fetch()" class="select-field text-sm min-w-[120px]">
                    <option value="nama">Nama</option>
                    <option value="harga_tiket">Harga Tiket</option>
                    <option value="jarak_km">Jarak</option>
                    <option value="dibuat_pada">Terbaru</option>
                </select>
                <select x-model="params.sort_order" @change="fetch()" class="select-field text-sm min-w-[80px]">
                    <option value="asc">A-Z</option>
                    <option value="desc">Z-A</option>
                </select>
            </div>
        </div>

        <div class="flex gap-10">
            {{-- Filter Sidebar --}}
            <div x-show="showFilter || window.innerWidth >= 1024"
                 x-cloak
                 class="flex flex-col w-full lg:w-64 xl:w-72 flex-shrink-0"
                 :class="showFilter ? 'fixed inset-0 z-50 p-4 bg-canvas/95 backdrop-blur-xl lg:relative lg:inset-auto lg:z-auto lg:p-0 lg:bg-transparent lg:backdrop-blur-none' : ''">
                <div class="card-glass p-6 space-y-8 scrollbar-thin overflow-y-auto max-h-[calc(100vh-200px)] lg:sticky lg:top-28 reveal-left"
                     :class="showFilter ? 'max-h-[calc(100vh-2rem)]' : ''">
                    {{-- Close button mobile --}}
                    <button @click="showFilter = false" class="lg:hidden flex items-center text-sm text-ink/50 hover:text-ink mb-4">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Tutup Filter
                    </button>

                    {{-- Kategori --}}
                    <div>
                        <h3 class="font-display font-semibold text-leaf-700 mb-3 text-xs uppercase tracking-widest">Kategori</h3>
                        <select x-model="params.kategori" @change="fetch()" class="select-field text-sm">
                            <option value="">Semua Kategori</option>
                            @if(isset($kategoriList))
                                @foreach($kategoriList as $kat)
                                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- Jarak --}}
                    <div>
                        <h3 class="font-display font-semibold text-leaf-700 mb-3 text-xs uppercase tracking-widest">Jarak (km)</h3>
                        <div class="space-y-2">
                            @foreach([
                                ['value' => '', 'label' => 'Semua Jarak'],
                                ['value' => '<10', 'label' => '< 10 km'],
                                ['value' => '10-25', 'label' => '10 - 25 km'],
                                ['value' => '25-50', 'label' => '25 - 50 km'],
                                ['value' => '>50', 'label' => '> 50 km'],
                            ] as $opt)
                            <label class="flex items-center p-2 rounded-lg hover:bg-leaf-600/5 cursor-pointer transition-colors">
                                <input type="radio" x-model="params.jarak" value="{{ $opt['value'] }}"
                                       @change="fetch()"
                                       class="w-4 h-4 text-leaf-600 rounded-full focus:ring-leaf-600/30 border-ink/20">
                                <span class="ml-3 text-sm text-ink/60">{{ $opt['label'] }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Harga --}}
                    <div>
                        <h3 class="font-display font-semibold text-leaf-700 mb-3 text-xs uppercase tracking-widest">Harga Tiket</h3>
                        <div class="space-y-2">
                            @foreach([
                                ['value' => '', 'label' => 'Semua Harga'],
                                ['value' => 'gratis', 'label' => 'Gratis'],
                                ['value' => '<10000', 'label' => '< Rp 10.000'],
                                ['value' => '10000-20000', 'label' => 'Rp 10.000 - Rp 20.000'],
                                ['value' => '>20000', 'label' => '> Rp 20.000'],
                            ] as $opt)
                            <label class="flex items-center p-2 rounded-lg hover:bg-leaf-600/5 cursor-pointer transition-colors">
                                <input type="radio" x-model="params.harga" value="{{ $opt['value'] }}"
                                       @change="fetch()"
                                       class="w-4 h-4 text-leaf-600 rounded-full focus:ring-leaf-600/30 border-ink/20">
                                <span class="ml-3 text-sm text-ink/60">{{ $opt['label'] }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Buka 24 Jam --}}
                    <div>
                        <label class="flex items-center p-2 rounded-lg hover:bg-leaf-600/5 cursor-pointer transition-colors">
                            <input type="checkbox" x-model="params.buka_24jam" value="1"
                                   @change="fetch()"
                                   class="w-4 h-4 text-leaf-600 rounded focus:ring-leaf-600/30 border-ink/20">
                            <span class="ml-3 text-sm text-ink/60">Buka 24 Jam</span>
                        </label>
                    </div>

                    {{-- Reset --}}
                    <button @click="reset()"
                            class="w-full py-2.5 text-sm text-ink/50 hover:text-leaf-600 rounded-xl transition-colors border border-ink/10 hover:border-leaf-600/20">
                        Reset Filter
                    </button>
                </div>
            </div>

            {{-- Destinasi Grid --}}
            <div class="flex-1">
                {{-- Loading overlay --}}
                <div x-show="loading" class="flex items-center justify-center py-12">
                    <div class="flex space-x-2">
                        <div class="w-3 h-3 bg-leaf-600 rounded-full typing-dot"></div>
                        <div class="w-3 h-3 bg-leaf-600 rounded-full typing-dot"></div>
                        <div class="w-3 h-3 bg-leaf-600 rounded-full typing-dot"></div>
                    </div>
                </div>

                <div x-show="!loading" id="destinasi-grid" x-html="gridHtml">
                    @include('destinasi.partials.grid')
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function filterApp() {
            return {
                params: {
                    search: '{{ request('search') }}',
                    kategori: '{{ request('kategori') }}',
                    jarak: '{{ request('jarak') }}',
                    harga: '{{ request('harga') }}',
                    buka_24jam: {{ request('buka_24jam') ? '1' : '0' }},
                    sort_by: '{{ request('sort_by') ?? 'nama' }}',
                    sort_order: '{{ request('sort_order') ?? 'asc' }}',
                },
                showFilter: false,
                loading: false,
                gridHtml: '',
                searchTimeout: null,

                init() {
                    this.gridHtml = document.getElementById('destinasi-grid').innerHTML;
                    this.$watch('params', () => {
                        const params = new URLSearchParams();
                        Object.entries(this.params).forEach(([key, val]) => {
                            if (val !== '' && val !== '0') params.set(key, val);
                        });
                        const url = window.location.pathname + '?' + params.toString();
                        history.replaceState({}, '', url);
                    });
                },

                debouncedFetch() {
                    clearTimeout(this.searchTimeout);
                    this.searchTimeout = setTimeout(() => this.fetch(), 400);
                },

                async fetch(url) {
                    this.loading = true;
                    try {
                        if (!url) {
                            const params = new URLSearchParams();
                            Object.entries(this.params).forEach(([key, val]) => {
                                if (val !== '' && val !== '0') params.set(key, val);
                            });
                            url = '{{ route('destinasi.index') }}?' + params.toString();
                        }
                        const res = await axios.get(url, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        });
                        this.gridHtml = res.data.html;
                        if (!arguments[0]) {
                            window.scrollTo({ top: document.querySelector('[x-data="filterApp()"]').offsetTop - 100, behavior: 'smooth' });
                        }
                        this.$nextTick(() => {
                            if (window.initRevealAnimations) window.initRevealAnimations();
                            document.querySelectorAll('#destinasi-pagination a').forEach(a => {
                                a.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    const gridTop = document.querySelector('[x-data="filterApp()"]').offsetTop - 120;
                                    window.scrollTo({ top: gridTop, behavior: 'smooth' });
                                    this.fetch(a.href);
                                });
                            });
                        });
                    } catch (e) {
                        console.error('Filter error:', e);
                    } finally {
                        this.loading = false;
                    }
                },

                reset() {
                    this.params = {
                        search: '',
                        kategori: '',
                        jarak: '',
                        harga: '',
                        buka_24jam: '0',
                        sort_by: 'nama',
                        sort_order: 'asc',
                    };
                    this.fetch();
                }
            }
        }
    </script>
    @endpush
</section>
@endsection
