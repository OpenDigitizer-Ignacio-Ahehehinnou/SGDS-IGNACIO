<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use GuzzleHttp\Client;


use function Pest\Laravel\json;

class AdministrateurController extends Controller
{

    public function index()
    {
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $entreprise = session('entreprise');
        $role = session('role');

            //dd($entreprise);
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.103:8080/api/v1/users-management/show/user');

        $administrateurs = $response->json();
       //dd($administrateurs);

        return view('Admin/index', compact("administrateurs","entreprise","role"));
    }




    public function create()
    {

         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');
         $entreprise = session('entreprise');
         $role = session('role');

            //dd($entreprise);
         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.8.103:8080/api/v1/entreprise-management/show/entreprise');
 
          $entreprises = $response->json();
         //dd($entreprises);
 
        //ajouter un admin
        return view('Admin/create',compact('entreprises','entreprise','role'));
    }

    //Le store du create

    public function store(Request $request)
    {

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

        //ajouter un admin
        $donnees = $request->all();

       
        $test = array();
        //$test['id'] = $id;
       // $test['userId'] = $donnees['userId'];
        $test['firstName'] = $donnees['firstName'];
        $test['lastName'] = $donnees['lastName'];
        $test['matricule'] = $donnees['matricule'];
        $test['telephone'] = $donnees['telephone'];
        $test['photoProfil'] = $donnees['photo'];

        $test['adress'] = $donnees['adress'];
        $test['username'] = $donnees['username'];
        $test['password'] = $donnees['password'];
        $test['activationStatus'] = $donnees['activationStatus'];
        $test['entrepriseId'] = $donnees['entrepriseId'];
        $test['creatorUsername'] = $donnees['creatorUsername'];
        $test['creatorId'] = $donnees['creatorId'];
        $test['createdAt'] = $donnees['createdAt'];
        $test['roleId'] = $donnees['roleId'];
        $test['deletedFlag'] = $donnees['deletedFlag'];
        //dd($test);
        
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://192.168.8.103:8080/api/v1/users-management/create/user',$test);

        $administrateurs = $response->json();

        //return  back()->with("success", "Administrateur ajouté avec succè!")->with(compact("administrateurs"));
        return redirect()->route('admin')->with("success", "Administrateur ajouté avec succès")->with(compact("administrateurs"));

    }

    public function delete(Request $request)
    {
        $donnees = $request->documentId;
        //dd($donnees);

        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://192.168.8.103:8080/api/v1/users-management/delete/user/' .$donnees;

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);


        return back()->with("successDelete", "L'administrateur a été supprimé avec succès");

    }

    public function update(Request $request, $id)
    {

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

        $response = $client->put("http://192.168.8.103:8080/api/v1/users-management/update/user/{$id}", [
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
        //ajouter un admin

           // Récupérer la variable de la session
           $variableRecuperee = session('variableEnvoyee');
           $response = HTTP::withHeaders([
               'Authorization' => 'Bearer ' . $variableRecuperee,
           ])->get('http://192.168.8.103:8080/api/v1/users-management/show/user/' . $id);


        $administrateur = $response->json();
        //dd($administrateur);

        return view('Admin/edit', compact("administrateur"));
    }
}
