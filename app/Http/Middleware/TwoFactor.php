<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (auth()->check() && $user->two_factor_code) {
          
            if ($user->two_factor_expires_at < now()) {
                $user->resetTwoFactorCode();
                auth()->logout();

                return redirect(route('login'));
            }

            if (! $request->is('verify*')) {
                return redirect(route('verify.index'));
            }
        } else if(auth()->check() && $request->is('verify*'))
        {
            return redirect('/');
        }

        return $next($request);
    }
}
