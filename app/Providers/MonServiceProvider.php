<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Importez la classe View

class MonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $nom = session('nom');
        $prenom = session('prenom');
        $role = session('role');

        // Partagez ces données avec toutes les vues
        View::share([
            'nom' => $nom,
            'prenom' => $prenom,
            'role' => $role,
        ]);
    }
}
