<?php

namespace App\Http\Controllers;

use App\Models\Superviseurs;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;


class SuperviseurController extends Controller
{

    public function index()
    {
         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');
         $entreprise = session('entreprise');
         $role = session('role');

         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.1.5:8080/api/v1/users-management/show/user');

         $superviseurs = $response->json();
       // dd($superviseurs);
        return view('Superviseur/index',compact("superviseurs","entreprise","role"));
    }


    public function detail(Request $request, Superviseurs $superviseur, $id)
    {
       // ajouter un admin
        $request->validate([
            "nom"=>"required",
            "prenom"=>"required",
            "email"=>"required",
            "date_naissance"=>"required",
            "adresse"=>"required",
            "telephone"=>"required",
        ]);


            $superviseurs=Superviseurs::find($id);

        $superviseur->update([
            "nom"=>$request->nom,
            "prenom"=>$request->prenom ,
            "date_naissance"=>$request->date_naissance,

            "email"=>$request->email,
            "adresse"=>$request->adresse,
            "telephone"=>$request->telephone,

        ]);
        //     return back()->with("success", "Administrateur mis à jour avec succè!");

        return view('superviseur/voir',compact('administrateur'));
    }


    public function create()
    {

         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');
         $entreprise = session('entreprise');
         $role = session('role');

         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.1.5:8080/api/v1/entreprise-management/show/entreprise');

          $entreprises = $response->json();
         //dd($entreprises);
        //ajouter un admin
        return view('Superviseur/create',compact('entreprises','entreprise','role'));
    }

    //Le store du create

    public function store(Request $request)
    {
        //ajouter un admin

        $request->validate([
            "firstName" => "required",
            "lastName" => "required",
            "matricule" => "required",
            "telephone" => "required|numeric",
            "username" => "required",
            "adress" => "required",
            "password" => "required|min:8",
            "activationStatus" => "required"
        ]);

// Obtenez la date actuelle sous forme de chaîne au format ISO 8601 avec une précision de millisecondes.
$createdAt = Carbon::now()->toIso8601String();
//dd($createdAt);
        $test = array();
        //$test['id'] = $id;
        $test['userId'] = $request['userId'];
        $test['firstName'] = $request['firstName'];
        $test['lastName'] = $request['lastName'];
        $test['matricule'] = $request['matricule'];
        $test['telephone'] = $request['telephone'];
        $test['adress'] = $request['adress'];
        $test['photoProfil'] = $request['photo'];

        $test['username'] = $request['username'];
        $test['password'] = $request['password'];
        $test['activationStatus'] = $request['activationStatus'];
        $test['entrepriseId'] = $request['entrepriseId'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $createdAt;
        $test['roleId'] = $request['roleId'];
        $test['deletedFlag'] = $request['deletedFlag'];

        $variableRecuperee = session('variableEnvoyee');

        //dd($entreprise);
         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.1.5:8080/api/v1/users-management/show/user');

         $administrateurs = $response->json();


       $usernames = []; // Initialisez un tableau vide pour stocker les usernames

         foreach ($administrateurs as $administrateur) {
             $username = $administrateur["username"];
             $usernames[] = $username; // Ajoutez chaque username au tableau $usernames
        }

       // Maintenant, le tableau $usernames contient tous les usernames

         if (in_array($request['username'], $usernames)) {
             // Le username est présent dans la liste
             return redirect()->route('superviseur.create')->with("success", "Le nom d'utilisateur est déjà utilisé")->with(compact("administrateurs"));
         } else {
             // Le username n'est pas présent dans la liste
         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->post('http://192.168.1.5:8080/api/v1/users-management/create/user',$test);

         $superviseurs = $response->json();

         return redirect()->route('superviseur')->with("success", "Superviseur ajouté avec succès")->with(compact("collecteurs"));
     }


     }

    public function delete( Request $request)
    {

        $donnees = $request->documentId;

        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://192.168.1.5:8080/api/v1/users-management/delete/user/' .$donnees;

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);

        return back()->with("successDelete", "Le superviseur a été supprimé avec succès");

    }

    public function update(Request $request,$id)
    {
        //ajouter un admin
        //ajouter un admin
        $request->validate([
            "firstName" => "required",
            "lastName" => "required",
            "matricule" => "required",
            "telephone" => "required|numeric",
            "roleId" => "required",
            "adress" => "required",
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

        //dd($test);

        $dataToUpdate = $test;

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();


        $response = $client->put("http://192.168.1.5:8080/api/v1/users-management/update/user/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);

        return redirect()->route('superviseur')->with("success", "Superviseur mis à jour avec succès");

    }
    public function edit($id)
    {
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.1.5:8080/api/v1/users-management/show/user/{userId}' . $id);


        $superviseur = $response->json();

        return view('Superviseur/edit',compact("superviseur"));
    }



}
