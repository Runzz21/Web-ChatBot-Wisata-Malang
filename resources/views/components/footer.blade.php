<footer class="relative bg-forest-900 text-cream-50/70 overflow-hidden">
    <div class="absolute inset-0 opacity-[0.04] bg-noise"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-gold-500/20 to-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-16">
            <div class="md:col-span-5">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gold-500/15 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gold-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <span class="font-display font-bold text-xl text-cream-50">Wisata<span class="text-gold-500">Malang</span></span>
                </div>
                <p class="text-cream-50/50 text-sm leading-relaxed max-w-sm">
                    Platform informasi wisata alam terbaik di Malang Raya. Temukan dan jelajahi keindahan alam Malang bersama kami.
                </p>
                <div class="flex items-center space-x-4 mt-6">
                    <a href="#" class="w-9 h-9 rounded-lg bg-cream-50/5 flex items-center justify-center hover:bg-gold-500/15 hover:text-gold-500 transition-all duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-cream-50/5 flex items-center justify-center hover:bg-gold-500/15 hover:text-gold-500 transition-all duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <div class="md:col-span-3">
                <h3 class="font-display font-semibold text-cream-50 text-sm uppercase tracking-widest mb-5">Navigasi</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-sm text-cream-50/50 hover:text-gold-500 transition-colors duration-300">Beranda</a></li>
                    <li><a href="{{ route('destinasi.index') }}" class="text-sm text-cream-50/50 hover:text-gold-500 transition-colors duration-300">Destinasi</a></li>
                    <li><a href="{{ route('chatbot.index') }}" class="text-sm text-cream-50/50 hover:text-gold-500 transition-colors duration-300">Rekomendasi</a></li>
                    <li><a href="{{ route('tentang') }}" class="text-sm text-cream-50/50 hover:text-gold-500 transition-colors duration-300">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}" class="text-sm text-cream-50/50 hover:text-gold-500 transition-colors duration-300">Kontak</a></li>
                </ul>
            </div>

            <div class="md:col-span-4">
                <h3 class="font-display font-semibold text-cream-50 text-sm uppercase tracking-widest mb-5">Kontak</h3>
                <ul class="space-y-4">
                    <li class="flex items-start space-x-3">
                        <svg class="w-4 h-4 mt-0.5 text-gold-500/60 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-sm text-cream-50/50">Malang Raya, Jawa Timur, Indonesia</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-gold-500/60 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:info@wisatamalang.com" class="text-sm text-cream-50/50 hover:text-gold-500 transition-colors duration-300">info@wisatamalang.com</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="relative mt-12 pt-8 border-t border-cream-50/5">
            <p class="text-sm text-cream-50/30 text-center">&copy; {{ date('Y') }} Wisata Alam Malang. All rights reserved.</p>
        </div>
    </div>
</footer>
