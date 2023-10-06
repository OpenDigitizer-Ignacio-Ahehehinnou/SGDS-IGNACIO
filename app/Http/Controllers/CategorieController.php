<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class CategorieController extends Controller
{
    //

    public function index()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/api/v1/categories-management/show/category');

        $categories = $response->json();
        //dd($categories);

        return view('Categorie.index', compact("categories"));
    }

    public function create()
    {
        //ajouter un admin

        return view('Categorie/create');
    }

    public function store(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $request->validate([
            "nom" => "required",
            "type" => "required"
        ]);

        $test = array();
        $test['type'] = $request['type'];
        $test['nom'] = $request['nom'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['deletedFlag'] = $request['deletedFlag'];


        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://'.$ip_adress.'/api/v1/categories-management/create/category', $test);

        $categories = $response->json();

        //dd($villes);

        // return back()->with("success", "Ville ajoutée avec succès")->with(compact("villes"));
        return redirect()->route('categorie')->with("success", "Catégorie ajoutée avec succès")->with(compact("categories"));
    }

    public function delete(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $donnees = $request->documentId;

        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://'.$ip_adress.'/api/v1/categories-management/delete/category/' . $donnees;

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);

        return back()->with("successDelete", "La catégorie a été supprimée avec succès");
    }


    public function update(Request $request, $id)
    {

        $ip_adress = env('APP_IP_ADRESS');

        $request->validate([
            "type" => "required",
            "nom" => "required",

        ]);

        $test = array();
        //$test['id'] = $id;
        $test['categoryId'] = $request['categoryId'];
        $test['type'] = $request['type'];
        $test['nom'] = $request['nom'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['deletedFlag'] = $request['deletedFlag'];

        $dataToUpdate = $test;


        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();

        $response = $client->put("http://192.168.1.6:8080/api/v1/categories-management/update/category/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);

        return redirect()->route('categorie')->with("success", "Catégorie mis à jour avec succès");
    }

    public function edit($id)
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/api/v1/categories-management/show/category/{categorieId}' . $id);

        $categorie = $response->json();
        //dd($ville);

        return view('Categorie/edit', compact("categorie"));
    }
}
