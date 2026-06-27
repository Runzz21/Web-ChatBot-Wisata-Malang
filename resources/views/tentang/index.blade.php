@extends('layouts.main')

@section('title', 'Tentang')
@section('meta_description', 'Pelajari lebih lanjut tentang Wisata Alam Malang, platform informasi wisata alam terbaik di Malang Raya.')

@push('styles')
<style>
    .hero-tentang {
        background: linear-gradient(135deg, #064E3B 0%, #059669 50%, #10B981 100%);
    }
</style>
@endpush

@section('content')
    {{-- Hero --}}
    <section class="hero-tentang relative overflow-hidden py-20 lg:py-28">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-96 h-96 bg-emerald-200 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-white mb-6">
                Tentang Wisata Alam Malang
            </h1>
            <p class="text-lg sm:text-xl text-emerald-100 leading-relaxed max-w-2xl mx-auto">
                Platform informasi wisata alam terpercaya yang membantu kamu menemukan dan menjelajahi keindahan alam Malang Raya.
            </p>
        </div>
    </section>

    {{-- Visi & Misi --}}
    <section class="py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-display font-bold text-gray-900 mb-6">Visi Kami</h2>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        Menjadi platform informasi wisata alam terdepan di Indonesia yang memudahkan setiap orang untuk menemukan, menjelajahi, dan menikmati keindahan alam Malang Raya.
                    </p>
                </div>
                <div class="bg-primary-50 rounded-3xl p-8 lg:p-10">
                    <h2 class="text-3xl sm:text-4xl font-display font-bold text-gray-900 mb-6">Misi Kami</h2>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-bold">1</span>
                            <span class="text-gray-600">Menyediakan informasi lengkap dan akurat tentang destinasi wisata alam di Malang Raya.</span>
                        </li>
                        <li class="flex items-start space-x-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-bold">2</span>
                            <span class="text-gray-600">Membantu wisatawan menemukan destinasi yang sesuai dengan preferensi dan kebutuhan mereka.</span>
                        </li>
                        <li class="flex items-start space-x-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-bold">3</span>
                            <span class="text-gray-600">Mempromosikan keindahan dan kekayaan alam Malang Raya kepada wisatawan lokal maupun mancanegara.</span>
                        </li>
                        <li class="flex items-start space-x-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-bold">4</span>
                            <span class="text-gray-600">Mendukung pengembangan wisata alam yang berkelanjutan dan ramah lingkungan.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Description --}}
    <section class="py-16 lg:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl sm:text-4xl font-display font-bold text-gray-900 mb-6">Apa Itu Wisata Alam Malang?</h2>
                <div class="text-gray-600 leading-relaxed space-y-4 text-lg">
                    <p>
                        Wisata Alam Malang adalah platform informasi wisata alam yang menyediakan data lengkap tentang berbagai destinasi wisata alam di Malang Raya. Mulai dari gunung, air terjun, pantai, hingga pemandian air panas, semua bisa kamu temukan di sini.
                    </p>
                    <p>
                        Kami menyajikan informasi detail seperti lokasi, harga tiket masuk, jarak tempuh, fasilitas yang tersedia, jam operasional, dan galeri foto untuk setiap destinasi. Dengan sistem rekomendasi cerdas kami, kamu bisa dengan mudah menemukan destinasi wisata yang sesuai dengan keinginanmu.
                    </p>
                    <p>
                        Dibangun dengan semangat untuk mempromosikan keindahan alam Malang Raya, kami berkomitmen untuk terus memperbarui dan menambah informasi destinasi wisata agar kamu selalu mendapatkan informasi terbaru dan terpercaya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Statistik --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="text-center p-6">
                    <p class="text-4xl font-display font-bold text-primary-600">{{ $totalDestinasi ?? '0' }}+</p>
                    <p class="text-gray-500 mt-2">Destinasi Wisata</p>
                </div>
                <div class="text-center p-6">
                    <p class="text-4xl font-display font-bold text-primary-600">{{ $totalKategori ?? '0' }}+</p>
                    <p class="text-gray-500 mt-2">Kategori Wisata</p>
                </div>
                <div class="text-center p-6">
                    <p class="text-4xl font-display font-bold text-primary-600">{{ $totalKunjungan ?? '0' }}+</p>
                    <p class="text-gray-500 mt-2">Kunjungan</p>
                </div>
            </div>
        </div>
    </section>
@endsection
