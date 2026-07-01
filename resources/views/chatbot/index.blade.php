@extends('layouts.main')

@section('title', 'Tanya Asisten Wisata')
@section('meta_description', 'Tanya rekomendasi destinasi wisata alam di Malang Raya. Chat dengan AI untuk dapat rekomendasi tempat wisata.')

@push('styles')
<style>
    .chat-messages {
        scrollbar-width: thin;
        scrollbar-color: rgba(45, 74, 62, 0.15) transparent;
        height: calc(100vh - 360px);
        min-height: 450px;
    }
    .chat-messages::-webkit-scrollbar { width: 4px; }
    .chat-messages::-webkit-scrollbar-track { background: transparent; }
    .chat-messages::-webkit-scrollbar-thumb { background: rgba(45, 74, 62, 0.15); border-radius: 4px; }
    .typing-dot {
        animation: typingBounce 1.4s infinite ease-in-out both;
    }
    .typing-dot:nth-child(1) { animation-delay: -0.32s; }
    .typing-dot:nth-child(2) { animation-delay: -0.16s; }
    .typing-dot:nth-child(3) { animation-delay: 0s; }
    @keyframes typingBounce {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }
</style>
@endpush

@section('content')
<section class="pt-28 pb-16 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 reveal">
            <span class="text-xs font-medium tracking-widest uppercase text-forest-700/40">Tanya Aja</span>
            <h1 class="text-3xl sm:text-4xl font-display font-bold text-forest-800 mt-2 tracking-tight">Tanya <span class="text-forest-600">Asisten Wisata</span></h1>
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
                    <p class="text-xs" style="color: rgba(201, 168, 76, 0.7);">Online • Tenan golek destinasi?</p>
                </div>
            </div>

            {{-- Messages --}}
            <div class="chat-messages overflow-y-auto p-6 space-y-4 scrollbar-thin" x-ref="messages" id="chat-messages">
                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div :class="msg.role === 'user' ? 'chat-bubble-user' : 'chat-bubble-bot'">
                            <template x-if="!msg.isHtml">
                                <div class="text-sm leading-relaxed whitespace-pre-line" x-text="msg.content"></div>
                            </template>
                            <template x-if="msg.isHtml">
                                <div x-html="msg.content"></div>
                            </template>
                        </div>
                    </div>
                </template>

                <div x-show="messages.length === 0" class="flex justify-start">
                    <div class="chat-bubble-bot">
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(45, 74, 62, 0.08);">
                                    <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                </div>
                                <div>
                                    <p class="font-display font-semibold text-forest-800">Halo!</p>
                                    <p class="text-xs text-forest-700/40">Asisten Wisata</p>
                                </div>
                            </div>
                            <p class="text-forest-700/60">Aku Asisten Wisata Malang. Tanya ae bab destinasi wisata alam nang Malang Raya. Contone: <em>"wisata banyu sing murah nang Batu"</em> utowo <em>"rekomendasi hiking nang sekitar 10 km"</em>.</p>
                            <div class="flex flex-wrap gap-2">
                                <button @click="sendQuick('Rekomendasi wisata alam sing gratis')" class="text-xs px-3 py-1.5 rounded-lg transition-colors" style="background: rgba(45, 74, 62, 0.06); color: #2D4A3E; border: 1px solid rgba(45, 74, 62, 0.1);">Wisata gratis</button>
                                <button @click="sendQuick('Rekomendasi hiking lan camping')" class="text-xs px-3 py-1.5 rounded-lg transition-colors" style="background: rgba(45, 74, 62, 0.06); color: #2D4A3E; border: 1px solid rgba(45, 74, 62, 0.1);">Hiking & Camping</button>
                                <button @click="sendQuick('Wisata banyu nang Batu')" class="text-xs px-3 py-1.5 rounded-lg transition-colors" style="background: rgba(45, 74, 62, 0.06); color: #2D4A3E; border: 1px solid rgba(45, 74, 62, 0.1);">Wisata banyu</button>
                            </div>
                        </div>
                    </div>
                </div>

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

            {{-- Input --}}
            <div class="px-6 py-4 border-t" style="border-color: rgba(45, 74, 62, 0.08);">
                <form @submit.prevent="sendMessage" class="flex space-x-3">
                    <input type="text" x-model="inputMessage" placeholder="Tanya bab wisata Malang..."
                           class="flex-1 px-4 py-2.5 rounded-xl text-sm border transition-colors outline-none"
                           style="background: rgba(45, 74, 62, 0.03); border-color: rgba(45, 74, 62, 0.1); color: #2D4A3E;"
                           :disabled="loading">
                    <button type="submit" :disabled="loading || !inputMessage.trim()"
                            class="px-5 py-2.5 rounded-xl font-semibold text-sm transition-all duration-300 disabled:opacity-40"
                            style="background: #2D4A3E; color: #FAF5EB;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function chatbotApp() {
        return {
            messages: [],
            inputMessage: '',
            loading: false,

            init() {
                this.$watch('messages', () => {
                    this.$nextTick(() => this.scrollToBottom());
                });
            },

            scrollToBottom() {
                const container = this.$refs.messages;
                if (container) container.scrollTop = container.scrollHeight;
            },

            sendQuick(text) {
                this.inputMessage = text;
                this.sendMessage();
            },

            async sendMessage() {
                const msg = this.inputMessage.trim();
                if (!msg || this.loading) return;

                this.messages.push({ role: 'user', content: msg });
                this.inputMessage = '';
                this.loading = true;

                try {
                    const res = await axios.post('{{ route('chatbot.chat') }}', {
                        message: msg,
                        _token: '{{ csrf_token() }}'
                    });

                    if (res.data.success) {
                        this.messages.push({ role: 'bot', content: res.data.reply });
                        if (res.data.destinasiHtml) {
                            this.messages.push({ role: 'bot', content: res.data.destinasiHtml, isHtml: true });
                        }
                    }
                } catch (e) {
                    this.messages.push({ role: 'bot', content: 'Maaf, terjadi kesalahan. Coba kirim maneh yo.' });
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>
@endpush
@endsection
