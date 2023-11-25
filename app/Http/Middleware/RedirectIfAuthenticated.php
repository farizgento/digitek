<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Get the authenticated user
                $user = Auth::user();

                // Redirect based on user role
                if ($user->hasRole('super-admin')) {
                    return redirect(RouteServiceProvider::HOME_SUPER_ADMIN);
                } elseif ($user->hasRole('admin')) {
                    return redirect(RouteServiceProvider::HOME_ADMIN);
                } elseif ($user->hasRole('user')) {
                    return redirect(RouteServiceProvider::HOME_USER);
                }
            }
        }
        return $next($request);
    }
}
