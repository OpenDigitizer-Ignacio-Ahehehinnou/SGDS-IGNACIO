<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Exception;



class ZoneController extends Controller
{
    public function index(){

         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');

         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.8.103:8080/api/v1/zones-management/show/zone');
 
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
        ])->get('http://192.168.8.103:8080/api/v1/cities-management/show/city');

        $villes = $response->json();
        //dd($villes);
      
        return view('Zone.create', compact('villes'));
    }

    public function store(Request $request){

        // Récupérez les données envoyées via AJAX
        $donnees = $request->all();

            //dd($donnees);
        
        // Créez un tableau associatif avec la structure souhaitée
        $zonePoint = [
            'zoneDto' => [
                'createdAt' => "2023-08-02T11:37:47.544+00:00",
                'creatorId' => 1,
                'creatorUsername' => 'Me',
                'deletedFlag' => 'sss',
                'nom' => $donnees['nom'],
                'cityId' => $donnees['ville']
            ],
            'pointsDtos' => []
        ];
    
        // Ajoutez les données du tableau dans la structure souhaitée
        foreach ($donnees['tableauDonnees'] as $item) {
            $point = [
                'altitude' => "2023-08-02T11:37:47.544+00:00",
                'createdAt' => "2023-08-02T11:37:47.544+00:00",
                'creatorId' => 1,
                'creatorUsername' => "2023-08-02T11:37:47.544+00:00",
                'deletedFlag' => 's',
                'latitude' => $item['latitude'],
                'longitude' => $item['longitude'],
                'ordre' => $item['ordre'],
                'zoneId' => 1
            ];
    
            $zonePoint['pointsDtos'][] = $point;
        }
        try {

            $variableRecuperee = session('variableEnvoyee');
            $response = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->post('http://192.168.8.103:8080/api/v1/zones-management/create/zone_with_points',$zonePoint);
            
            $zones = $response->json();
            //dd($zones);
            return new Response(200);
        } catch (Exception $e) {
        
            return new Response(500);
        }

    }
    
        
    public function update(Request $request, $id)
    {

       // dd($id,$request);

        $request->validate([
            "zone" => "required",
            "ville" => "required"
        ]);

        $test = array();
       // $test['id'] = $id;
        $test['zoneId'] = $id;
        $test['nom'] = $request['zone'];
        $test['cityId'] = $request['ville'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['deletedFlag'] = $request['deletedFlag'];
           // $id=$request['id'];
        $dataToUpdate = $test;
        //dd($dataToUpdate);

        
        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();

        $response = $client->put("http://192.168.8.103:8080/api/v1/zones-management/update/zone/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);
            //dd($response);
            return redirect()->route('zone')->with("success", "Zone mis à jour avec succès");

    }

    public function edit($id)
    {
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
    
        // Utilisez la bonne syntaxe pour inclure $id dans l'URL
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://192.168.8.103:8080/api/v1/zones-management/show/zone/{$id}");
    
        $zone = $response->json();

       // dd($zone);
    
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.103:8080/api/v1/cities-management/show/city');
    
        $villes = $response->json();
    
        return view('Zone/edit', compact("zone", "villes"));
    }
    

    public function delete(Request $request)
    {

        $donnees = $request->documentId;

        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://192.168.8.103:8080/api/v1/zones-management/delete/zone/' . $donnees;

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);

        return back()->with("successDelete", "La zone a été supprimée avec succès");
    }
}
