<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin | Wisata Malang</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%232D4A3E'/%3E%3Cstop offset='100%25' stop-color='%230E1D18'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='100' height='100' rx='20' fill='url(%23g)'/%3E%3Cpath d='M30 75 L50 25 L70 75 L50 60 Z' fill='%23C9A84C'/%3E%3C/svg%3E">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-canvas text-ink antialiased min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-14 h-14 rounded-2xl bg-leaf-600/10 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-leaf-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <h1 class="text-2xl font-display font-bold text-ink">Wisata<span class="text-gold-500">Malang</span></h1>
            <p class="text-sm text-ink/50 mt-1">Masuk ke panel admin</p>
        </div>

        <div class="card-glass p-8">
            @if(session('error'))
            <div class="mb-6 p-4 rounded-xl text-sm font-medium" style="background: rgba(239, 68, 68, 0.08); color: #DC2626; border: 1px solid rgba(239, 68, 68, 0.15);">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-5">
                    <label for="username" class="block text-sm font-medium text-leaf-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                           class="input-field" placeholder="Masukkan username" required autofocus>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-leaf-700 mb-2">Password</label>
                    <input type="password" id="password" name="password"
                           class="input-field" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn-primary w-full justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-ink/30 mt-6">&copy; {{ date('Y') }} Wisata Alam Malang</p>
    </div>
</body>
</html>
