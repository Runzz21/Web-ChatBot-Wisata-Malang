<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ChatbotLogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinasiController as AdminDestinasiController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TentangController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

RateLimiter::for('chatbot', function () {
    return Limit::perMinute(30)->by(request()->ip());
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('destinasi')->name('destinasi.')->group(function () {
    Route::get('/', [DestinasiController::class, 'index'])->name('index');
    Route::get('/{nama}', [DestinasiController::class, 'show'])->name('show');
});

Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

Route::get('/sitemap.xml', function () {
    $destinasi = App\Models\Destinasi::aktif()->get();
    $kategori = App\Models\Kategori::all();

    return response()->view('sitemap', compact('destinasi', 'kategori'))->header('Content-Type', 'text/xml');
})->name('sitemap');

Route::prefix('chatbot')->name('chatbot.')->group(function () {
    Route::get('/', [ChatbotController::class, 'index'])->name('index');
    Route::post('/process', [ChatbotController::class, 'process'])->name('process')->middleware('throttle:chatbot');
    Route::post('/final', [ChatbotController::class, 'processFinal'])->name('final')->middleware('throttle:chatbot');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('kategori')->name('kategori.')->group(function () {
            Route::get('/', [AdminKategoriController::class, 'index'])->name('index');
            Route::get('/create', [AdminKategoriController::class, 'create'])->name('create');
            Route::post('/', [AdminKategoriController::class, 'store'])->name('store');
            Route::get('/{kategori}/edit', [AdminKategoriController::class, 'edit'])->name('edit');
            Route::put('/{kategori}', [AdminKategoriController::class, 'update'])->name('update');
            Route::delete('/{kategori}', [AdminKategoriController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('destinasi')->name('destinasi.')->group(function () {
            Route::get('/', [AdminDestinasiController::class, 'index'])->name('index');
            Route::get('/create', [AdminDestinasiController::class, 'create'])->name('create');
            Route::post('/', [AdminDestinasiController::class, 'store'])->name('store');
            Route::get('/{destinasi}/edit', [AdminDestinasiController::class, 'edit'])->name('edit');
            Route::put('/{destinasi}', [AdminDestinasiController::class, 'update'])->name('update');
            Route::delete('/{destinasi}', [AdminDestinasiController::class, 'destroy'])->name('destroy');
            Route::post('/{destinasi}/toggle-status', [AdminDestinasiController::class, 'toggleStatus'])->name('toggle-status');
        });

        Route::prefix('destinasi/{destinasi}/galeri')->name('galeri.')->group(function () {
            Route::get('/', [GaleriController::class, 'index'])->name('index');
            Route::post('/', [GaleriController::class, 'store'])->name('store');
            Route::delete('/{galeri}', [GaleriController::class, 'destroy'])->name('destroy');
            Route::put('/urutan', [GaleriController::class, 'updateUrutan'])->name('urutan');
        });

        Route::prefix('chatbot-log')->name('chatbot-log.')->group(function () {
            Route::get('/', [ChatbotLogController::class, 'index'])->name('index');
            Route::get('/export', [ChatbotLogController::class, 'exportCsv'])->name('export');
        });
    });
});
