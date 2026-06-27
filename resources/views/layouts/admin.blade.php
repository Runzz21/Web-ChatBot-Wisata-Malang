<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | LERENG Admin</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏔️</text></svg>">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#EDF1EA]">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-primary-900 text-white flex-shrink-0 hidden lg:flex lg:flex-col">
            <div class="p-5 border-b border-primary-800">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-display font-semibold text-white tracking-tight">
                    LERENG
                </a>
                <p class="text-sm text-primary-300 mt-1 font-mono tracking-wide">Admin Panel</p>
            </div>
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-accent text-white' : 'text-primary-200 hover:bg-primary-800 hover:text-white' }} transition-colors text-sm font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.kategori.index') }}"
                   class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.kategori.*') ? 'bg-accent text-white' : 'text-primary-200 hover:bg-primary-800 hover:text-white' }} transition-colors text-sm font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    Kategori
                </a>
                <a href="{{ route('admin.destinasi.index') }}"
                   class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.destinasi.*') ? 'bg-accent text-white' : 'text-primary-200 hover:bg-primary-800 hover:text-white' }} transition-colors text-sm font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Destinasi
                </a>
                <a href="{{ route('admin.chatbot-log.index') }}"
                   class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.chatbot-log.*') ? 'bg-accent text-white' : 'text-primary-200 hover:bg-primary-800 hover:text-white' }} transition-colors text-sm font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Chatbot Log
                </a>
            </nav>
            <div class="p-4 border-t border-primary-800">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center text-white font-bold text-sm font-mono">
                        {{ substr(session('admin_username'), 0, 1) }}
                    </div>
                    <span class="ml-3 text-sm text-primary-200 font-medium">{{ session('admin_username') }}</span>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm text-primary-300 hover:text-white hover:bg-primary-800 rounded-xl transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-h-screen">
            <header class="bg-[#FAFBF7]/95 backdrop-blur shadow-lereng-sm lg:hidden">
                <div class="flex items-center justify-between px-4 py-3">
                    <button x-data @click="$refs.mobileMenu.classList.toggle('hidden')" class="text-[#5A6B55] p-2 hover:bg-primary-50 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <span class="font-display font-semibold text-primary-800 tracking-tight">LERENG</span>
                    <div class="w-6"></div>
                </div>
            </header>

            <div x-ref="mobileMenu" class="hidden lg:hidden bg-[#FAFBF7] border-b border-primary-100 shadow-lereng-sm">
                <nav class="px-2 py-3 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-accent/10 text-accent' : 'text-[#5A6B55] hover:bg-primary-50' }}">Dashboard</a>
                    <a href="{{ route('admin.kategori.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.kategori.*') ? 'bg-accent/10 text-accent' : 'text-[#5A6B55] hover:bg-primary-50' }}">Kategori</a>
                    <a href="{{ route('admin.destinasi.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.destinasi.*') ? 'bg-accent/10 text-accent' : 'text-[#5A6B55] hover:bg-primary-50' }}">Destinasi</a>
                    <a href="{{ route('admin.chatbot-log.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.chatbot-log.*') ? 'bg-accent/10 text-accent' : 'text-[#5A6B55] hover:bg-primary-50' }}">Chatbot Log</a>
                    <hr class="my-2 border-primary-100">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2.5 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50">Logout</button>
                    </form>
                </nav>
            </div>

            <main class="flex-1 p-4 md:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 3000, showConfirmButton: false });
            @endif
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}', confirmButtonColor: '#dc2626' });
            @endif
        });
    </script>
</body>
</html>
