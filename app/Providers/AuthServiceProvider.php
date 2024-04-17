<?php

namespace App\Providers;

use App\Http\Middleware\Traits\RoleCheckerTrait;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use RoleCheckerTrait;

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
            return $this->hasRole(Role::ROLE_USER);
        });

        Gate::define('reset-password-from-sidebar', function() {
            return $this->hasRole(Role::ROLE_USER);
        });

        Gate::define('view-users', function() {
            return $this->hasRole(Role::ROLE_ADMIN);
        });

        Gate::define('view-admin-portal', function() {
            return $this->hasRole(Role::ROLE_ADMIN);;
        });

        Gate::define('view-user-portal', function() {
            return $this->hasRole(Role::ROLE_USER);
        });

    }
}
