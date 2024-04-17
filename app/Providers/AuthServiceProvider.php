<?php

namespace App\Providers;

use App\Http\Middleware\Traits\AdminCheckerTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use AdminCheckerTrait;

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-profile', function() {
            return !$this->isAdmin();
        });

        Gate::define('reset-password-from-sidebar', function() {
            return !$this->isAdmin();
        });

        Gate::define('view-users', function() {
            return $this->isAdmin();
        });

        Gate::define('view-admin-portal', function() {
            return $this->isAdmin();
        });

        Gate::define('view-user-portal', function() {
            return !$this->isAdmin();
        });

    }
}
