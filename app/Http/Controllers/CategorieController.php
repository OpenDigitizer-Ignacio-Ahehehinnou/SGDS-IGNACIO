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
        //liste des categories active
        $response1 = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-category/find/category/active');

        //dd($response1);

        $response2 = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-category/find/category/deleted');

        $response3 = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-category/find/category/all');

        $categoriess = $response1->json();
        $categoriessSup= $response2->json();
        $categoriessT = $response3->json();

        $categories=$categoriess['data']['content'];
        $categoriesSupprimer=$categoriessSup['data']['content'];
        $categoriesTout=$categoriessT['data']['content'];


       // dd($categoriesSupprimer);

        return view('Categorie.index', compact("categories","categoriesSupprimer","categoriesTout"));
    }

    public function detail(){

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
        $test['code'] = $request['code'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['deletedFlag'] = $request['deletedFlag'];
        $test['createdBy'] = $request['createdBy'];


        // Récupérer la variable de la session
        // $variableRecuperee = session('variableEnvoyee');
        // $response = HTTP::withHeaders([
        //     'Authorization' => 'Bearer ' . $variableRecuperee,
        // ])->post('http://'.$ip_adress.'/odsolidwaist/manages-category/create/category', $test);

        // Récupérer la variable de session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::post('http://'.$ip_adress.'/odsolidwaist/manages-category/create/category', $test);
    
        $categoriess = $response->json();

        //dd($categoriess);

        if($categoriess['code']=== 200){
        $categories=$categoriess['data'];

        //dd($categories);
        
        return redirect()->route('categorie')->with("success", "Catégorie ajoutée avec succès")->with(compact("categories"));
        }else{
            //dd(10);
            return redirect()->route('categorie')->with("success", "Echec lors de l'\ajout de la catégorie");

        }
   
    }

    public function delete(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $donnees = $request->documentId;
        //dd($donnees);

        $variableRecuperee = session('variableEnvoyee');

        // $url = 'http://'.$ip_adress.'/odsolidwaist/manages-category/delete/category/{categoryId}/' . $donnees;

        // $response = HTTP::withHeaders([
        //     'Authorization' => 'Bearer ' . $variableRecuperee,
        // ])->put($url);

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-category/delete/category/' . $donnees);
    

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
        $test['code'] = $request['code'];

        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['deletedFlag'] = $request['deletedFlag'];

        // $dataToUpdate = $test;
        //dd($test);

        // $variableRecuperee = session('variableEnvoyee');

        // // Créez une instance du client GuzzleHttp
        // $client = new Client();
        // $response = $client->request('PUT', 'http://192.168.8.103:8080/odsolidwaist/manages-category/update/category', [
        // 'headers' => [
        //     'Authorization' => 'Bearer ' . $variableRecuperee,
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        // ],
        // 'json' => $dataToUpdate,
        // ]);
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::put('http://'.$ip_adress.'/odsolidwaist/manages-category/update/category', $test);
    
        // $variableRecuperee = session('variableEnvoyee');
        // $response = HTTP::put('http://'.$ip_adress.'/odsolidwaist/manages-category/update/category');
    
        //dd($response);

        return redirect()->route('categorie')->with("success", "Catégorie mis à jour avec succès");
    }

    public function edit($id)
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        //$variableRecuperee = session('variableEnvoyee');
        // $response = HTTP::withHeaders([
        //     'Authorization' => 'Bearer ' . $variableRecuperee,
        // ])->get('http://'.$ip_adress.'/odsolidwaist/manages-category/find/category/{categoryId}' . $id);
    
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::get('http://'.$ip_adress.'/odsolidwaist/manages-category/find/category/{categoryId}' . $id);
    
        $categories = $response->json();
        //dd($categories);
        $categorie=$categories['data'];
       // dd($categorie);

        return view('Categorie/edit', compact("categorie"));
    }

    

}
