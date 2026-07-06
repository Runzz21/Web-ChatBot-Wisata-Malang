@if($destinasi->count())
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
    @foreach($destinasi as $item)
    <div class="destination-card card-image group" style="animation-delay: {{ $loop->index * 0.03 }}s">
        <div class="relative overflow-hidden aspect-[4/3]">
            <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}"
                 class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
                 loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-ink/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
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
            <h3 class="font-display font-bold text-base text-ink mb-3 group-hover:text-leaf-600 transition-colors duration-300">
                {{ $item->nama }}
            </h3>
            <div class="space-y-2 text-sm text-ink/60">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-ink/30 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $item->lokasi }}
                </div>
                @if($item->ketinggian_mdpl)
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-ink/30 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    {{ number_format($item->ketinggian_mdpl, 0, ',', '.') }} MDPL
                </div>
                @endif
                <div class="flex items-center justify-between pt-1">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-ink/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        {{ $item->formatted_jarak ?? ($item->jarak_km ? $item->jarak_km . ' km' : '-') }}
                    </span>
                    <span class="font-semibold text-leaf-600">
                        {{ $item->formatted_harga ?? 'Gratis' }}
                    </span>
                </div>
            </div>
            <a href="{{ route('destinasi.show', $item->nama) }}"
               class="group/btn mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-300"
               style="border: 1px solid rgba(14, 29, 24, 0.12); color: #2D4A3E;">
                Lihat Detail
                <svg class="w-4 h-4 ml-1.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-12 reveal" id="destinasi-pagination">
    {{ $destinasi->appends(request()->query())->links() }}
</div>
@else
<div class="text-center py-24 reveal">
    <div class="w-16 h-16 mx-auto mb-5 rounded-2xl flex items-center justify-center" style="background: rgba(14, 29, 24, 0.05);">
        <svg class="w-7 h-7 text-ink/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    </div>
    <h3 class="font-display font-semibold text-leaf-700 mb-2">Destinasi Tidak Ditemukan</h3>
    <p class="text-sm text-ink/40">Coba sesuaikan filter atau kata kunci pencarian kamu</p>
</div>
@endif
