<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Web Wisata Alam Malang') | Wisata Alam Malang</title>
    <meta name="description" content="@yield('meta_description', 'Jelajahi keindahan alam Malang. Temukan destinasi wisata alam terbaik di Malang Raya.')">
    <meta property="og:title" content="@yield('og_title', 'Web Wisata Alam Malang')">
    <meta property="og:description" content="@yield('og_description', 'Jelajahi keindahan alam Malang. Temukan destinasi wisata alam terbaik di Malang Raya.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%232D4A3E'/%3E%3Cstop offset='100%25' stop-color='%230E1D18'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='100' height='100' rx='20' fill='url(%23g)'/%3E%3Cpath d='M30 75 L50 25 L70 75 L50 60 Z' fill='%23C9A84C'/%3E%3C/svg%3E">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-canvas text-ink antialiased">
    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    background: '#FDFBF7',
                    color: '#0E1D18',
                    confirmButtonColor: '#2D4A3E',
                    iconColor: '#C9A84C',
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    background: '#FDFBF7',
                    color: '#0E1D18',
                    confirmButtonColor: '#2D4A3E',
                    iconColor: '#C9A84C',
                });
            @endif
        });
    </script>
</body>
</html>
