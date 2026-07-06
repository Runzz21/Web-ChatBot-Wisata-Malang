@extends('layouts.main')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<section class="min-h-screen flex items-center justify-center px-4" style="padding-top: 6rem;">
    <div class="text-center max-w-md">
        <p class="text-8xl sm:text-9xl font-display font-bold text-leaf-600/20">404</p>
        <h1 class="text-2xl font-display font-bold text-ink mt-4">Halaman Tidak Ditemukan</h1>
        <p class="text-ink/50 mt-2">Halaman yang kamu cari tidak ada atau telah dipindahkan.</p>
        <a href="{{ route('home') }}" class="btn-primary mt-8 inline-flex">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Kembali ke Beranda
        </a>
    </div>
</section>
@endsection
