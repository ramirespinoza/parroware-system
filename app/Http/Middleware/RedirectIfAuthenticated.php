<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                // ✅ Permitir al admin ver /register
                if ($request->is('register') && Auth::user()->role === 'admin') {
                    return $next($request);
                }

                // 🚫 Si no es admin, redirigir al dashboard
                return redirect(RouteServiceProvider::HOME);
            }
        }
        return $next($request);
    }
}
