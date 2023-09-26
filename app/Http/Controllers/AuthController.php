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
        ])->post('http://192.168.1.5:8080/api/v1/users-management/authenticate', $credentials);

        $administrateurs = $authentification->json();
        //dd($authentification->status());

        //Controller identifiant
        if ($authentification->status() == 500 ) {
            return redirect()->back()->with('error_msg', 'Identifiant incorrect, veuillez réessayer.');
        }

            $token=$administrateurs['token'];


            $username=$administrateurs['userResponseDto']['username'];
            $userId=$administrateurs['userResponseDto']['userId'];
            $entreprise=$administrateurs['userResponseDto']['entrepriseModel']['name'];
          // $entreprise=1;
            $role=$administrateurs['userResponseDto']['roleModel']['libelle'];
            $nom=$administrateurs['userResponseDto']['lastName'];
            $prenom=$administrateurs['userResponseDto']['firstName'];
            $matricule=$administrateurs['userResponseDto']['matricule'];
            $telephone=$administrateurs['userResponseDto']['telephone'];
            $adresse=$administrateurs['userResponseDto']['adress'];

           //dd($token,$prenom,$entreprise);
            // Stocker la variable dans une session
            session(['variableEnvoyee' => $token, 'nom'=>$nom,'adresse'=>$adresse,'prenom'=>$prenom,'matricule'=>$matricule,'telephone'=>$telephone,'username'=>$username,'userId'=>$userId,'entreprise'=>$entreprise,'role'=>$role]);

        $userResponseDto = $administrateurs['userResponseDto'];
        $roleModel = $userResponseDto['roleModel'];
        $role = $roleModel['libelle'];

        if ($role == "ADMIN" ) {
            return redirect()->route('accueil');
        } elseif($role == "SUPERADMIN"){
            return redirect()->route('accueil');

        }
        else {
            return redirect()->back()->with('error_msg', 'Vous ne disposez pas des autorisations nécessaires pour éffectuer cette action.');
        }

        return view('layouts/master',compact('nom','prenom','role'));

    }
}
