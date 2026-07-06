# UI Redesign: Immersive Explorer — Implementation Plan

> **For agentic workers:** This plan transforms all 27+ frontend files. Each task produces independently verifiable visual changes.

**Goal:** Transform all public-facing pages and admin panel from current state to "Immersive Explorer" design — bold, modern, high-impact nature tourism UI.

**Architecture:** Evolves existing Tailwind + Blade + Alpine.js stack. No new dependencies. All changes are CSS/Blade/JS only — no backend modifications.

**Tech Stack:** Laravel Blade, Tailwind CSS v3, Alpine.js v3, SweetAlert2

## Global Constraints

- Do NOT push to GitHub at any point
- Keep all existing backend logic intact (controllers, routes, models)
- Use only existing Tailwind classes + custom CSS in app.css
- All text remains in Indonesian
- No new npm packages

---

### Task 1: Tailwind Config — Colors & Tokens

**Files:**
- Modify: `tailwind.config.js:10-96`

- [ ] **Step 1: Update color palette**

Replace existing color definitions with evolved palette:

```js
colors: {
    ink: '#0E1D18',
    canvas: '#FDFBF7',
    'canvas-alt': '#F5F0E8',
    leaf: {
        50: '#f4f7f4',
        100: '#e3ebe3',
        200: '#c7d7c7',
        300: '#a1bba1',
        400: '#759b75',
        500: '#557e55',
        600: '#2D4A3E',
        700: '#1F362E',
        800: '#152A23',
        900: '#0E1D18',
    },
    gold: {
        400: '#D4A84B',
        500: '#C9A84C',
        600: '#B8943A',
    },
    moss: '#557E55',
    bark: '#8B6F47',
    cream: {
        50: '#FDFBF7',
        100: '#F5F0E8',
        200: '#EDE5D8',
        300: '#E0D4C0',
    },
}
```

- [ ] **Step 2: Add new shadows**

```js
boxShadow: {
    'card': '0 2px 16px rgba(14,29,24,0.05)',
    'card-hover': '0 12px 48px rgba(14,29,24,0.1)',
    'dropdown': '0 8px 32px rgba(14,29,24,0.12)',
    'modal': '0 24px 80px rgba(14,29,24,0.2)',
    'warm': '0 4px 24px rgba(45,74,62,0.08)',
    'warm-lg': '0 8px 40px rgba(45,74,62,0.12)',
    'glass': '0 4px 30px rgba(0,0,0,0.08)',
}
```

- [ ] **Step 3: Add gold glow keyframe and animation**

```js
animation: {
    'float': 'float 6s ease-in-out infinite',
    'gold-pulse': 'goldPulse 3s ease-in-out infinite',
    'fade-up': 'fadeUp 0.7s ease-out forwards',
}
keyframes: {
    goldPulse: {
        '0%, 100%': { opacity: '0.6', transform: 'scale(1)' },
        '50%': { opacity: '1', transform: 'scale(1.05)' },
    }
}
```

- [ ] **Step 4: Verify file**

Run: `npx tailwindcss --help` (just confirm no syntax error)

---

### Task 2: CSS — Component Classes Overhaul

**Files:**
- Modify: `resources/css/app.css`

- [ ] **Step 1: Update body background to use canvas**

Replace `bg-cream-50` with `bg-canvas`:

```css
body {
    @apply font-sans text-ink antialiased bg-canvas;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.02'/%3E%3C/svg%3E");
}
```

- [ ] **Step 2: Redesign buttons**

```css
.btn-primary {
    @apply relative inline-flex items-center justify-center px-8 py-3.5 font-semibold text-sm
    bg-leaf-600 text-white rounded-xl overflow-hidden
    transition-all duration-300 hover:bg-leaf-700;
    box-shadow: 0 4px 16px rgba(45, 74, 62, 0.25);
}
.btn-primary:hover {
    box-shadow: 0 6px 24px rgba(45, 74, 62, 0.35);
    transform: translateY(-1px);
}

.btn-outline {
    @apply relative inline-flex items-center justify-center px-8 py-3.5 font-semibold text-sm
    border-2 border-leaf-600 text-leaf-600 rounded-xl
    overflow-hidden transition-all duration-300;
}
.btn-outline::before {
    content: '';
    @apply absolute inset-0 bg-leaf-600 scale-x-0 origin-left transition-transform duration-300;
}
.btn-outline:hover::before {
    @apply scale-x-100;
}
.btn-outline:hover {
    @apply text-white border-leaf-600;
}
.btn-outline > * {
    @apply relative z-10;
}

.btn-glass {
    @apply relative inline-flex items-center justify-center px-8 py-3.5 font-semibold text-sm
    bg-white/10 backdrop-blur-sm text-white border border-white/20 rounded-xl
    overflow-hidden transition-all duration-300 hover:bg-white/20;
}
.btn-glass:hover {
    @apply border-white/30;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}
```

- [ ] **Step 3: Redesign cards**

