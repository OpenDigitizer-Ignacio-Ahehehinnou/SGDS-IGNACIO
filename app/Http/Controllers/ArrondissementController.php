<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

class ArrondissementController extends Controller
{
    //

    public function index()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        //liste des categories active
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-district/find/district/non_deleted-activate');

        $arrondissementss = $response->json();
        $arrondissements=$arrondissementss['data']['content'];
        //$id=$communes['departementId'];
       // dd($arrondissements);
        return view('Arrondissement.index', compact("arrondissements"));
    }


    public function ListeDesactiver()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        //liste des categories active
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-district/find/district/non_deleted-disable');

        $arrondissementss = $response->json();
        $arrondissements=$arrondissementss['data']['content'];
        //$id=$communes['departementId'];
       // dd($arrondissements);
        return view('Arrondissement.ArrondissementDesactiver', compact("arrondissements"));
    }




    public function create()
    {
        //ajouter un admin
        $ip_adress = env('APP_IP_ADRESS');

        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-municipality/find/municipality/non_deleted-activate');

        $communess = $response->json(); 
        $communes=$communess['data']['content'];
       
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/find/entreprise/active');

        $entreprisess = $response->json();
        //dd($entreprisess);
        $entreprises=$entreprisess['data']['content'];
    

        return view('arrondissement/create',compact('entreprises','communes'));
    }

    public function store(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $request->validate([
            "name" => "required",
            "code" => "required"
        ]);

        $test = array();
        $test['establishedDate'] = $request['establishedDate'];
        $test['name'] = $request['name'];
        $test['code'] = $request['code'];
        $test['population'] = $request['population'];
        $test['isEnabled'] = true;
        $test['areaKm2'] = $request['areaKm2'];
        $test['deletedFlag'] = $request['deletedFlag'];
        $test['createdBy'] = $request['createdBy'];
        $test['createdAt'] = $request['createdAt'];
        $test['municipalityId'] = $request['municipalityId'];
        $test['entrepriseId'] = $request['entrepriseId'];

        
        // Récupérer la variable de la session
        // $variableRecuperee = session('variableEnvoyee');
        // $response = HTTP::withHeaders([
        //     'Authorization' => 'Bearer ' . $variableRecuperee,
        // ])->post('http://'.$ip_adress.'/odsolidwaist/manages-category/create/category', $test);

        // Récupérer la variable de session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::post('http://'.$ip_adress.'/odsolidwaist/manages-district/create/district', $test);
    
        $arrondissementss = $response->json();

        //dd($communess);

        if($arrondissementss['code']=== 200){
        $arrondissements=$arrondissementss['data'];

        //dd($arrondissements);
        
        return redirect()->route('arrondissement')->with("success", "Arrondissement ajoutée avec succès")->with(compact("arrondissements"));
        }else{
           // dd(10);
            return redirect()->route('arrondissement')->with("success", "Echec lors de l'\ajout de l'\arrondissement");

        }
    }


    public function update(Request $request, $departement)
    {

        $ip_adress = env('APP_IP_ADRESS');

        $request->validate([
            "code" => "required",
            "name" => "required",
        ]);

        $test = array();
        $test['districtId'] = $request['districtId'];
        $test['establishedDate'] = $request['establishedDate'];
        $test['name'] = $request['name'];
        $test['code'] = $request['code'];
        $test['population'] = $request['population'];
        $test['isEnabled'] = true;
        $test['areaKm2'] = $request['areaKm2'];
        $test['deletedFlag'] = $request['deletedFlag'];
        $test['createdBy'] = $request['createdBy'];
        $test['createdAt'] = $request['createdAt'];
        $test['municipalityId'] = $request['municipalityId'];
        $test['entrepriseId'] = $request['entrepriseId'];

        $dataToUpdate = $test;
      // dd($test);

        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();
        
        $response = $client->put("http://192.168.8.101:8080/odsolidwaist/manages-district/update/district", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);
        
        return redirect()->route('arrondissement')->with("success", "Arrondissement mis à jour avec succès");
    }

    public function edit($id)
    {
        $ip_adress = env('APP_IP_ADRESS');

        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-district/find/district/{districtId}' . $id);
    
    
        $arrondissementss = $response->json();
        //dd($categories);
        $arrondissement=$arrondissementss['data'];
       //dd($departement);

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-municipality/find/municipality/{municipalityId}' . $id);

        $response1 = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-municipality/find/municipality/non_deleted-activate');

        $communess = $response->json();
        $communess1 = $response1->json();

        $commune=$communess['data'];
        $commune1=$communess1['data']['content'];

           // dd($commune1);
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/find/entreprise/{entrepriseId}' . $id);

        $entreprisess = $response->json();
       //dd($entreprisess);
        $entreprises=$entreprisess['data'];

        //dd($entreprises,$commune);
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/find/entreprise/active');

        $entreprises2 = $response->json();
        //dd($entreprisess);
        $entreprises22=$entreprises2['data']['content'];
    

        return view('Arrondissement/edit', compact("arrondissement","commune","commune1","entreprises","entreprises22"));
    }


    
    public function desactiver(Request $request)
    {

        try{
            //dd($request);
            $ip_adress = env('APP_IP_ADRESS');


            $id = $request['districtId'];
        // dd($id);
        
        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-district/disable/district/' . $id);
    
        return new Response(200);
        } catch (Exception $e) {
                    //dd(0);
                    //return new Response(500);
                }
    }

    public function activer(Request $request)
    {

        try{
            //dd($request);
            $ip_adress = env('APP_IP_ADRESS');


            $id = $request['districtId'];
        //dd($id);
        
        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-district/activate/district/' . $id);
    
        return new Response(200);
        } catch (Exception $e) {
                    //dd(0);
                    //return new Response(500);
                }
    }



}
