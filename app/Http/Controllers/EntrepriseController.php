<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entreprises;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    
    public $view_administrateur_nom, $view_student_prenom, $view_student_telephone;

    public function index()
    {

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.103:8080/api/v1/entreprise-management/show/entreprise');

         $entreprises = $response->json();
        //dd($entreprises);

        return view('Entreprise/index',compact("entreprises"));
        
    }
    

    public function detail(Request $request,$id)
    {
    

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://192.168.8.103:8080/api/v1/entreprises_zones-management/show/entreprises_zone/{$id}");

        $entreprises = $response->json();
       // dd($entreprises);
        $zoneIds = []; // Initialiser un tableau pour stocker les zoneIds

        foreach ($entreprises as $entreprise) {
            // Vérifier si la clé 'zoneId' existe dans chaque élément
            if (isset($entreprise['zoneId'])) {
                // Ajouter la valeur 'zoneId' au tableau $zoneIds
                $zoneIds[] = $entreprise['zoneId'];
            }
        }
        
        // Maintenant, $zoneIds contient toutes les valeurs 'zoneId' du tableau JSON
       // dump($zoneIds);

        foreach ($zoneIds as $zoneId) {
            $response = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get("http://192.168.8.103:8080/api/v1/zones-management/show/zone/{$zoneId}");
        
            $zone = $response->json();
            
            // Vérifiez si la réponse contient des données valides avant d'ajouter à $zones
            if (!empty($zone)) {
                $zones[] = $zone;
            }
        }
        
        // Maintenant, $zones contient les zones correspondant aux identifiants de zone dans $zoneIds
        //dd($zones);
        

        return view('entreprise/voir',compact('zones'));
    }


    public function create()
    {

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.103:8080/api/v1/zones-management/show/zone');

        $zones = $response->json();
       // dd($zones);
        return view('Entreprise/create',compact('zones'));
    }

    //Le store du create

    public function store(Request $request)
    {
        
        $request->validate([
            "name"=>"required",
            "ifu"=>"required",
            "email"=>"required",
            "siege"=>"required",
            "adress"=>"required",
            "telephone"=>"required",
        ]);
         //ajouter un admin
         $test = array();
        //$test['id'] = $id;
         $test['name'] = $request['name'];
         $test['adress'] = $request['adress'];
         $test['nom_responsable'] = $request['nom_responsable'];
         $test['email'] = $request['email'];
         $test['zoneId'] = $request['zone'];

         $test['ifu'] = $request['ifu'];
         $test['telephone'] = $request['telephone'];
         $test['siege'] = $request['siege'];
         $test['creatorUsername'] = $request['creatorUsername'];
         $test['creatorId'] = $request['creatorId'];
         $test['createdAt'] = $request['createdAt'];
         $test['deletedFlag'] = $request['deletedFlag'];
    
          
        //dd($test);

      

        
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://192.168.8.103:8080/api/v1/entreprise-management/create/entreprises',$test);
        
        $entreprises = $response->json();
        $entrepriseId = $entreprises['entrepriseId'];
        //dump($entreprises);
        $test2 = array();
        $test2['zoneId'] = $request['zone'];
        $test2['entrepriseId'] = $entrepriseId;

        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://192.168.8.103:8080/api/v1/entreprises_zones-management/create/entreprise_zone',$test2);
        

        $entreprisesZone = $response->json();
        //dd($entreprisesZone);

       return redirect()->route('entreprise')->with("success", "Entreprise ajouté avec succès")->with(compact("entreprises"));;

       // return view('Admin/create',compact("classes"));
    }

    public function delete(Request $request)
    {

        $donnees = $request->documentId;
            //dd($donnees);

        $variableRecuperee = session('variableEnvoyee');
    
        $url = 'http://192.168.8.103:8080/api/v1/entreprise-management/delete/entreprises/' . $donnees;
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);
    
        return back()->with("successDelete", "Entreprise a été supprimé avec succès");

    }
    

    public function update(Request $request, $id)
    {
        //ajouter un admin
        $request->validate([
            "name"=>"required",
            "ifu"=>"required",
            "email"=>"required",
            "siege"=>"required",
            "adress"=>"required",
            "telephone"=>"required",
        ]);
    
        $test = array();
        //$test['id'] = $id;
        $test['name'] = $request['name'];
        $test['address'] = $request['address'];
        $test['siege'] = $request['siege'];
        $test['telephone'] = $request['telephone'];
        $test['ifu'] = $request['ifu'];
        $test['email'] = $request['email'];
        $test['entrepriseId'] = $request['entrepriseId'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['deletedFlag'] = $request['deletedFlag'];


        //dd($test);
        $dataToUpdate = $test;

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();


        $response = $client->put("http://192.168.8.103:8080/api/v1/entreprise-management/update/entreprise/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);

        
        //$response = HTTP::withBody(json_encode($test))->put('http://192.168.100.14:8080/api/v1/entreprise-management/update/entreprise/{id}' . $id);
       
        
        return redirect()->route('entreprise')->with("success", "Entreprise mis à jour avec succès");

       // return view('Admin/create',compact("classes"));
    }
    public function edit($id)
    {
        
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.103:8080/api/v1/entreprise-management/show/entreprise/{entrepriseId}' . $id);

        $entreprise = $response->json();

        return view('Entreprise/edit',compact("entreprise"));
    }
}
