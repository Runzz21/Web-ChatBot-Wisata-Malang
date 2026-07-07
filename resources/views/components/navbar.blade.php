<nav x-data="{ mobileOpen: false }"
     data-navbar
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 bg-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-18 items-center">
            <a href="{{ route('home') }}" class="flex items-center group">
                <img src="{{ asset('images/logo.png') }}" alt="WisataMalang" class="h-10 w-auto transition-transform duration-300 group-hover:scale-105">
            </a>

            <div class="hidden md:flex md:items-center md:space-x-1">
                @php
                    $navItems = [
                        ['route' => 'home', 'label' => 'Beranda'],
                        ['route' => 'destinasi.*', 'label' => 'Destinasi'],
                        ['route' => 'chatbot.*', 'label' => 'Rekomendasi'],
                        ['route' => 'tentang', 'label' => 'Tentang'],
                        ['route' => 'kontak', 'label' => 'Kontak'],
                    ];
                @endphp
                @foreach($navItems as $item)
                <a href="{{ route(str_replace('.*', '.index', $item['route'])) }}"
                   class="relative px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-300 link-underline
                   {{ request()->routeIs($item['route']) ? 'text-leaf-600' : 'text-ink/70 hover:text-leaf-600' }}">
                    {{ $item['label'] }}
                    @if(request()->routeIs($item['route']))
                    <span class="absolute -bottom-0.5 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-gold-500"></span>
                    @endif
                </a>
                @endforeach
            </div>

            <div class="md:hidden flex items-center">
                <button @click="mobileOpen = !mobileOpen" class="p-2.5 rounded-xl text-ink hover:bg-leaf-600/5 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileOpen, 'block': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'block': mobileOpen, 'hidden': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileOpen"
         class="md:hidden fixed inset-0 top-18 z-40 bg-canvas/95 backdrop-blur-xl"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="px-6 py-8 space-y-2">
            @foreach($navItems as $item)
            <a href="{{ route(str_replace('.*', '.index', $item['route'])) }}"
               @click="mobileOpen = false"
               class="block px-4 py-4 rounded-xl text-base font-medium transition-colors
               {{ request()->routeIs($item['route']) ? 'text-leaf-600 bg-leaf-600/5 font-semibold border-l-2 border-gold-500' : 'text-ink/70 hover:bg-leaf-600/5 hover:text-leaf-600' }}">
                {{ $item['label'] }}
            </a>
            @endforeach
        </div>
    </div>
</nav>
