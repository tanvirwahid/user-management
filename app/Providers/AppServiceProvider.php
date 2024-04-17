<?php

namespace App\Providers;

use App\Contracts\FileDownloaderInterface;
use App\Contracts\FileHandlerInterface;
use App\Services\IdVerificationFileHandlerService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FileHandlerInterface::class, IdVerificationFileHandlerService::class);
        $this->app->bind(FileDownloaderInterface::class, IdVerificationFileHandlerService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
