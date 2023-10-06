<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use App\Http\Controllers\Controller;
use App\Http\Requests\saveAdminRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;


use function Pest\Laravel\json;

class AdministrateurController extends Controller
{

    public function index()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $entreprise = session('entreprise');
        $role = session('role');

            //dd($entreprise);
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/api/v1/users-management/show/user');

        $administrateurs = $response->json();
       // dd($administrateurs);


        //dd($usernames);
        return view('Admin/index', compact("administrateurs", "entreprise", "role"));
    }



    public function create()
    {
        $ip_adress = env('APP_IP_ADRESS');


         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');
         $entreprise = session('entreprise');
         $role = session('role');

            //dd($entreprise);
         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://'.$ip_adress.'/api/v1/entreprise-management/show/entreprise');

          $entreprises = $response->json();
         //dd($entreprises);

        //ajouter un admin
        return view('Admin/create',compact('entreprises','entreprise','role'));
    }

    //Le store du create

    public function store(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');


        $request->validate([
            "firstName" => "required",
            "lastName" => "required",
            "telephone" => "required|numeric",
            "username" => "required",
            "adress" => "required",
            "password" => "required|min:8",
            "activationStatus" => "required"
        ]);

         // Obtenez la date actuelle sous forme de chaîne au format ISO 8601 avec une précision de millisecondes.
    $createdAt = Carbon::now()->toIso8601String();
        //dd($createdAt);
        //Générer matricule
            // Vous pouvez personnaliser le préfixe selon vos besoins
            $prefix = 'SGDS_Admin_';

            
            $nombreAleatoire = rand(0, 1000); // Utilisation de rand()


            // Formatage du nouveau matricule avec la partie numérique
            $newMatricule = $prefix . $nombreAleatoire;
        //Fin matricule
        //ajouter un admin
        $donnees = $request->all();

        //dd($donnees);
        $test = array();
        //$test['id'] = $id;
        $test['userId'] = 105;
        $test['firstName'] = $donnees['firstName'];
        $test['lastName'] = $donnees['lastName'];
        $test['matricule'] = $newMatricule;
        $test['telephone'] = $donnees['telephone'];
        $test['photoProfil'] = $donnees['photo'];

        $test['adress'] = $donnees['adress'];
        $test['username'] = $donnees['username'];
        $test['password'] = $donnees['password'];
        $test['password_confirm'] = $donnees['password_confirm'];

        $test['activationStatus'] = $donnees['activationStatus'];
        $test['entrepriseId'] = $donnees['entrepriseId'];
        $test['creatorUsername'] = $donnees['creatorUsername'];
        $test['creatorId'] = $donnees['creatorId'];
        $test['createdAt'] = $createdAt;
        $test['roleId'] = $donnees['roleId'];
        $test['deletedFlag'] = $donnees['deletedFlag'];
        //dd($test);
        if ($donnees['password_confirm'] != $donnees['password']) {
            return redirect()->back()->withInput($donnees)->with('success', 'Les mots de passe ne correspondent pas.');
        }


            $variableRecuperee = session('variableEnvoyee');

             //dd($entreprise);
            $response = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get('http://'.$ip_adress.'/api/v1/users-management/show/user');

            $administrateurs = $response->json();


            $usernames = []; // Initialisez un tableau vide pour stocker les usernames

            foreach ($administrateurs as $administrateur) {
                $username = $administrateur["username"];
                $usernames[] = $username; // Ajoutez chaque username au tableau $usernames
            }

            $telephones = []; // Initialisez un tableau vide pour stocker les usernames

            foreach ($administrateurs as $administrateur) {
                $telephone = $administrateur["telephone"];
                $telephones[] = $telephone; // Ajoutez chaque username au tableau $usernames
            }

            
        if (in_array($donnees['username'], $usernames)) {
            // Le username est présent dans la liste
            return redirect()->back()->withInput($donnees)->with("success", "Le nom d'utilisateur est déjà utilisé")->with(compact("administrateurs"));
        }else if (in_array($donnees['telephone'], $telephones)){
            return redirect()->back()->withInput($donnees)->with("success", "Le numéro de téléphone est déjà utilisé")->with(compact("administrateurs"));

        } else {
            // Le username n'est pas présent dans la liste
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://'.$ip_adress.'/api/v1/users-management/create/user',$test);

        $administrateurs = $response->json();
        //dd($administrateurs);

        //return  back()->with("success", "Administrateur ajouté avec succè!")->with(compact("administrateurs"));
        return redirect()->route('admin')->with("success", "Administrateur ajouté avec succès")->with(compact("administrateurs"));
        }

    }

    public function delete(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $donnees = $request->documentId;
        //dd($donnees);

        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://'.$ip_adress.'/api/v1/users-management/delete/user/' .$donnees;

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);


        return back()->with("successDelete", "L'administrateur a été supprimé avec succès");

    }

    public function update(Request $request, $id)
    {
        $ip_adress = env('APP_IP_ADRESS');


        $request->validate([
            "firstName" => "required",
            "lastName" => "required",
            "telephone" => "required|numeric",
            "username" => "required",
            "adress" => "required",
            "password" => "required|min:8",
            "activationStatus" => "required"
        ]);

        $test = array();
        //$test['id'] = $id;
        $test['userId'] = $request['userId'];
        $test['firstName'] = $request['firstName'];
        $test['lastName'] = $request['lastName'];
        $test['matricule'] = $request['matricule'];
        $test['telephone'] = $request['telephone'];
        $test['adress'] = $request['adress'];
        $test['username'] = $request['username'];
        $test['password'] = $request['password'];
        $test['activationStatus'] = $request['activationStatus'];
        $test['entrepriseId'] = $request['entrepriseId'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['roleId'] = $request['roleId'];
        $test['deletedFlag'] = $request['deletedFlag'];


        $dataToUpdate = $test;


        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();

        $response = $client->put("http://192.168.1.6:8080/api/v1/users-management/update/user/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);

        return redirect()->route('admin')->with("success", "Administrateur mis à jour avec succès");


    }
    public function edit($id)
    {
        $ip_adress = env('APP_IP_ADRESS');

        //ajouter un admin

           // Récupérer la variable de la session
           $variableRecuperee = session('variableEnvoyee');
           $response = HTTP::withHeaders([
               'Authorization' => 'Bearer ' . $variableRecuperee,
           ])->get('http://'.$ip_adress.'/api/v1/users-management/show/user/' . $id);


        $administrateur = $response->json();
        //dd($administrateur);

        return view('Admin/edit', compact("administrateur"));
    }
}
