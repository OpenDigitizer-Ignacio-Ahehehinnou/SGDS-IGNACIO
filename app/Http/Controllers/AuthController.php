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

        $ip_adress = env('APP_IP_ADRESS');

        $credentials = $request->only(['username', 'password']);
        //dd($credentials);

        $authentification = HTTP::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('http://'.$ip_adress.'/odsolidwaist/manages-users/authenticate', $credentials);
    
        $administrateurs = $authentification->json();
      // dd($administrateurs);

        //Controller identifiant
        if ($authentification->status() == 500 ) {
            return redirect()->back()->with('error_msg', 'Identifiant incorrect, veuillez réessayer.');
        }

            $token=$administrateurs['data']['token'];

            //dd($token);
            $username=$administrateurs['data']['userDTO']['username'];
            $userId=$administrateurs['data']['userDTO']['userId'];
            $entreprise=$administrateurs['data']['userDTO']['entrepriseId'];
            // $entreprise=1;
            $role=$administrateurs['data']['userDTO']['roleId'];
            $nom=$administrateurs['data']['userDTO']['lastName'];
            $prenom=$administrateurs['data']['userDTO']['firstName'];
            $matricule=$administrateurs['data']['userDTO']['matricule'];
            $telephone=$administrateurs['data']['userDTO']['telephone'];
            $adresse=$administrateurs['data']['userDTO']['adress'];


           // dd($token,$prenom,$entreprise);
            // Stocker la variable dans une session
            session(['variableEnvoyee' => $token, 'nom'=>$nom,'adresse'=>$adresse,'prenom'=>$prenom,'matricule'=>$matricule,'telephone'=>$telephone,'username'=>$username,'userId'=>$userId,'entreprise'=>$entreprise,'role'=>$role]);

        if ($role == 8 or $role == 7 ) {
            return redirect()->route('accueil');
        } elseif($role == 12){
            return redirect()->route('accueil');

        }
        else {
            return redirect()->back()->with('error_msg', 'Vous ne disposez pas des autorisations nécessaires pour éffectuer cette action.');
        }

        return view('layouts/master',compact('nom','prenom','role','entreprise'));

    }
}
