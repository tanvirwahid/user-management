<?php

namespace App\Providers;

use App\Contracts\FileHandlerInterface;
use App\Services\IdVerificationFileHandlerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FileHandlerInterface::class, IdVerificationFileHandlerService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
