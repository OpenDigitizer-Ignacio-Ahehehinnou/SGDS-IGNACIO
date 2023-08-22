<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class ZoneController extends Controller
{
    public function index(){

         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');

         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.8.106:8080/api/v1/zones-management/show/zone');
 
         $zones = $response->json();
                //dd($zones);
        return view('Zone.index' , compact("zones"));
    }

    public function create()
    {
          // Récupérer la variable de la session
          $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.106:8080/api/v1/cities-management/show/city');

        $villes = $response->json();
        //dd($villes);
      
        return view('Zone.create', compact('villes'));
    }

    public function store(Request $request){

        dump($request);
     // Récupérez les données envoyées via AJAX
        $donnees = $request->all();

        dd($donnees);


       
        return back()->with("success", "Zone ajoutée avec succès");

    }
    

    
    public function update(Request $request, $id)
    {

        $request->validate([
            "zone" => "required",
            "ville" => "required"
        ]);

        $test = array();
        //$test['id'] = $id;
        $test['zoneId'] = $request['zoneId'];
        $test['nom'] = $request['zone'];
        $test['cityId'] = $request['ville'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['deletedFlag'] = $request['deletedFlag'];

        $dataToUpdate = $test;
       // dd($dataToUpdate);

        
        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();

        $response = $client->put("http://192.168.8.106:8080/api/v1/zones-management/update/zone/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);

        return back()->with("success", "Zone mise à jour avec succès");

        
    }

    public function edit($id)
    {
        
         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');

         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.8.106:8080/api/v1/zones-management/show/zone/{zoneId}' .$id);
 
         $zone = $response->json();
         //dd($ville);

         $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.106:8080/api/v1/cities-management/show/city');

        $villes = $response->json();
 
        return view('Zone/edit', compact("zone","villes"));
    }

    public function delete($id)
    {
        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://192.168.8.106:8080/api/v1/zones-management/delete/zone/' . $id;

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);

        return back()->with("successDelete", "La zone a été supprimée avec succès");
    }
}
