<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Importez la classe View

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
    public function boot()
    {

        View::composer('layouts.master', function ($view) {
            $view->with([
                'prenom' => session('prenom'),
                'nom' => session('nom'),
                'role' => session('role')
            ]);
        });
           }
}
