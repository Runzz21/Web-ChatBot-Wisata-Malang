<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Halaman Tidak Ditemukan | LERENG</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#EDF1EA] min-h-screen flex items-center justify-center">
    <div class="text-center px-4">
        <p class="font-mono text-[8rem] font-semibold text-primary-800/10 leading-none">404</p>
        <h1 class="text-2xl font-display font-semibold text-primary-800 mt-4">Halaman Tidak Ditemukan</h1>
        <p class="text-[#5A6B55] mt-2 max-w-md mx-auto">Maaf, halaman sing sampeyan goleki ora ana utawa wis dipindah.</p>
        <div class="mt-8">
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-primary-700 text-white font-semibold rounded-xl hover:bg-primary-800 transition-colors shadow-lereng-sm hover:shadow-lereng-md">
                Bali menyang Beranda
            </a>
        </div>
    </div>
</body>
</html>
