<?php

namespace App\Providers;
use App\Models\BiodataDiriModel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $pendaftarId = Auth::guard('pendaftar')->id();
            $biodata = BiodataDiriModel::where('id_pendaftar', $pendaftarId)->first();
            $view->with('biodata', $biodata);
        });
    }
}
