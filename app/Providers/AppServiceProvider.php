<?php

namespace App\Providers;

use App\Actions\UserCreationAction;
use App\Contracts\CreateAction;
use App\Contracts\FileDownloaderInterface;
use App\Contracts\FileHandlerInterface;
use App\Http\Controllers\RegistrationController;
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
        $this->app->when(RegistrationController::class)
            ->needs(CreateAction::class)
            ->give(UserCreationAction::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
