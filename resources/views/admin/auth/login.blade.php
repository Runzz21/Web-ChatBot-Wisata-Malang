<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin | Forest Admin</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center px-4" style="background: #0E1D18;">
    <div class="absolute inset-0 opacity-[0.035] bg-noise"></div>
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 50% 0%, rgba(45, 74, 62, 0.3) 0%, transparent 60%), radial-gradient(ellipse at 50% 100%, rgba(201, 168, 76, 0.03) 0%, transparent 40%);"></div>

    <div class="relative w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-105" style="background: rgba(201, 168, 76, 0.12);">
                <svg class="w-8 h-8 text-gold-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <h1 class="text-2xl font-display font-semibold text-cream-50 tracking-tight">Forest</h1>
            <p class="text-cream-50/30 text-sm mt-1 font-mono tracking-widest uppercase">Admin Panel</p>
        </div>

        <div class="rounded-2xl p-8 transition-all duration-300" style="background: rgba(245, 240, 232, 0.03); border: 1px solid rgba(245, 240, 232, 0.06); backdrop-filter: blur(24px);">
            <h2 class="text-lg font-display font-semibold text-cream-50 mb-6 tracking-tight">Masuk</h2>

            <form action="{{ route('admin.authenticate') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="username" class="block text-sm font-medium mb-1.5" style="color: rgba(245, 240, 232, 0.5);">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                           class="w-full px-4 py-3 rounded-lg text-sm outline-none transition-all duration-300"
                           style="background: rgba(245, 240, 232, 0.04); border: 1px solid rgba(245, 240, 232, 0.08); color: #F5F0E8;"
                           placeholder="Masukkan username" required autofocus>
                    @error('username')
                        <p class="mt-1.5 text-sm" style="color: rgba(248, 113, 113, 0.8);">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium mb-1.5" style="color: rgba(245, 240, 232, 0.5);">Password</label>
                    <input type="password" name="password" id="password"
                           class="w-full px-4 py-3 rounded-lg text-sm outline-none transition-all duration-300"
                           style="background: rgba(245, 240, 232, 0.04); border: 1px solid rgba(245, 240, 232, 0.08); color: #F5F0E8;"
                           placeholder="Masukkan password" required>
                    @error('password')
                        <p class="mt-1.5 text-sm" style="color: rgba(248, 113, 113, 0.8);">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full inline-flex items-center justify-center px-6 py-3 rounded-lg font-medium transition-all duration-300 hover:scale-[1.01] active:scale-[0.99]"
                        style="background: #2D4A3E; color: #F5F0E8;">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</body>
</html>
