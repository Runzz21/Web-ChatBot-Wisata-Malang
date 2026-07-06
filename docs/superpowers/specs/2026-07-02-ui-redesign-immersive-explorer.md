# UI Redesign: Immersive Explorer

**Date:** 2026-07-02
**Project:** Web Wisata Alam Malang
**Approach:** Immersive Explorer — bold, modern, high-impact nature tourism design

---

## 1. Design System

### 1.1 Color Palette (Evolved from Existing)

| Token | Hex | Penggunaan |
|-------|-----|------------|
| `ink` | `#0E1D18` | Dark base (hero, footer, text utama) |
| `canvas` | `#FDFBF7` | Background utama halaman |
| `canvas-alt` | `#F5F0E8` | Section divider / alternating bg |
| `leaf` | `#2D4A3E` | Primary button, active state, link |
| `leaf-dark` | `#1F362E` | Button hover |
| `gold` | `#C9A84C` | Highlight, rating, aksen emas |
| `gold-light` | `#D4A84B` | Gold hover state |
| `moss` | `#557E55` | Subtle decorative accents |
| `bark` | `#8B6F47` | Warm neutral, secondary text |
| `cream-200` | `#EDE5D8` | Border subtle |

### 1.2 Typography

| Role | Font | Weight | Use Case |
|------|------|--------|----------|
| Display | Sora | 700/800 | Hero heading, section title besar |
| Sub-display | Sora | 600 | Card titles, section subtitle |
| Body | DM Sans | 400/500 | Paragraph, label, nav |
| Body strong | DM Sans | 600 | Button, emphasis |
| Mono | DM Mono | 400/500 | Stats, metadata, data points |

Type scale: `text-xs`(0.75rem) → `text-7xl`(4.5rem) dengan step konsisten.

### 1.3 Spacing & Layout Tokens

| Token | Value |
|-------|-------|
| Section padding Y | `py-24` (6rem / 96px) |
| Container max | `max-w-7xl` (80rem) |
| Card gap | `gap-5` / `gap-6` |
| Grid columns | 1 (mobile) → 2 (sm) → 3 (lg) → 4 (xl) |
| Content max-width (prose) | `max-w-3xl` |

### 1.4 Border Radius

| Element | Radius |
|---------|--------|
| Button | `rounded-xl` (0.75rem) |
| Card | `rounded-2xl` (1.25rem) |
| Badge | `rounded-full` |
| Input | `rounded-xl` (0.75rem) |
| Icon container | `rounded-xl` (0.75rem) |

### 1.5 Shadows

| Level | Value |
|-------|-------|
| card | `0 2px 16px rgba(14,29,24,0.05)` |
| card-hover | `0 12px 48px rgba(14,29,24,0.1)` |
| dropdown | `0 8px 32px rgba(14,29,24,0.12)` |
| modal | `0 24px 80px rgba(14,29,24,0.2)` |

---

## 2. Component Architecture

### 2.1 Navbar
- Fixed top, transparent on hero → `glass-nav` after scroll (80px)
- Logo: Sora bold, "Wisata" + "Malang" gold
- Nav items: DM Sans 500, `link-underline` hover effect
- Active page: subtle gold dot indicator
- Mobile: hamburger → full-height overlay menu

### 2.2 Hero
- Full viewport (`min-h-screen`)
- Background image full-bleed with `object-cover`
- Multi-layer overlay:
  - Base: `linear-gradient(to top, ink 0%, transparent 60%)`
  - Accent: `radial-gradient(gold 0%, transparent 60%)` di pojok
  - Texture: SVG noise overlay (opacity 0.03)
- Typography: H1 Sora 800 `text-5xl→7xl`, gold accent word
- CTA: btn-solid (leaf) + btn-white (glass)
- Floating gold particles (SVG circles with float animation)
- Scroll indicator: animated chevron at bottom

### 2.3 Stats Bar
- 3 items horizontal, centered
- Counter animation (0 → target via IntersectionObserver)
- Gold divider line between items
- Label uppercase tracking-wider

### 2.4 Category Grid
- 6-column grid (2-col mobile, 3-col tablet, 6-col desktop)
- Circular icon container (w-16 h-16 rounded-2xl)
- Hover: scale(1.05) + gold glow shadow
- Label + count below

### 2.5 Destinasi Card (Redesigned)
- Image-dominant: aspect-[3/2], object-cover
- Gradient overlay on hover (ink → transparent)
- Badge kategori di top-left
- Badge "Buka 24 Jam" di top-right (gold)
- Info section: nama (Sora 600), lokasi (icon), harga (semibold)
- CTA button: outline with arrow
- Hover: card lift 8px + shadow deepen + image scale 1.1

### 2.6 Filter Sidebar
- Glass card with backdrop-blur
- Sticky positioning
- Radio/checkbox dengan custom styling
- Reset button outline

