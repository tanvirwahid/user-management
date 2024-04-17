<?php

namespace App\Http\Middleware\Traits;

trait AdminCheckerTrait
{
    public function isAdmin()
    {
        return (auth()->check() && auth()->user()->is_admin == 1);
    }
}
