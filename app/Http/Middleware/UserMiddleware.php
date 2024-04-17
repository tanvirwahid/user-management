<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Traits\AdminCheckerTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    use AdminCheckerTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($this->isAdmin())
        {
            abort(403);
        }

        return $next($request);
    }
}