```css
.card-image {
    @apply bg-canvas rounded-2xl overflow-hidden transition-all duration-500;
    box-shadow: var(--shadow-card);
    border: 1px solid rgba(14, 29, 24, 0.06);
}
.card-image:hover {
    box-shadow: var(--shadow-card-hover);
    transform: translateY(-8px);
    border-color: rgba(14, 29, 24, 0.1);
}

.card-glass {
    @apply rounded-2xl transition-all duration-500;
    background: rgba(253, 251, 247, 0.8);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(14, 29, 24, 0.06);
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
}
.card-glass:hover {
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
    border-color: rgba(14, 29, 24, 0.1);
}
```

- [ ] **Step 4: Update input styles with gold focus ring**

```css
.input-field {
    @apply w-full px-4 py-3 rounded-xl text-sm transition-all duration-300 outline-none;
    background: rgba(14, 29, 24, 0.03);
    border: 1px solid rgba(14, 29, 24, 0.1);
    color: #152A23;
}
.input-field:focus {
    background: rgba(14, 29, 24, 0.05);
    border-color: #C9A84C;
    box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.15);
}
```

- [ ] **Step 5: Update chat bubbles**

```css
.chat-bubble-user {
    @apply rounded-2xl px-5 py-3 max-w-[80%] ml-auto;
    background: #2D4A3E;
    color: white;
    border-bottom-right-radius: 4px;
}

.chat-bubble-bot {
    @apply rounded-2xl px-5 py-3 max-w-[80%];
    background: white;
    border: 1px solid rgba(14, 29, 24, 0.06);
    border-bottom-left-radius: 4px;
    box-shadow: 0 2px 12px rgba(14, 29, 24, 0.04);
}
```

- [ ] **Step 6: Add counter animation utility**

```css
.counter-value {
    @apply text-5xl sm:text-6xl font-display font-bold text-leaf-600 tracking-tight;
}
```

---

### Task 3: JavaScript — Enhanced Animations

**Files:**
- Modify: `resources/js/app.js`

- [ ] **Step 1: Add counter animation function**

```js
function initCounters() {
    const counters = document.querySelectorAll('[data-counter]');
    counters.forEach(counter => {
        const target = parseInt(counter.dataset.counter);
        const duration = 2000;
        const steps = 60;
        const stepValue = target / steps;
        let current = 0;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const timer = setInterval(() => {
                        current += stepValue;
                        if (current >= target) {
                            counter.textContent = target;
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.floor(current);
                        }
                    }, duration / steps);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        observer.observe(counter);
    });
}
```

- [ ] **Step 2: Add gold particle animation for hero**

```js
function initHeroParticles(containerSelector) {
    const container = document.querySelector(containerSelector);
    if (!container) return;

    for (let i = 0; i < 8; i++) {
        const particle = document.createElement('div');
        particle.className = 'hero-particle';
        const size = 2 + Math.random() * 4;
        Object.assign(particle.style, {
            position: 'absolute',
            width: size + 'px',
            height: size + 'px',
            borderRadius: '50%',
            background: 'rgba(201, 168, 76, ' + (0.15 + Math.random() * 0.2) + ')',
            left: Math.random() * 100 + '%',
            top: Math.random() * 100 + '%',
            animation: 'float ' + (5 + Math.random() * 4) + 's ease-in-out ' + (Math.random() * 3) + 's infinite',
            pointerEvents: 'none',
            zIndex: '1',
        });
        container.appendChild(particle);
    }
}
```

- [ ] **Step 3: Call all functions in DOMContentLoaded**

```js
document.addEventListener('DOMContentLoaded', () => {
    initRevealAnimations();
    initNavbarScroll();
    initCounters();
    initHeroParticles('.hero-section');
});
```

---

### Task 4: Navbar Component — Redesign

**Files:**
- Modify: `resources/views/components/navbar.blade.php`

- [ ] **Step 1: Replace entire navbar with redesigned version**

Key changes:
- Logo container: rounded-xl with gold tint
- Nav links: DM Sans 500, `link-underline` hover
- Active page: gold dot indicator
- Mobile: full-height overlay menu with blur backdrop

```blade
<nav x-data="{ mobileOpen: false }"
     data-navbar
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 bg-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-18 items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 rounded-xl bg-leaf-600/10 flex items-center justify-center transition-all duration-300 group-hover:bg-leaf-600/20 group-hover:scale-105">
                    <svg class="w-5 h-5 text-leaf-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <span class="font-display font-bold text-xl text-ink tracking-tight">Wisata<span class="text-gold-500">Malang</span></span>
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
```

---

### Task 5: Footer Component — Redesign

**Files:**
- Modify: `resources/views/components/footer.blade.php`

- [ ] **Step 1: Replace footer with redesigned version**

Key changes:
- 4-column grid (brand 3, nav 3, contact 3, social 3)
- Gold gradient top border
- Social icon hover: gold tint + scale
- Better typography hierarchy

---

### Task 6: Main Layout — Refine

**Files:**
- Modify: `resources/views/layouts/main.blade.php`

- [ ] **Step 1: Update body class to use new tokens**

Change `bg-cream-50 text-forest-800` to `bg-canvas text-ink`

- [ ] **Step 2: Update favicon to be more professional**

Replace emoji favicon with SVG mountain logo

