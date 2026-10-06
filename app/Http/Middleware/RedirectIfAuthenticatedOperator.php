<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedOperator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('operator')->check()) {
            // Jika operator sudah login, redirect ke halaman dashboard
            return redirect()->route('operator.dashboard');
        }

        // Jika belum login, lanjutkan request
        return $next($request);
    }
}
