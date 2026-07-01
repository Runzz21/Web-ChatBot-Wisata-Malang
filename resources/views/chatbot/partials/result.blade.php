<div class="space-y-4">
    @if(!empty($aiMessage))
    <div class="flex justify-start">
        <div class="chat-bubble-bot">
            <div class="text-sm leading-relaxed text-forest-700/80">{!! nl2br(e($aiMessage)) !!}</div>
        </div>
    </div>
    @endif

    <div class="flex items-center space-x-3 mb-2">
        <span class="w-8 h-8 bg-accent/10 rounded-full flex items-center justify-center">
            <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </span>
        <div>
            <p class="font-display font-semibold text-primary-800">Hasil Rekomendasi</p>
            <p class="font-mono text-[0.6875rem] text-[#5A6B55] tracking-wide">Destinasi sing cocok karo sampeyan</p>
        </div>
    </div>

    @if($rekomendasi && $rekomendasi->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($rekomendasi as $item)
            <div class="card-elevated group">
                <div class="relative overflow-hidden aspect-[4/3]">
                    <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}"
                         class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
                         loading="lazy">
                </div>
                <div class="p-4">
                    <h4 class="font-display font-semibold text-primary-800 mb-1 group-hover:text-forest-600 transition-colors duration-300">{{ $item->nama }}</h4>
                    <div class="flex items-center text-sm text-forest-700/60 mb-2">
                        <svg class="w-4 h-4 mr-1.5 text-forest-700/30 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $item->lokasi }}
                    </div>
                    <div class="flex items-center justify-between text-sm text-forest-700/60">
                        <span>{{ $item->formatted_jarak ?? ($item->jarak_km ? $item->jarak_km . ' km' : '-') }}</span>
                        <span class="font-semibold text-forest-600">{{ $item->formatted_harga ?? 'Gratis' }}</span>
                    </div>
                    <a href="{{ route('destinasi.show', $item->nama) }}"
                       class="mt-3 w-full inline-flex items-center justify-center px-3 py-2 bg-primary-700 text-white text-xs font-semibold rounded-xl hover:bg-primary-800 transition-colors">
                        Lihat Detail
                        <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-10 bg-[#EDF1EA] rounded-2xl">
            <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-primary-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-[#5A6B55]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="font-display font-semibold text-primary-800">Ora ana destinasi</p>
            <p class="text-sm text-[#5A6B55] mt-1">Coba ganti kategori utawa jarake</p>
        </div>
    @endif

    <div class="text-center pt-2">
        <button onclick="window.location.reload()"
                class="inline-flex items-center px-5 py-2.5 bg-[#EDF1EA] text-primary-800 font-semibold rounded-xl hover:bg-primary-100 transition-colors text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            Golek Maneh
        </button>
    </div>
</div>
