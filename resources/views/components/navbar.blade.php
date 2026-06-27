<nav x-data="{ mobileOpen: false }" class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <span class="font-display font-bold text-xl text-gray-900">Wisata<span class="text-primary-600">Malang</span></span>
                </a>
            </div>

            <div class="hidden md:flex md:items-center md:space-x-1">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50' }} transition-colors">Beranda</a>
                <a href="{{ route('destinasi.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('destinasi.*') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50' }} transition-colors">Destinasi</a>
                <a href="{{ route('chatbot.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('chatbot.*') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50' }} transition-colors">Rekomendasi</a>
                <a href="{{ route('tentang') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tentang') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50' }} transition-colors">Tentang</a>
                <a href="{{ route('kontak') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('kontak') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50' }} transition-colors">Kontak</a>
            </div>

            <div class="md:hidden flex items-center">
                <button @click="mobileOpen = !mobileOpen" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileOpen, 'block': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'block': mobileOpen, 'hidden': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileOpen" class="md:hidden border-t bg-white" x-cloak>
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('home') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:bg-gray-50' }}">Beranda</a>
            <a href="{{ route('destinasi.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('destinasi.*') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:bg-gray-50' }}">Destinasi</a>
            <a href="{{ route('chatbot.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('chatbot.*') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:bg-gray-50' }}">Rekomendasi</a>
            <a href="{{ route('tentang') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('tentang') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:bg-gray-50' }}">Tentang</a>
            <a href="{{ route('kontak') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('kontak') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:bg-gray-50' }}">Kontak</a>
        </div>
    </div>
</nav>
