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
    <link rel="icon" type="image/svg+xml" href="https://laravel.com/favicon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-50">
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
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#dc2626',
                });
            @endif
        });
    </script>
</body>
</html>
