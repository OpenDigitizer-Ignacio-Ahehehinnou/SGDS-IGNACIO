<?php

namespace App\Http\Controllers;

use App\Models\Superviseurs;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class SuperviseurController extends Controller
{

    public function index()
    {
         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');

         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.8.106:8080/api/v1/user-management/show/user');
 
         $superviseurs = $response->json();

        return view('Superviseur/index',compact("superviseurs"));
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
        //ajouter un admin
        return view('Superviseur/create');
    }

    //Le store du create

    public function store(Request $request)
    {
        //ajouter un admin
       
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
       // $response = HTTP::withBody(json_encode($test))->post('http://192.168.100.14:8080/api/v1/user-management/created/user');

         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');
         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->post('http://192.168.8.106:8080/api/v1/user-management/created/user',$test);
         
         $superviseurs = $response->json();
 


            return back()->with("success", "Superviseur ajouté avec succè!")->with(compact("superviseurs"));

       // return view('Admin/create',compact("classes"));
    }

    public function delete(User $superviseur, $id)
    {

        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://192.168.8.106:8080/api/v1/user-management/delete/user/{$id}' . $id;

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
            "telephone" => "required",
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


        $response = $client->put("http://192.168.8.106:8080/api/v1/user-management/update/user/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);

           return back()->with("success", "Superviseur mis à jour avec succè!");

    }
    public function edit($id)
    {
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.106:8080/api/v1/user-management/show/user/{userId}' . $id);


        $superviseur = $response->json();

        return view('Superviseur/edit',compact("superviseur"));
    }



}
