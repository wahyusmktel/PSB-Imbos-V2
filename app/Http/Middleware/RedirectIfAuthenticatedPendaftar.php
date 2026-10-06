<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedPendaftar
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna sudah login dengan guard 'pendaftar'
        if (Auth::guard('pendaftar')->check()) {
            // Jika sudah login, redirect ke halaman dashboard
            return redirect()->route('pendaftar.dashboard');
        }

        // Jika belum login, lanjutkan ke request berikutnya
        return $next($request);
    }
}
