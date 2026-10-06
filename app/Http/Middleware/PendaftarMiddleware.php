<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PendaftarMiddleware
{
    public function handle($request, Closure $next)
    {
        // Mengecek apakah user sudah login sebagai pendaftar
        if (!Auth::guard('pendaftar')->check()) {
            // Jika belum, redirect ke halaman login
            return redirect()->route('pendaftar.login.form');
        }

        return $next($request);
    }
}