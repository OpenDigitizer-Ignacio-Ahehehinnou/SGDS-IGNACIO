<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

class DepartementController extends Controller
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
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-department/find/department/non_deleted-activate');

        $departementss = $response->json();
        $departements=$departementss['data']['content'];

        //dd($departements);

        return view('Departement.index', compact("departements"));
    }

    public function ListeDesactiver()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        //liste des categories active
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-department/find/department/non_deleted-disable');

        $departementss = $response->json(); 
        $departements=$departementss['data']['content'];
        //$id=$communes['departementId'];
       //dd($communes);
        return view('Departement.departementDesactiver', compact("departements"));
    }



    public function create()
    {
        //ajouter un admin

        return view('Departement/create');
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
        $test['countryName'] = $request['countryName'];


        // Récupérer la variable de la session
        // $variableRecuperee = session('variableEnvoyee');
        // $response = HTTP::withHeaders([
        //     'Authorization' => 'Bearer ' . $variableRecuperee,
        // ])->post('http://'.$ip_adress.'/odsolidwaist/manages-category/create/category', $test);

        // Récupérer la variable de session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::post('http://'.$ip_adress.'/odsolidwaist/manages-department/create/department', $test);
    
        $departementss = $response->json();

        //dd($departementss);

        if($departementss['code']=== 200){
        $departements=$departementss['data'];

       // dd($departements);
        
        return redirect()->route('departement')->with("success", "Département ajoutée avec succès")->with(compact("departements"));
        }else{
           // dd(10);
            return redirect()->route('departement')->with("success", "Echec lors de l'\ajout de la catégorie");

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
        //$test['id'] = $id;
        $test['departmentId'] = $request['departmentId'];
        $test['establishedDate'] = $request['establishedDate'];
        $test['name'] = $request['name'];
        $test['code'] = $request['code'];
        $test['population'] = $request['population'];
        $test['isEnabled'] = true;
        $test['areaKm2'] = $request['areaKm2'];
        $test['deletedFlag'] = $request['deletedFlag'];
        $test['countryName'] = $request['countryName'];

        $dataToUpdate = $test;
       // dd($test);

        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();
        
        $response = $client->put("http://192.168.8.110:8080/odsolidwaist/manages-department/update/department", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);
        // $variableRecuperee = session('variableEnvoyee');
        // $response = HTTP::put('http://'.$ip_adress.'/odsolidwaist/manages-category/update/category');
    
        //dd($response);

        return redirect()->route('departement')->with("success", "Departement mis à jour avec succès");
    }

    public function edit($id)
    {
        $ip_adress = env('APP_IP_ADRESS');

        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-department/find/department/{departmentId}' . $id);
    
        // $variableRecuperee = session('variableEnvoyee');
        // $response = HTTP::get('http://'.$ip_adress.'/odsolidwaist/manages-department/find/department/{departmentId}' . $id);
    
        $departements = $response->json();
        //dd($categories);
        $departement=$departements['data'];
       //dd($departement);

        return view('Departement/edit', compact("departement"));
    }


    public function desactiver(Request $request)
    {

        try{
            //dd($request);
            $ip_adress = env('APP_IP_ADRESS');


            $id = $request['departmentId'];
        // dd($id);
        
        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-department/disable/department/' . $id);
    
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


            $id = $request['departmentId'];
        //dd($id);
        
        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-department/activate/department/' . $id);
    
        return new Response(200);
        } catch (Exception $e) {
                    //dd(0);
                    //return new Response(500);
                }
    }




}
