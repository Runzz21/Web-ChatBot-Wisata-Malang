<?php

namespace App\Providers;

use App\Repositories\ChatbotLogRepository;
use App\Repositories\DestinasiRepository;
use App\Repositories\GaleriRepository;
use App\Repositories\KategoriRepository;
use App\Services\ChabotService;
use App\Services\ChatbotLogService;
use App\Services\DestinasiService;
use App\Services\GaleriService;
use App\Services\KategoriService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KategoriRepository::class);
        $this->app->singleton(DestinasiRepository::class);
        $this->app->singleton(GaleriRepository::class);
        $this->app->singleton(ChatbotLogRepository::class);

        $this->app->singleton(KategoriService::class);
        $this->app->singleton(DestinasiService::class);
        $this->app->singleton(GaleriService::class);
        $this->app->singleton(ChatbotLogService::class);
        $this->app->singleton(ChabotService::class);
    }

    public function boot(): void
    {
        Paginator::useTailwind();
    }
}
