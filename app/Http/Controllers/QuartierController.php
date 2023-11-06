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

class QuartierController extends Controller
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
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-neighborhood/find/neighborhood/non_deleted-activate');

        $quartierss = $response->json();
        $quartiers1=$quartierss['data']['content'];
        //$id=$communes['departementId'];
       //dd($quartierss);

       $currentPage = Paginator::resolveCurrentPage() ?: 1;
       $perPage = 10;
       $quartiers = new LengthAwarePaginator(
           array_slice($quartiers1, ($currentPage - 1) * $perPage, $perPage),
           count($quartiers1),
           $perPage,
           $currentPage,
           ['path' => Paginator::resolveCurrentPath()]
       );


        return view('Quartier.index', compact("quartiers"));
    }


    public function ListeDesactiver()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        //liste des categories active
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-neighborhood/find/neighborhood/non_deleted-disable');

        $quartierss = $response->json();
        $quartiers1=$quartierss['data']['content'];
        //$id=$communes['departementId'];
       // dd($arrondissements);
       $currentPage = Paginator::resolveCurrentPage() ?: 1;
       $perPage = 10;
       $quartiers = new LengthAwarePaginator(
           array_slice($quartiers1, ($currentPage - 1) * $perPage, $perPage),
           count($quartiers1),
           $perPage,
           $currentPage,
           ['path' => Paginator::resolveCurrentPath()]
       );


        return view('Quartier.QuartierDesactiver', compact("quartiers"));
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
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-district/find/district/non_deleted-activate');

        $arrondissementss = $response->json();
        $arrondissements=$arrondissementss['data']['content'];
        

        return view('Quartier/create',compact(('arrondissements')));
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
        $test['districtId'] = $request['districtId'];

        
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://'.$ip_adress.'/odsolidwaist/manages-neighborhood/create/neighborhood', $test);
    
        
        $quartierss = $response->json();

        //dd($quartierss);

        if($quartierss['code']=== 200){
        $quartiers=$quartierss['data'];

        //dd($quartiers);
        
        return redirect()->route('quartier')->with("success", "Quartier ajouté avec succès")->with(compact("quartiers"));
        }else{
           // dd(10);
            return redirect()->route('quartier')->with("success", "Echec lors de l'\ajout du quartier");

        }
   
    }

    public function desactiver(Request $request)
    {

        try{
            //dd($request);
            $ip_adress = env('APP_IP_ADRESS');


            $id = $request['neighborhoodId'];
        //dd($id);
        
        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-neighborhood/disable/neighborhood/' . $id);
    
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


            $id = $request['neighborhoodId'];
        //dd($id);
        
        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-neighborhood/activate/neighborhood/' . $id);
    
        return new Response(200);
        } catch (Exception $e) {
                    //dd(0);
                    //return new Response(500);
                }
    }

    public function delete(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $donnees = $request->documentId;
       // dd($donnees);

        $variableRecuperee = session('variableEnvoyee');

        // $url = 'http://'.$ip_adress.'/odsolidwaist/manages-category/delete/category/{categoryId}/' . $donnees;

        // $response = HTTP::withHeaders([
        //     'Authorization' => 'Bearer ' . $variableRecuperee,
        // ])->put($url);

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-neighborhood/delete/neighborhood/' . $donnees);
    

        return back()->with("successDelete", "Le quartier a été supprimé avec succès");
    }


    public function update(Request $request, $departement)
    {

        $ip_adress = env('APP_IP_ADRESS');

        $request->validate([
            "code" => "required",
            "name" => "required",
        ]);

        $test = array();
        $test['neighborhoodId'] = $request['neighborhoodId'];
        $test['establishedDate'] = $request['establishedDate'];
        $test['name'] = $request['name'];
        $test['code'] = $request['code'];
        $test['districtId'] = $request['districtId'];
        $test['isEnabled'] = true;
        $test['areaKm2'] = $request['areaKm2'];
        $test['deletedFlag'] = $request['deletedFlag'];
        $test['createdBy'] = $request['createdBy'];
        $test['createdAt'] = $request['createdAt'];

        $dataToUpdate = $test;
      // dd($test);

        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();
        
        $response = $client->put("http://" . $ip_adress . "/odsolidwaist/manages-neighborhood/update/neighborhood", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);
        
        return redirect()->route('quartier')->with("success", "Quartier mis à jour avec succès");
    }

    public function edit($id)
    {
        $ip_adress = env('APP_IP_ADRESS');

        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-neighborhood/find/neighborhood/{neighborhoodId}' . $id);
    
    
        $quartier = $response->json();
        //dd($categories);
        $quartiers=$quartier['data'];
      // dd($quartiers);

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-district/find/district/non_deleted-activate');

        $arrondissementss = $response->json();

        $arrondissements=$arrondissementss['data']['content'];
        //dd($arrondissements);


        return view('Quartier/edit', compact("quartiers","arrondissements"));
    }


}
