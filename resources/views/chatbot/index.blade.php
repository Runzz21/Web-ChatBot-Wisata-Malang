@extends('layouts.main')

@section('title', 'Rekomendasi Wisata')
@section('meta_description', 'Dapatkan rekomendasi destinasi wisata alam di Malang Raya berdasarkan preferensi kamu. Mulai dari kategori, jarak, dan harga.')

@push('styles')
<style>
    .chat-messages {
        scrollbar-width: thin;
        scrollbar-color: rgba(45, 74, 62, 0.15) transparent;
        height: calc(100vh - 320px);
        min-height: 450px;
    }
    .chat-messages::-webkit-scrollbar { width: 4px; }
    .chat-messages::-webkit-scrollbar-track { background: transparent; }
    .chat-messages::-webkit-scrollbar-thumb { background: rgba(45, 74, 62, 0.15); border-radius: 4px; }
    .option-btn {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .option-btn:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<section class="pt-28 pb-16 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 reveal">
            <span class="text-xs font-medium tracking-widest uppercase text-forest-700/40">Rekomendasi</span>
            <h1 class="text-3xl sm:text-4xl font-display font-bold text-forest-800 mt-2 tracking-tight">Dapatkan Rekomendasi<br><span class="text-forest-600">Wisata</span></h1>
        </div>

        <div class="card-glass overflow-hidden reveal" style="transition-delay: 0.1s"
             x-data="chatbotApp()"
             x-init="init()">
            {{-- Header --}}
            <div class="px-6 py-4 flex items-center space-x-3" style="background: #2D4A3E;">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(255, 255, 255, 0.1);">
                    <svg class="w-5 h-5 text-cream-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                </div>
                <div>
                    <h3 class="font-display font-semibold text-cream-50">Asisten Wisata</h3>
                    <p class="text-xs" style="color: rgba(201, 168, 76, 0.7);">Online</p>
                </div>
            </div>

            {{-- Messages --}}
            <div class="chat-messages overflow-y-auto p-6 space-y-4 scrollbar-thin" x-ref="messages" id="chat-messages">
                {{-- Welcome Step --}}
                <div x-show="step === 'welcome'" class="flex justify-start">
                    <div class="chat-bubble-bot">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(45, 74, 62, 0.08);">
                                    <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                </div>
                                <div>
                                    <p class="font-display font-semibold text-forest-800">Halo!</p>
                                    <p class="text-xs text-forest-700/40">Asisten Wisata</p>
                                </div>
                            </div>
                            <p class="text-forest-700/60">Selamat datang di Rekomendasi Wisata Alam Malang! Saya akan membantu kamu menemukan destinasi wisata yang tepat. Yuk, kita mulai!</p>
                            <button @click="startChat" class="btn-solid group text-sm">
                                Mulai
                                <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- User messages --}}
                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div :class="msg.role === 'user' ? 'chat-bubble-user' : 'chat-bubble-bot'">
                            <div class="text-sm leading-relaxed" x-text="msg.content"></div>
                        </div>
                    </div>
                </template>

                {{-- Step 2: Kategori --}}
                <div x-show="step === 'step2'" class="flex justify-start">
                    <div class="chat-bubble-bot max-w-full">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold" style="background: rgba(45, 74, 62, 0.08); color: #2D4A3E;">1</span>
                                <div>
                                    <p class="font-display font-semibold text-forest-700">Pilih Kategori</p>
                                    <p class="text-xs text-forest-700/40">Destinasi apa yang kamu cari?</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                                <button @click="pilihKategori('')"
                                        class="option-btn flex flex-col items-center p-3 rounded-xl text-sm font-medium transition-all duration-300"
                                        style="background: rgba(45, 74, 62, 0.03); border: 1px solid rgba(45, 74, 62, 0.06); color: #2D4A3E;">
                                    <svg class="w-6 h-6 mb-1.5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                    Semua
                                </button>
                                @foreach($kategoriList as $kategori)
                                <button @click="pilihKategori({{ $kategori->id_kategori }})"
                                        class="option-btn flex flex-col items-center p-3 rounded-xl text-sm font-medium transition-all duration-300"
                                        style="background: rgba(45, 74, 62, 0.03); border: 1px solid rgba(45, 74, 62, 0.06); color: #2D4A3E;">
                                    <div class="w-6 h-6 flex items-center justify-center mb-1.5 text-lg">
                                        {!! $kategori->icon ?? '<svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>' !!}
                                    </div>
                                    <span>{{ $kategori->nama_kategori }}</span>
                                </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Step 3: Jarak --}}
                <div x-show="step === 'step3'" class="flex justify-start">
                    <div class="chat-bubble-bot max-w-full">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold" style="background: rgba(45, 74, 62, 0.08); color: #2D4A3E;">2</span>
                                <div>
                                    <p class="font-display font-semibold text-forest-700">Pilih Jarak Tempuh</p>
                                    <p class="text-xs text-forest-700/40">Seberapa jauh destinasi yang kamu inginkan?</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($jarakOptions as $option)
                                <button @click="pilihJarak('{{ $option['value'] }}')"
                                        class="option-btn flex items-center justify-center p-3 rounded-xl text-sm font-medium transition-all duration-300"
                                        style="background: rgba(45, 74, 62, 0.03); border: 1px solid rgba(45, 74, 62, 0.06); color: #2D4A3E;">
                                    <svg class="w-4 h-4 mr-2 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                    {{ $option['label'] }}
                                </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Step 4: Anggaran --}}
                <div x-show="step === 'step4'" class="flex justify-start">
                    <div class="chat-bubble-bot max-w-full">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold" style="background: rgba(45, 74, 62, 0.08); color: #2D4A3E;">3</span>
                                <div>
                                    <p class="font-display font-semibold text-forest-700">Pilih Anggaran</p>
                                    <p class="text-xs text-forest-700/40">Berapa budget yang kamu siapkan?</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($anggaranOptions as $option)
                                <button @click="pilihAnggaran('{{ $option['value'] }}')"
                                        class="option-btn flex items-center justify-center p-3 rounded-xl text-sm font-medium transition-all duration-300"
                                        style="background: rgba(45, 74, 62, 0.03); border: 1px solid rgba(45, 74, 62, 0.06); color: #2D4A3E;">
                                    <svg class="w-4 h-4 mr-2 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $option['label'] }}
                                </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Results --}}
                <div x-show="step === 'result'" class="flex justify-start">
                    <div class="chat-bubble-bot max-w-full" x-html="resultHtml"></div>
                </div>

                {{-- Error --}}
                <div x-show="step === 'error'" class="flex justify-start">
                    <div class="chat-bubble-bot">
                        <p class="text-red-500">Maaf, terjadi kesalahan. Silakan coba lagi.</p>
                    </div>
                </div>

                {{-- Loading --}}
                <div x-show="loading" class="flex justify-start">
                    <div class="chat-bubble-bot px-5 py-4">
                        <div class="flex space-x-2">
                            <div class="w-2.5 h-2.5 bg-forest-400 rounded-full typing-dot"></div>
                            <div class="w-2.5 h-2.5 bg-forest-400 rounded-full typing-dot"></div>
                            <div class="w-2.5 h-2.5 bg-forest-400 rounded-full typing-dot"></div>
                        </div>
                    </div>
                </div>

                <div x-ref="bottom"></div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function chatbotApp() {
        return {
            step: 'welcome',
            loading: false,
            messages: [],
            resultHtml: '',

            init() {
                this.$watch('step', () => {
                    this.$nextTick(() => this.scrollToBottom());
                });
            },

            scrollToBottom() {
                const container = this.$refs.messages;
                if (container) container.scrollTop = container.scrollHeight;
            },

            async startChat() {
                this.loading = true;
                this.step = 'loading';
                this.messages.push({ role: 'user', content: 'Mulai' });
                try {
                    await axios.post('{{ route('chatbot.process') }}', {
                        step: 1, _token: '{{ csrf_token() }}'
                    });
                    this.step = 'step2';
                } catch (e) {
                    this.step = 'error';
                } finally {
                    this.loading = false;
                }
            },

            async pilihKategori(id) {
                this.loading = true;
                this.step = 'loading';
                this.messages.push({ role: 'user', content: 'Memilih kategori...' });
                try {
                    const res = await axios.post('{{ route('chatbot.process') }}', {
                        step: 2, id_kategori: id, _token: '{{ csrf_token() }}'
                    });
                    this.step = 'step3';
                } catch (e) {
                    this.step = 'error';
                } finally {
                    this.loading = false;
                }
            },

            async pilihJarak(jarak) {
                this.loading = true;
                this.step = 'loading';
                this.messages.push({ role: 'user', content: 'Memilih jarak...' });
                try {
                    const res = await axios.post('{{ route('chatbot.process') }}', {
                        step: 3, jarak: jarak, _token: '{{ csrf_token() }}'
                    });
                    this.step = 'step4';
                } catch (e) {
                    this.step = 'error';
                } finally {
                    this.loading = false;
                }
            },

            async pilihAnggaran(anggaran) {
                this.loading = true;
                this.step = 'loading';
                this.messages.push({ role: 'user', content: 'Memilih anggaran...' });
                try {
                    const res = await axios.post('{{ route('chatbot.final') }}', {
                        anggaran: anggaran, _token: '{{ csrf_token() }}'
                    });
                    this.resultHtml = res.data.html;
                    this.step = 'result';
                } catch (e) {
                    this.step = 'error';
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>
@endpush
@endsection
