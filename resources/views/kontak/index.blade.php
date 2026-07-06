@extends('layouts.main')

@section('title', 'Kontak')
@section('meta_description', 'Hubungi tim Wisata Alam Malang untuk pertanyaan, saran, atau informasi lebih lanjut tentang destinasi wisata alam di Malang Raya.')

@section('content')
    {{-- Hero --}}
    <section class="relative pt-32 pb-20 lg:pb-28 overflow-hidden" style="background: #0E1D18;">
        <div class="absolute inset-0" style="background: radial-gradient(ellipse at 30% 50%, rgba(45, 74, 62, 0.4) 0%, transparent 60%), radial-gradient(ellipse at 70% 50%, rgba(201, 168, 76, 0.05) 0%, transparent 40%);"></div>
        <div class="relative z-10 max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-medium tracking-wider uppercase mb-6"
                  style="background: rgba(201, 168, 76, 0.12); color: #C9A84C; border: 1px solid rgba(201, 168, 76, 0.15);">
                Hubungi Kami
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-white leading-tight tracking-tight mb-6">
                Hubungi Kami
            </h1>
            <p class="text-lg sm:text-xl text-white/60 leading-relaxed max-w-2xl mx-auto">
                Punya pertanyaan atau saran? Jangan ragu untuk menghubungi kami. Tim kami siap membantu kamu.
            </p>
        </div>
    </section>

    {{-- Contact Content --}}
    <section class="py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 lg:gap-16">
                {{-- Contact Info --}}
                <div class="lg:col-span-2 space-y-6 reveal-left">
                    <div>
                        <span class="text-xs font-medium tracking-widest uppercase text-ink/40">Kontak</span>
                        <h2 class="text-2xl sm:text-3xl font-display font-bold text-ink mt-3 mb-2 tracking-tight">Informasi Kontak</h2>
                        <p class="text-ink/50">Jangan ragu untuk menghubungi kami melalui kontak di bawah ini</p>
                    </div>

                    @foreach([
                        ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Alamat', 'content' => 'Malang Raya, Jawa Timur, Indonesia'],
                        ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title' => 'Email', 'content' => 'info@wisatamalang.com', 'link' => true],
                        ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'title' => 'Telepon', 'content' => '+62 812-3456-7890', 'link' => true],
                    ] as $item)
                    <div class="card-glass p-5 flex items-start space-x-4 group hover:bg-canvas transition-all duration-300" style="transition-delay: {{ $loop->index * 0.1 }}s">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-300 group-hover:scale-105"
                             style="background: rgba(45, 74, 62, 0.06);">
                            <svg class="w-5 h-5 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display font-semibold text-leaf-700">{{ $item['title'] }}</h3>
                            @if(isset($item['link']) && $item['link'])
                            <a href="{{ Str::startsWith($item['content'], '+62') ? 'tel:' . str_replace([' ', '-'], '', $item['content']) : 'mailto:' . $item['content'] }}"
                               class="text-sm text-leaf-600 hover:text-gold-600 transition-colors duration-300 mt-0.5 block">
                                {{ $item['content'] }}
                            </a>
                            @else
                            <p class="text-sm text-ink/60 mt-0.5">{{ $item['content'] }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Contact Form --}}
                <div class="lg:col-span-3 reveal-right">
                    <div class="card-glass p-8">
                        <h2 class="text-xl font-display font-bold text-ink mb-2">Kirim Pesan</h2>
                        <p class="text-sm text-ink/50 mb-8">Isi form di bawah ini untuk mengirimkan pesan kepada kami</p>

                        <form>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-leaf-700 mb-2">Nama Lengkap</label>
                                    <input type="text" id="name" name="name"
                                           class="input-field"
                                           placeholder="Nama lengkap">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-leaf-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email"
                                           class="input-field"
                                           placeholder="contoh@email.com">
                                </div>
                            </div>
                            <div class="mb-5">
                                <label for="subject" class="block text-sm font-medium text-leaf-700 mb-2">Subjek</label>
                                <input type="text" id="subject" name="subject"
                                       class="input-field"
                                       placeholder="Subjek pesan">
                            </div>
                            <div class="mb-8">
                                <label for="message" class="block text-sm font-medium text-leaf-700 mb-2">Pesan</label>
                                <textarea id="message" name="message" rows="5"
                                          class="input-field resize-none"
                                          placeholder="Tulis pesan kamu di sini..."></textarea>
                            </div>
                            <button type="submit"
                                    class="btn-primary group">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
