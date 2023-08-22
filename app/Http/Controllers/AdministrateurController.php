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
        //créer un admin

        // $administrateur1 = HTTP::get('http://192.168.8.106:8080/api/v1/user-management/show/user');
        // $administrateurs = $administrateur1->json();
        //      //dd($administrateurs);


        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.106:8080/api/v1/user-management/show/user');

        $administrateurs = $response->json();
        //dd($administrateurs);

        return view('Admin/index', compact("administrateurs"));
    }




    public function create()
    {
        //ajouter un admin
        return view('Admin/create');
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


        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://192.168.8.106:8080/api/v1/user-management/created/user',$test);

        $administrateurs = $response->json();

        return  back()->with("success", "Administrateur ajouté avec succè!")->with(compact("administrateurs"));
        //return redirect('/admin');

    }

    public function delete($id)
    {

        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://192.168.8.106:8080/api/v1/user-management/delete/user/' . $id;

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


        $dataToUpdate = $test;


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

        return back()->with("success", "Administrateur mise à jour avec succès");


    }
    public function edit($id)
    {
        //ajouter un admin

           // Récupérer la variable de la session
           $variableRecuperee = session('variableEnvoyee');
           $response = HTTP::withHeaders([
               'Authorization' => 'Bearer ' . $variableRecuperee,
           ])->get('http://192.168.8.106:8080/api/v1/user-management/show/user/' . $id);


        $administrateur = $response->json();
        //dd($administrateur);

        return view('Admin/edit', compact("administrateur"));
    }
}
