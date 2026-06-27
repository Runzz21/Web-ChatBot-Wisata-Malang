@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <span class="label-mono text-accent mb-2 block">ADMIN</span>
    <h1 class="text-2xl font-display font-semibold text-primary-800">Dashboard</h1>
    <p class="text-[#5A6B55] mt-1">Selamat datang di panel admin LERENG</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="card-hover p-6 flex items-center space-x-4">
        <div class="w-14 h-14 bg-accent/10 rounded-2xl flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div>
            <p class="text-3xl font-display font-semibold text-primary-800">{{ $totalDestinasi }}</p>
            <p class="text-sm text-[#5A6B55] font-medium">Total Destinasi</p>
        </div>
    </div>

    <div class="card-hover p-6 flex items-center space-x-4">
        <div class="w-14 h-14 bg-accent/10 rounded-2xl flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        </div>
        <div>
            <p class="text-3xl font-display font-semibold text-primary-800">{{ $totalKategori }}</p>
            <p class="text-sm text-[#5A6B55] font-medium">Total Kategori</p>
        </div>
    </div>

    <div class="card-hover p-6 flex items-center space-x-4">
        <div class="w-14 h-14 bg-accent/10 rounded-2xl flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <p class="text-3xl font-display font-semibold text-primary-800">{{ $totalGaleri }}</p>
            <p class="text-sm text-[#5A6B55] font-medium">Total Galeri</p>
        </div>
    </div>

    <div class="card-hover p-6 flex items-center space-x-4">
        <div class="w-14 h-14 bg-accent/10 rounded-2xl flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
        </div>
        <div>
            <p class="text-3xl font-display font-semibold text-primary-800">{{ $totalChatbot }}</p>
            <p class="text-sm text-[#5A6B55] font-medium">Pencarian Chatbot</p>
        </div>
    </div>
</div>

<div class="mt-10">
    <h2 class="text-lg font-display font-semibold text-primary-800 mb-5">Akses Cepat</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.destinasi.index') }}"
           class="card-hover p-5 flex items-center gap-4 group">
            <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-accent/20 transition-colors">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="flex-1">
                <p class="font-medium text-primary-800 group-hover:text-accent transition-colors">Kelola Destinasi</p>
                <p class="text-xs text-[#5A6B55] mt-0.5">Tambah, edit, hapus destinasi</p>
            </div>
            <svg class="w-5 h-5 text-[#5A6B55] group-hover:text-accent group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        <a href="{{ route('admin.kategori.index') }}"
           class="card-hover p-5 flex items-center gap-4 group">
            <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-accent/20 transition-colors">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <div class="flex-1">
                <p class="font-medium text-primary-800 group-hover:text-accent transition-colors">Kelola Kategori</p>
                <p class="text-xs text-[#5A6B55] mt-0.5">Atur kategori destinasi</p>
            </div>
            <svg class="w-5 h-5 text-[#5A6B55] group-hover:text-accent group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        <a href="{{ route('admin.chatbot-log.index') }}"
           class="card-hover p-5 flex items-center gap-4 group">
            <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-accent/20 transition-colors">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </div>
            <div class="flex-1">
                <p class="font-medium text-primary-800 group-hover:text-accent transition-colors">Lihat Chatbot Log</p>
                <p class="text-xs text-[#5A6B55] mt-0.5">Analisis preferensi wisatawan</p>
            </div>
            <svg class="w-5 h-5 text-[#5A6B55] group-hover:text-accent group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        <a href="{{ route('admin.destinasi.create') }}"
           class="card-hover p-5 flex items-center gap-4 group border-2 border-dashed border-accent/30 hover:border-accent/60">
            <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-accent/20 transition-colors">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </div>
            <div class="flex-1">
                <p class="font-medium text-accent group-hover:text-accent/80 transition-colors">Tambah Destinasi Baru</p>
                <p class="text-xs text-[#5A6B55] mt-0.5">Lengkapi data destinasi wisata</p>
            </div>
            <svg class="w-5 h-5 text-accent group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</div>
@endsection
