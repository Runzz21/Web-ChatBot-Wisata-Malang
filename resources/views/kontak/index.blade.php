@extends('layouts.main')

@section('title', 'Kontak')
@section('meta_description', 'Hubungi tim Wisata Alam Malang untuk pertanyaan, saran, atau informasi lebih lanjut tentang destinasi wisata alam di Malang Raya.')

@push('styles')
<style>
    .hero-kontak {
        background: linear-gradient(135deg, #064E3B 0%, #059669 50%, #10B981 100%);
    }
</style>
@endpush

@section('content')
    {{-- Hero --}}
    <section class="hero-kontak relative overflow-hidden py-20 lg:py-28">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-96 h-96 bg-emerald-200 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-white mb-6">
                Hubungi Kami
            </h1>
            <p class="text-lg sm:text-xl text-emerald-100 leading-relaxed max-w-2xl mx-auto">
                Punya pertanyaan atau saran? Jangan ragu untuk menghubungi kami. Tim kami siap membantu kamu.
            </p>
        </div>
    </section>

    {{-- Contact Content --}}
    <section class="py-16 lg:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
                {{-- Contact Info --}}
                <div class="lg:col-span-2 space-y-6">
                    <h2 class="text-2xl font-display font-bold text-gray-900 mb-2">Informasi Kontak</h2>
                    <p class="text-gray-500 mb-6">Jangan ragu untuk menghubungi kami melalui kontak di bawah ini</p>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start space-x-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display font-semibold text-gray-900">Alamat</h3>
                            <p class="text-gray-500 text-sm mt-1">Malang Raya, Jawa Timur<br>Indonesia</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start space-x-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display font-semibold text-gray-900">Email</h3>
                            <a href="mailto:info@wisatamalang.com" class="text-primary-600 hover:text-primary-700 text-sm mt-1 block transition-colors">
                                info@wisatamalang.com
                            </a>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start space-x-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display font-semibold text-gray-900">Telepon</h3>
                            <a href="tel:+6281234567890" class="text-primary-600 hover:text-primary-700 text-sm mt-1 block transition-colors">
                                +62 812-3456-7890
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-2xl font-display font-bold text-gray-900 mb-2">Kirim Pesan</h2>
                        <p class="text-gray-500 mb-8">Isi form di bawah ini untuk mengirimkan pesan kepada kami</p>

                        <form>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" id="name" name="name"
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow"
                                           placeholder="Masukkan nama lengkap">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email"
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow"
                                           placeholder="Masukkan email">
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                                <input type="text" id="subject" name="subject"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow"
                                       placeholder="Masukkan subjek pesan">
                            </div>
                            <div class="mb-6">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                                <textarea id="message" name="message" rows="5"
                                          class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow resize-none"
                                          placeholder="Tulis pesan kamu di sini..."></textarea>
                            </div>
                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
