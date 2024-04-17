<?php

namespace App\Http\Middleware\Traits;

trait RoleCheckerTrait
{
    public function hasRole(string $role): bool
    {
        return (auth()->check() && auth()->user()->roles->where('name', $role)->count() > 0);
    }
}
