<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    //

    public function login(){


        return view('auths.login');
    }

    public function handlelogin(AuthRequest $request){

        $credentials = $request->only(['username', 'password']);

        $authentification = HTTP::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('http://192.168.8.106:8080/api/v1/users-management/authenticate', $credentials);
        
        $administrateurs = $authentification->json();

            $token=$administrateurs['token'];
           // dd($token);
            // Stocker la variable dans une session
            session(['variableEnvoyee' => $token]);

        $userResponseDto = $administrateurs['userResponseDto'];
        $roleModel = $userResponseDto['roleModel'];
        $role = $roleModel['libelle'];

        if ($role == "ADMIN") {
            return redirect()->route('accueil');
        } else {
            return redirect()->back()->with('error_msg', 'Vous ne disposez pas des autorisations nécessaires pour éffectuer cette action.');
        }

        
    }
}
