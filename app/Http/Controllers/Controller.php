<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View; // Importez la classe View
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

   // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   public function index()
    {
    
        // Accédez aux données de session
        $nom = session('nom');
        $prenom = session('prenom');
        $role = session('role');

        // Faites quelque chose avec les données de session
        // Par exemple, passez les données à la vue
        return view('layouts/master')->with([
            'nom' => $nom,
            'prenom' => $prenom,
            'role' => $role,
        ]);
    }
}
