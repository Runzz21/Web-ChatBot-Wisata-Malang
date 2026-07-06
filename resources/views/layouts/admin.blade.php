<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Wisata Malang Admin</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%232D4A3E'/%3E%3Cstop offset='100%25' stop-color='%230E1D18'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='100' height='100' rx='20' fill='url(%23g)'/%3E%3Cpath d='M30 75 L50 25 L70 75 L50 60 Z' fill='%23C9A84C'/%3E%3C/svg%3E">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-canvas text-ink antialiased">
    <div class="min-h-screen flex">
        {{-- Sidebar Desktop --}}
        <aside class="w-64 bg-ink text-white/80 flex-shrink-0 hidden lg:flex lg:flex-col relative overflow-hidden">
            <div class="absolute inset-0 opacity-[0.03] bg-noise"></div>
            <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold-500/20 to-transparent"></div>

            <div class="relative z-10 px-5 pt-5 pb-4 border-b border-white/5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-9 h-9 rounded-lg bg-gold-500/15 flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                        <svg class="w-5 h-5 text-gold-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <div>
                        <p class="font-display font-semibold text-white text-base tracking-tight">Wisata<span class="text-gold-500">Malang</span></p>
                        <p class="text-[0.6875rem] text-white/40 font-mono tracking-widest uppercase">Admin Panel</p>
                    </div>
                </a>
            </div>

            <nav class="relative z-10 flex-1 px-3 py-5 space-y-1 overflow-y-auto">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'admin.kategori.*', 'label' => 'Kategori', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                        ['route' => 'admin.destinasi.*', 'label' => 'Destinasi', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['route' => 'admin.chatbot-log.*', 'label' => 'Chatbot Log', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                    ];
                @endphp
                @foreach($navItems as $item)
                @php $isActive = request()->routeIs($item['route']); @endphp
                <a href="{{ route(str_replace('*', 'index', $item['route'])) }}"
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-300 relative group {{ $isActive ? 'bg-white/10 text-white' : 'text-white/45 hover:bg-white/5 hover:text-white/70' }}">
                    @if($isActive)
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 w-[2px] h-5 rounded-r-full bg-gold-500"></span>
                    @endif
                    <svg class="w-4 h-4 mr-3 flex-shrink-0 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/></svg>
                    {{ $item['label'] }}
                </a>
                @endforeach
            </nav>

            <div class="relative z-10 p-4 border-t border-white/5">
                <div class="flex items-center mb-3 group cursor-pointer">
                    <div class="w-8 h-8 rounded-xl bg-gold-500/15 flex items-center justify-center text-gold-500 font-bold text-sm font-mono transition-transform duration-300 group-hover:scale-105">
                        {{ substr(session('admin_username'), 0, 1) }}
                    </div>
                    <div class="ml-3 flex-1 min-w-0">
                        <p class="text-sm text-white/60 font-medium truncate">{{ session('admin_username') }}</p>
                        <p class="text-[0.625rem] text-white/30 font-mono tracking-wider">Administrator</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-3 py-2 text-xs text-white/30 hover:text-red-400 hover:bg-red-500/5 rounded-lg transition-all duration-300">
                        <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col min-h-screen">
            {{-- Mobile Header --}}
            <header class="lg:hidden glass-nav shadow-warm">
                <div class="flex items-center justify-between px-4 py-3">
                    <button x-data @click="$refs.mobileMenu.classList.toggle('hidden')" class="text-leaf-600 p-2 hover:bg-leaf-600/5 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded bg-gold-500/15 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-gold-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        </div>
                        <span class="font-display font-semibold text-leaf-700 tracking-tight">Wisata<span class="text-gold-500">Malang</span></span>
                    </div>
                    <div class="w-6"></div>
                </div>
            </header>

            {{-- Mobile Menu --}}
            <div x-ref="mobileMenu" class="hidden lg:hidden bg-canvas/95 backdrop-blur-lg border-b border-ink/10 shadow-warm">
                <nav class="px-2 py-3 space-y-1">
                    @foreach($navItems as $item)
                    @php $isActive = request()->routeIs($item['route']); @endphp
                    <a href="{{ route(str_replace('*', 'index', $item['route'])) }}"
                       class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ $isActive ? 'text-leaf-600 bg-leaf-600/5' : 'text-ink/60 hover:bg-leaf-600/5' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/></svg>
                        {{ $item['label'] }}
                    </a>
                    @endforeach
                    <hr class="my-2 border-ink/10">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2.5 rounded-lg text-sm font-medium text-red-500 hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                </nav>
            </div>

            {{-- Content --}}
            <main class="flex-1 p-4 md:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 3000, showConfirmButton: false, background: '#FDFBF7', color: '#0E1D18', confirmButtonColor: '#2D4A3E', iconColor: '#C9A84C' });
            @endif
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}', background: '#FDFBF7', color: '#0E1D18', confirmButtonColor: '#2D4A3E', iconColor: '#C9A84C' });
            @endif
        });
    </script>
</body>
</html>
