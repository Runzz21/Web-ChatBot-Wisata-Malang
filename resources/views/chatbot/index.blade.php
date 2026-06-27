@extends('layouts.main')

@section('title', 'Rekomendasi Wisata')
@section('meta_description', 'Dapatkan rekomendasi destinasi wisata alam di Malang Raya berdasarkan preferensi kamu. Mulai dari kategori, jarak, dan harga.')

@push('styles')
<style>
    .chat-bubble-bot {
        @apply bg-white border border-gray-100 rounded-2xl rounded-tl-none shadow-sm;
    }
    .chat-bubble-user {
        @apply bg-primary-600 text-white rounded-2xl rounded-tr-none shadow-sm;
    }
    .chat-messages {
        scrollbar-width: thin;
        scrollbar-color: #D1D5DB transparent;
        height: calc(100vh - 280px);
        min-height: 450px;
    }
    .chat-messages::-webkit-scrollbar { width: 4px; }
    .chat-messages::-webkit-scrollbar-thumb { background-color: #D1D5DB; border-radius: 4px; }
    .typing-dot {
        animation: typing-bounce 1.4s infinite ease-in-out both;
    }
    .typing-dot:nth-child(1) { animation-delay: -0.32s; }
    .typing-dot:nth-child(2) { animation-delay: -0.16s; }
    @keyframes typing-bounce {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }
</style>
@endpush

@section('content')
<section class="py-10 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl sm:text-4xl font-display font-bold text-gray-900">Rekomendasi Wisata</h1>
            <p class="text-gray-500 mt-2">Dapatkan rekomendasi destinasi wisata sesuai keinginanmu</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
             x-data="chatbotApp()"
             x-init="init()">
            <div class="bg-primary-600 px-6 py-4 flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                </div>
                <div>
                    <h3 class="font-display font-semibold text-white">Asisten Wisata</h3>
                    <p class="text-xs text-emerald-200">Online</p>
                </div>
            </div>

            <div class="chat-messages overflow-y-auto p-6 space-y-4" x-ref="messages" id="chat-messages">
                {{-- Welcome Step --}}
                <div x-show="step === 'welcome'" class="flex justify-start">
                    <div class="chat-bubble-bot max-w-[80%] px-5 py-3">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                </div>
                                <div>
                                    <p class="font-display font-semibold text-gray-900">Halo!</p>
                                    <p class="text-xs text-gray-400">Asisten Wisata</p>
                                </div>
                            </div>
                            <p class="text-gray-600">Selamat datang di Rekomendasi Wisata Alam Malang! Saya akan membantu kamu menemukan destinasi wisata yang tepat. Yuk, kita mulai!</p>
                            <button @click="startChat" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors">
                                Mulai
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- User messages --}}
                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div :class="msg.role === 'user' ? 'chat-bubble-user' : 'chat-bubble-bot'"
                             class="max-w-[80%] px-5 py-3">
                            <div class="text-sm leading-relaxed" x-text="msg.content"></div>
                        </div>
                    </div>
                </template>

                {{-- Step 2: Kategori --}}
                <div x-show="step === 'step2'" class="flex justify-start">
                    <div class="chat-bubble-bot max-w-full px-5 py-3">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center text-sm font-bold text-primary-600">1</span>
                                <div>
                                    <p class="font-display font-semibold text-gray-900">Pilih Kategori</p>
                                    <p class="text-xs text-gray-400">Destinasi apa yang kamu cari?</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                <button @click="pilihKategori('')"
                                        class="flex flex-col items-center p-4 bg-gray-50 rounded-xl border-2 border-transparent hover:border-primary-500 hover:bg-primary-50 transition-all duration-200">
                                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                    <span class="text-sm font-medium text-gray-700">Semua Kategori</span>
                                </button>
                                @foreach($kategoriList as $kategori)
                                <button @click="pilihKategori({{ $kategori->id_kategori }})"
                                        class="flex flex-col items-center p-4 bg-gray-50 rounded-xl border-2 border-transparent hover:border-primary-500 hover:bg-primary-50 transition-all duration-200">
                                    <div class="w-8 h-8 flex items-center justify-center mb-2 text-2xl">
                                        {!! $kategori->icon ?? '<svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>' !!}
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">{{ $kategori->nama_kategori }}</span>
                                </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Step 3: Jarak --}}
                <div x-show="step === 'step3'" class="flex justify-start">
                    <div class="chat-bubble-bot max-w-full px-5 py-3">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center text-sm font-bold text-primary-600">2</span>
                                <div>
                                    <p class="font-display font-semibold text-gray-900">Pilih Jarak Tempuh</p>
                                    <p class="text-xs text-gray-400">Seberapa jauh destinasi yang kamu inginkan?</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($jarakOptions as $option)
                                <button @click="pilihJarak('{{ $option['value'] }}')"
                                        class="flex items-center justify-center p-4 bg-gray-50 rounded-xl border-2 border-transparent hover:border-primary-500 hover:bg-primary-50 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                    <span class="text-sm font-medium text-gray-700">{{ $option['label'] }}</span>
                                </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Step 4: Anggaran --}}
                <div x-show="step === 'step4'" class="flex justify-start">
                    <div class="chat-bubble-bot max-w-full px-5 py-3">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center text-sm font-bold text-primary-600">3</span>
                                <div>
                                    <p class="font-display font-semibold text-gray-900">Pilih Anggaran</p>
                                    <p class="text-xs text-gray-400">Berapa budget yang kamu siapkan?</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($anggaranOptions as $option)
                                <button @click="pilihAnggaran('{{ $option['value'] }}')"
                                        class="flex items-center justify-center p-4 bg-gray-50 rounded-xl border-2 border-transparent hover:border-primary-500 hover:bg-primary-50 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-sm font-medium text-gray-700">{{ $option['label'] }}</span>
                                </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Results --}}
                <div x-show="step === 'result'" class="flex justify-start">
                    <div class="chat-bubble-bot max-w-full px-5 py-3" x-html="resultHtml"></div>
                </div>

                {{-- Error --}}
                <div x-show="step === 'error'" class="flex justify-start">
                    <div class="chat-bubble-bot max-w-[80%] px-5 py-3">
                        <p class="text-red-500">Maaf, terjadi kesalahan. Silakan coba lagi.</p>
                    </div>
                </div>

                {{-- Loading --}}
                <div x-show="loading" class="flex justify-start">
                    <div class="chat-bubble-bot px-5 py-4">
                        <div class="flex space-x-2">
                            <div class="w-2.5 h-2.5 bg-primary-400 rounded-full typing-dot"></div>
                            <div class="w-2.5 h-2.5 bg-primary-400 rounded-full typing-dot"></div>
                            <div class="w-2.5 h-2.5 bg-primary-400 rounded-full typing-dot"></div>
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