- [ ] **Step 3: Update SweetAlert2 config to match new colors**

```js
Swal.fire({
    background: '#FDFBF7',
    color: '#0E1D18',
    confirmButtonColor: '#2D4A3E',
    iconColor: '#C9A84C',
});
```

---

### Task 7: Homepage — Full Redesign

**Files:**
- Modify: `resources/views/home/index.blade.php`

- [ ] **Step 1: Hero section — add particle container, update typography**

Hero section changes:
- Add `id="hero-particles"` as particle container
- Use `text-ink` for headings
- Gold accent text with glow
- Floating gold particles (via JS in Task 3)

- [ ] **Step 2: Stats bar — add data-counter attributes**

```blade
<p data-counter="{{ $totalDestinasi }}" class="counter-value">0</p>
```

- [ ] **Step 3: Category cards — redesign with circular icons**

Larger circular icon containers, hover gold glow, better spacing

- [ ] **Step 4: Destination cards — image-dominant redesign**

Change card layout:
- aspect-[3/2] image with overlay gradient
- Info overlaid at bottom of image
- Category + 24hr badge on image
- Cleaner typography

- [ ] **Step 5: CTA section — enhance with radial gold glow**

Add subtle radial gradient from gold-500 at center

---

### Task 8: Destinasi Index — Redesign

**Files:**
- Modify: `resources/views/destinasi/index.blade.php`

- [ ] **Step 1: Update page header typography**

Use `text-ink` / `text-leaf-600` color tokens

- [ ] **Step 2: Redesign filter sidebar**

Consistent spacing, better visual hierarchy, sticky positioning

- [ ] **Step 3: Redesign destination cards**

Match the image-dominant card style from homepage

- [ ] **Step 4: Update empty state**

Better illustration and messaging

---

### Task 9: Destinasi Show — Redesign

**Files:**
- Modify: `resources/views/destinasi/show.blade.php`

- [ ] **Step 1: Banner section — refined overlay**

- [ ] **Step 2: Info stats — use counter-value class**

- [ ] **Step 3: Map sidebar — glass card with depth**

- [ ] **Step 4: Gallery — lightbox via SweetAlert2**

- [ ] **Step 5: Rekomendasi section — use card-image class**

---

### Task 10: Tentang Page — Redesign

**Files:**
- Modify: `resources/views/tentang/index.blade.php`

- [ ] **Step 1: Hero section — consistent with other pages**

- [ ] **Step 2: Visi & Misi — refined layout**

- [ ] **Step 3: Stats bar — add data-counter**

---

### Task 11: Kontak Page — Redesign

**Files:**
- Modify: `resources/views/kontak/index.blade.php`

- [ ] **Step 1: Hero section**

- [ ] **Step 2: Contact info cards — use card-glass with hover lift**

- [ ] **Step 3: Form — use input-field class with gold focus**

---

### Task 12: Chatbot Page — Redesign

**Files:**
- Modify: `resources/views/chatbot/index.blade.php`

- [ ] **Step 1: Redesign chat container as glass card**

- [ ] **Step 2: Add avatar to bot messages**

- [ ] **Step 3: Refine quick reply buttons**

- [ ] **Step 4: Better typing indicator styling**

---

### Task 13: Admin Layout — Redesign

**Files:**
- Modify: `resources/views/layouts/admin.blade.php`

- [ ] **Step 1: Sidebar redesign**

Fixed sidebar with icon + label, gold active indicator, better spacing

- [ ] **Step 2: Top bar refinement**

---

### Task 14: Admin Pages — Redesign

**Files:**
- Modify: `resources/views/admin/auth/login.blade.php`
- Modify: `resources/views/admin/dashboard/index.blade.php`
- Modify: `resources/views/admin/destinasi/index.blade.php`
- Modify: `resources/views/admin/destinasi/create.blade.php`
- Modify: `resources/views/admin/destinasi/edit.blade.php`
- Modify: `resources/views/admin/kategori/index.blade.php`
- Modify: `resources/views/admin/kategori/create.blade.php`
- Modify: `resources/views/admin/kategori/edit.blade.php`
- Modify: `resources/views/admin/galeri/index.blade.php`
- Modify: `resources/views/admin/chatbot-log/index.blade.php`

- [ ] **Step 1: Login page — centered card with logo, gold accent**

- [ ] **Step 2: Dashboard — stats cards with icon + gradient + data-counter**

- [ ] **Step 3: Tables — striped rows, sticky header, better cell padding**

- [ ] **Step 4: Forms — grid layout, input-field class, better labels**

- [ ] **Step 5: Gallery — grid with lightbox preview**

---

### Task 15: Error Pages — Redesign

**Files:**
- Modify: `resources/views/errors/404.blade.php`
- Modify: `resources/views/errors/419.blade.php`
- Modify: `resources/views/errors/500.blade.php`

- [ ] **Step 1: Replace with designed error page**

Include: illustration/icon, error code (large display), message, "Kembali ke Beranda" button

---

### Task 16: Vite Build Verification

- [ ] **Step 1: Run build to verify no errors**

Run: `npx vite build` — must complete without errors
