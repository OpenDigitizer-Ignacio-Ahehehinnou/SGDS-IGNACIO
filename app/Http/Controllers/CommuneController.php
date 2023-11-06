<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class CommuneController extends Controller
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
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-municipality/find/municipality/non_deleted-activate');

        $communess = $response->json(); 
        $communes1=$communess['data']['content'];
        //$id=$communes['departementId'];
       //dd($communes);
       $currentPage = Paginator::resolveCurrentPage() ?: 1;
       $perPage = 10;
       $communes = new LengthAwarePaginator(
           array_slice($communes1, ($currentPage - 1) * $perPage, $perPage),
           count($communes1),
           $perPage,
           $currentPage,
           ['path' => Paginator::resolveCurrentPath()]
       );



        return view('Commune.index', compact("communes"));
    }

    public function ListeDesactiver()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        //liste des categories active
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-municipality/find/municipality/non_deleted-disable');

        $communess = $response->json(); 
        $communes1=$communess['data']['content'];
        //$id=$communes['departementId'];
       //dd($communes);
       $currentPage = Paginator::resolveCurrentPage() ?: 1;
       $perPage = 10;
       $communes = new LengthAwarePaginator(
           array_slice($communes1, ($currentPage - 1) * $perPage, $perPage),
           count($communes1),
           $perPage,
           $currentPage,
           ['path' => Paginator::resolveCurrentPath()]
       );


        return view('Commune.communeDesactiver', compact("communes"));
    }



    public function create()
    {
        //ajouter un admin

        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        //liste des categories active
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-department/find/department/active');

        $departementss = $response->json();
        $departements=$departementss['data']['content'];


        return view('commune/create',compact('departements'));
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
        $test['departmentId'] = $request['departmentId'];

        
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://'.$ip_adress.'/odsolidwaist/manages-municipality/create/municipality', $test);
    
        // Récupérer la variable de session

        $communess = $response->json();

        //dd($communess);

        if($communess['code']=== 200){
        $communes=$communess['data'];

        //dd($communes);
        
        return redirect()->route('commune')->with("success", "Commune ajoutée avec succès")->with(compact("communes"));
        }else{
           // dd(10);
            return redirect()->route('commune')->with("success", "Echec lors de l'\ajout de la commune");

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
        $test['municipalityId'] = $request['municipalityId'];
        $test['establishedDate'] = $request['establishedDate'];
        $test['name'] = $request['name'];
        $test['code'] = $request['code'];
        $test['population'] = $request['population'];
        $test['isEnabled'] = true;
        $test['areaKm2'] = $request['areaKm2'];
        $test['deletedFlag'] = $request['deletedFlag'];
        $test['createdBy'] = $request['createdBy'];
        $test['createdAt'] = $request['createdAt'];
        $test['departmentId'] = $request['departmentId'];

        $dataToUpdate = $test;
       // dd($test);

        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();
        
        $response = $client->put("http://".$ip_adress. "/odsolidwaist/manages-municipality/update/municipality", [
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

        return redirect()->route('commune')->with("success", "Commune mis à jour avec succès");
    }

    public function edit($id)
    {
        $ip_adress = env('APP_IP_ADRESS');

        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-municipality/find/municipality/{municipalityId}' . $id);
    
        // $variableRecuperee = session('variableEnvoyee');
        // $response = HTTP::get('http://'.$ip_adress.'/odsolidwaist/manages-department/find/department/{departmentId}' . $id);
    
        $communes = $response->json();
        //dd($categories);
        $commune=$communes['data'];
       //dd($departement);

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-department/find/department/active');

        $departementss = $response->json();
        $departements=$departementss['data']['content'];


        return view('Commune/edit', compact("commune","departements"));
    }

    public function delete(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $donnees = $request->documentId;
            //dd($donnees);

        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-municipality/delete/municipality/' . $donnees);
    
        return back()->with("successDelete", "Communea été supprimé avec succès");

    }


    public function desactiver(Request $request)
    {

        try{
            //dd($request);
            $ip_adress = env('APP_IP_ADRESS');


            $id = $request['communeId'];
        // dd($id);
        
        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-municipality/disable/municipality/' . $id);
    
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


            $id = $request['communeId'];
        // dd($id);
        
        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-municipality/activate/municipality/' . $id);
    
        return new Response(200);
        } catch (Exception $e) {
                    //dd(0);
                    //return new Response(500);
                }
    }




}
