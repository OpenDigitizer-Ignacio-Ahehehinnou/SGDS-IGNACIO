<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;

class superAdminController extends Controller
{
    //

    public function index()
    {
        $ip_adress = env('APP_IP_ADRESS');


         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');

         $response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-users/users/active-enabled-role-and-enterprise?isEnabled=true&roleId=12&enterpriseId=20");

         $superAdmins = $response->json();
         $superAdmin = $superAdmins['data']['content'];

            //dd($superAdmin);
        return view('superAdmin/index',compact("superAdmin"));
    }

    public function create()
    {
        $ip_adress = env('APP_IP_ADRESS');


         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');
         $entreprise = session('entreprise');
         $role = session('role');

            //dd($entreprise);
        //  $response = HTTP::withHeaders([
        //      'Authorization' => 'Bearer ' . $variableRecuperee,
        //  ])->get("http://192.168.8.101:8080/odsolidwaist/manages-entreprise/find/entreprise/active");

         $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/active");

          $entreprisess = $response->json();
         // dd($entreprisess);
          $entreprises=$entreprisess['data']['content'];

         //dd($entreprises);
         

        //ajouter un admin
        return view('SuperAdmin/create',compact('entreprises','entreprise','role'));
    }

    //Le store du create

    public function store(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');
        //dd($request['matricule']);

        $request->validate([
            "firstName" => "required",
            "lastName" => "required",
            "telephone" => "required|numeric",
            "username" => "required",
            "adress" => "required",
            "password" => "required|min:8",
            "email" => "required"
        ]);

         // Obtenez la date actuelle sous forme de chaîne au format ISO 8601 avec une précision de millisecondes.
        $createdAt = Carbon::now()->toIso8601String();
        //dd($createdAt);
        //Générer matricule
            // Vous pouvez personnaliser le préfixe selon vos besoins
            $prefix = 'SGDS_SuperAdmin_';

            $nombreAleatoire = rand(0, 1000); // Utilisation de rand()


            // Formatage du nouveau matricule avec la partie numérique
            $newMatricule = $prefix . $nombreAleatoire;
        //Fin matricule
        //ajouter un admin
        $donnees = $request->all();

        //dd($donnees);
        $test = array();
        //$test['id'] = $id;
       // $test['userId'] = 105;
        $test['firstName'] = $donnees['firstName'];
        $test['lastName'] = $donnees['lastName'];
        if($request['matricule']  === null){
            $test['matricule'] = $newMatricule;
        }else{
            $test['matricule'] = $donnees['matricule'];

        }
        $test['telephone'] = $donnees['telephone'];
        $test['photoProfil'] = $donnees['photoProfil'];

        $test['adress'] = $donnees['adress'];
        $test['username'] = $donnees['username'];
        $test['password'] = $donnees['password'];
        $test['password_confirm'] = $donnees['password_confirm'];

        $test['email'] = $donnees['email'];
        $test['entrepriseId'] = $donnees['entrepriseId'];
        $test['roleId'] = $donnees['roleId'];
        $test['isEnabled'] = true;
        $test['isAccountNonExpired'] = true;
        $test['isAccountNonLocked'] = true;
        $test['isCredentialsNonExpired'] = true;
        $test['creatorUsername'] = $donnees['creatorUsername'];
        $test['creatorId'] = $donnees['creatorId'];
        $test['createdAt'] = $createdAt;
        $test['roleId'] = $donnees['roleId'];
        $test['deletedFlag'] = $donnees['deletedFlag'];
        //dd($test);
        if ($donnees['password_confirm'] != $donnees['password']) {
            return redirect()->back()->withInput($donnees)->with('success', 'Les mots de passe ne correspondent pas.');
        }

            // $variableRecuperee = session('variableEnvoyee');

            //  //dd($entreprise);
            // $response = HTTP::withHeaders([
            //     'Authorization' => 'Bearer ' . $variableRecuperee,
            // ])->get('http://'.$ip_adress.'/odsolidwaist/manages-users/create');


            $variableRecuperee = session('variableEnvoyee');
            $response = HTTP::POST("http://".$ip_adress."/odsolidwaist/manages-users/create", $test);
        
            $administrateurss = $response->json();
            $administrateurs = $administrateurss['data'];
            //dd($administrateurs);
        //return  back()->with("success", "Administrateur ajouté avec succè!")->with(compact("administrateurs"));
        return redirect()->route('superAdmin')->with("success", "SuperAdmin ajouté avec succès")->with(compact("administrateurs"));
        

    }


}