### 2.7 Form Inputs
- Floating labels (placeholder as label)
- Focus: ring gold-500/20 + border leaf
- Error state: ring red + border red
- Textarea: resize-none, same styling

### 2.8 Chatbot UI
- Glass card container
- Header: dark bg (leaf), bot avatar + name + status
- Messages: user (leaf bg, right) / bot (white bg, left)
- Typing indicator: 3 bouncing dots
- Input: pill-shaped, send button leaf
- Quick reply chips: subtle outline

### 2.9 Footer
- 4-column grid: brand (3col) + navigasi (3col) + kontak (3col) + social (3col)
- Gold decorative top border (gradient)
- Noise texture overlay
- Social icon hover: gold tint

---

## 3. Page Layouts

### 3.1 Homepage Flow
```
Hero (ink) → Stats (canvas) → Categories (canvas-alt) → Destinations (canvas) → CTA (ink) → Footer (ink)
```

### 3.2 Destinasi Index
```
Header → Search/Filter Bar → [Sidebar Filter (sticky) + Card Grid (3-col)] → Pagination
```

### 3.3 Destinasi Detail
```
Banner (60vh, ink overlay) → Info Stats (4-col) + Sidebar Map → Deskripsi → Fasilitas → Galeri → Rekomendasi
```

### 3.4 Tentang
```
Hero (ink, 60vh) → Visi+Misi (2-col) → Prose Section → Stats Bar
```

### 3.5 Kontak
```
Hero (ink, 60vh) → Info Kontak (2-col) + Form (3-col)
```

### 3.6 Chatbot
```
Header → Glass Card with Chat Interface
```

### 3.7 Admin Panel
```
Sidebar (fixed, 64px/260px) → Top Bar → Content Area → Stats Cards → Tables → Forms
```

---

## 4. Animations & Interactions

| Element | Animation | Trigger |
|---------|-----------|---------|
| Hero particles | `float 6s ease-in-out infinite` | Auto |
| Scroll reveal | `fade-up` (translateY 24→0, opacity 0→1) | IntersectionObserver |
| Cards | `translateY(-8px)` + shadow deepen | Hover |
| Buttons | arrow `translateX(4px)` | Hover |
| Navbar | bg transparent → glass | Scroll >80px |
| Stats counter | 0 → target number | Scroll into view |
| Gallery | `scale(1.03)` | Hover |
| Chat typing | 3-dot bounce animation | While loading |
| Page transition | subtle fade (via CSS) | Navigation |

---

## 5. Files to Modify

### CSS & Config
- `resources/css/app.css` — update component classes, new animations
- `tailwind.config.js` — update colors, extend tokens

### Layouts
- `resources/views/layouts/main.blade.php` — refined meta, structure
- `resources/views/layouts/admin.blade.php` — redesigned sidebar, topbar
- `resources/views/components/navbar.blade.php` — full redesign
- `resources/views/components/footer.blade.php` — full redesign

### Public Pages
- `resources/views/home/index.blade.php` — hero, stats, categories, destinations, CTA
- `resources/views/destinasi/index.blade.php` — filters, grid, cards
- `resources/views/destinasi/show.blade.php` — banner, info, gallery, sidebar
- `resources/views/tentang/index.blade.php` — hero, visi-misi, prose, stats
- `resources/views/kontak/index.blade.php` — hero, info cards, form
- `resources/views/chatbot/index.blade.php` — redesigned chat interface
- `resources/views/chatbot/partials/result.blade.php` — recommendation results

### Admin Pages
- `resources/views/admin/auth/login.blade.php` — redesigned login
- `resources/views/admin/dashboard/index.blade.php` — stats cards
- `resources/views/admin/destinasi/index.blade.php` — table redesign
- `resources/views/admin/destinasi/create.blade.php` — form redesign
- `resources/views/admin/destinasi/edit.blade.php` — form redesign
- `resources/views/admin/kategori/index.blade.php` — table redesign
- `resources/views/admin/kategori/create.blade.php` — form redesign
- `resources/views/admin/kategori/edit.blade.php` — form redesign
- `resources/views/admin/galeri/index.blade.php` — gallery management
- `resources/views/admin/chatbot-log/index.blade.php` — log table

### Error Pages
- `resources/views/errors/404.blade.php`
- `resources/views/errors/419.blade.php`
- `resources/views/errors/500.blade.php`

### JavaScript
- `resources/js/app.js` — enhanced scroll animations, counter, particles

---

## 6. Implementation Order

1. Design system (CSS tokens, Tailwind config)
2. Components (navbar, footer, button, card)
3. Layouts (main, admin)
4. Public pages (home → destinasi → detail → tentang → kontak → chatbot)
5. Admin pages (login → dashboard → CRUD)
6. Error pages
7. JavaScript enhancements
