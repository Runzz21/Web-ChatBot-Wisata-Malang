<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin | LERENG</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#EDF1EA] min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 bg-primary-800 rounded-2xl flex items-center justify-center shadow-lereng-md">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <h1 class="text-2xl font-display font-semibold text-primary-800 tracking-tight">LERENG</h1>
            <p class="text-[#5A6B55] text-sm mt-1 font-mono tracking-wide">Admin Panel</p>
        </div>

        <div class="card p-8">
            <h2 class="text-lg font-display font-semibold text-primary-800 mb-6">Masuk</h2>

            <form action="{{ route('admin.authenticate') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="username" class="block text-sm font-medium text-primary-800 mb-1.5">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                           class="input-field @error('username') border-red-500 focus:ring-red-500 @enderror"
                           placeholder="Masukkan username" required autofocus>
                    @error('username')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-primary-800 mb-1.5">Password</label>
                    <input type="password" name="password" id="password"
                           class="input-field @error('password') border-red-500 focus:ring-red-500 @enderror"
                           placeholder="Masukkan password" required>
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-primary-700 text-white font-medium rounded-xl hover:bg-primary-800 transition-colors shadow-lereng-sm hover:shadow-lereng-md">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</body>
</html>
