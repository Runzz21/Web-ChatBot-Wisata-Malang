<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <svg class="w-8 h-8 text-primary-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <span class="font-display font-bold text-xl">Wisata<span class="text-primary-400">Malang</span></span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Platform informasi wisata alam terbaik di Malang Raya. Temukan dan jelajahi keindahan alam Malang bersama kami.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-lg mb-4">Navigasi</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-primary-400 text-sm transition-colors">Beranda</a></li>
                    <li><a href="{{ route('destinasi.index') }}" class="text-gray-400 hover:text-primary-400 text-sm transition-colors">Destinasi</a></li>
                    <li><a href="{{ route('chatbot.index') }}" class="text-gray-400 hover:text-primary-400 text-sm transition-colors">Rekomendasi</a></li>
                    <li><a href="{{ route('tentang') }}" class="text-gray-400 hover:text-primary-400 text-sm transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}" class="text-gray-400 hover:text-primary-400 text-sm transition-colors">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold text-lg mb-4">Kontak</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 mt-0.5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Malang Raya, Jawa Timur, Indonesia</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>info@wisatamalang.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Wisata Alam Malang. All rights reserved.</p>
        </div>
    </div>
</footer>
