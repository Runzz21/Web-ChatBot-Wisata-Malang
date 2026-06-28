<nav x-data="{ mobileOpen: false }"
     data-navbar
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 bg-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-18 items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2.5 group">
                <div class="w-9 h-9 rounded-lg bg-forest-600 flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                    <svg class="w-5 h-5 text-cream-50" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <span class="font-display font-bold text-lg text-forest-800 tracking-tight">Wisata<span class="text-gold-500">Malang</span></span>
            </a>

            <div class="hidden md:flex md:items-center md:space-x-1">
                <a href="{{ route('home') }}" class="relative px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'text-forest-600' : 'text-forest-700/70 hover:text-forest-600' }} transition-colors duration-300 link-underline">
                    Beranda
                </a>
                <a href="{{ route('destinasi.index') }}" class="relative px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('destinasi.*') ? 'text-forest-600' : 'text-forest-700/70 hover:text-forest-600' }} transition-colors duration-300 link-underline">
                    Destinasi
                </a>
                <a href="{{ route('chatbot.index') }}" class="relative px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('chatbot.*') ? 'text-forest-600' : 'text-forest-700/70 hover:text-forest-600' }} transition-colors duration-300 link-underline">
                    Rekomendasi
                </a>
                <a href="{{ route('tentang') }}" class="relative px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tentang') ? 'text-forest-600' : 'text-forest-700/70 hover:text-forest-600' }} transition-colors duration-300 link-underline">
                    Tentang
                </a>
                <a href="{{ route('kontak') }}" class="relative px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('kontak') ? 'text-forest-600' : 'text-forest-700/70 hover:text-forest-600' }} transition-colors duration-300 link-underline">
                    Kontak
                </a>
            </div>

            <div class="md:hidden flex items-center">
                <button @click="mobileOpen = !mobileOpen" class="p-2.5 rounded-lg text-forest-600 hover:bg-forest-600/5 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileOpen, 'block': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'block': mobileOpen, 'hidden': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileOpen" class="md:hidden border-t border-forest-600/10 bg-cream-50/95 backdrop-blur-lg" x-cloak>
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-lg text-sm {{ request()->routeIs('home') ? 'text-forest-600 bg-forest-600/5 font-semibold' : 'text-forest-700/70 hover:bg-forest-600/5' }} transition-colors">Beranda</a>
            <a href="{{ route('destinasi.index') }}" class="block px-4 py-2.5 rounded-lg text-sm {{ request()->routeIs('destinasi.*') ? 'text-forest-600 bg-forest-600/5 font-semibold' : 'text-forest-700/70 hover:bg-forest-600/5' }} transition-colors">Destinasi</a>
            <a href="{{ route('chatbot.index') }}" class="block px-4 py-2.5 rounded-lg text-sm {{ request()->routeIs('chatbot.*') ? 'text-forest-600 bg-forest-600/5 font-semibold' : 'text-forest-700/70 hover:bg-forest-600/5' }} transition-colors">Rekomendasi</a>
            <a href="{{ route('tentang') }}" class="block px-4 py-2.5 rounded-lg text-sm {{ request()->routeIs('tentang') ? 'text-forest-600 bg-forest-600/5 font-semibold' : 'text-forest-700/70 hover:bg-forest-600/5' }} transition-colors">Tentang</a>
            <a href="{{ route('kontak') }}" class="block px-4 py-2.5 rounded-lg text-sm {{ request()->routeIs('kontak') ? 'text-forest-600 bg-forest-600/5 font-semibold' : 'text-forest-700/70 hover:bg-forest-600/5' }} transition-colors">Kontak</a>
        </div>
    </div>
</nav>
