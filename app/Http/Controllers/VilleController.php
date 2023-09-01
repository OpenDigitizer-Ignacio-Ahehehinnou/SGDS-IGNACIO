<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class VilleController extends Controller
{
    //

    public function index(){

         // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.103:8080/api/v1/cities-management/show/city');

        $villes = $response->json();
       // dd($villes);

        return view('Ville.index', compact("villes"));
    }

    public function create()
    {
        //ajouter un admin

        return view('Ville/create');
    }

    public function store(Request $request){

        $request->validate([
            "code" => "required",
            "nom" => "required|alpha"
        ]);

        $test = array();
        $test['code'] = $request['code'];
        $test['nom'] = $request['nom'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['deletedFlag'] = $request['deletedFlag'];

        
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://192.168.8.103:8080/api/v1/cities-management/create/city',$test);
        
        $villes = $response->json();

        
        
        // return back()->with("success", "Ville ajoutée avec succès")->with(compact("villes"));
        return redirect()->route('ville')->with("success", "Ville ajoutée avec succès")->with(compact("villes"));

        
    }

    public function delete(Request $request)
    {
        $donnees = $request->documentId;

        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://192.168.8.103:8080/api/v1/cities-management/delete/city/' . $donnees;

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);

        return back()->with("successDelete", "La ville a été supprimée avec succès");
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            "code" => "required",
            "nom" => "required|alpha",
            
        ]);

        $test = array();
        //$test['id'] = $id;
        $test['cityId'] = $request['cityId'];
        $test['code'] = $request['code'];
        $test['nom'] = $request['nom'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['deletedFlag'] = $request['deletedFlag'];

        $dataToUpdate = $test;

        
        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();

        $response = $client->put("http://192.168.8.103:8080/api/v1/cities-management/update/city/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);

        return redirect()->route('ville')->with("success", "Ville mis à jour avec succès");

        
    }

    public function edit($id)
    {
        
         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');

         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.8.103:8080/api/v1/cities-management/show/city/{cityId}' .$id);
 
         $ville = $response->json();
         //dd($ville);
 
        return view('Ville/edit', compact("ville"));
    }



}
