<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                
                // LOGIKA BARU: Cek Role User
                $role = Auth::user()->role;

                if ($role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }
                
                if ($role === 'kasir') {
                    return redirect()->route('kasir.dashboard');
                }

                // Default jika role tidak dikenal
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}