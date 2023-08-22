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
        ])->get('http://192.168.8.106:8080/api/v1/entreprise-management/show/entreprise');

         $entreprises = $response->json();
        //dd($entreprises);

        return view('Entreprise/index',compact("entreprises"));
        
    }
    

    public function detail(Request $request, Entreprises $entreprise,$id)
    {
       // ajouter un admin
        $request->validate([
            "name"=>"required",
            "prenom"=>"required",
            "email"=>"required",
            "date_naissance"=>"required",
            "adresse"=>"required",
            "telephone"=>"required",
            "role"=>"required",
        ]);


            $entreprises=Entreprises::find($id);

        $entreprise->update([
            "name"=>$request->nom,
            "prenom"=>$request->prenom ,
            "date_naissance"=>$request->date_naissance,

            "email"=>$request->email,
            "adresse"=>$request->adresse,
            "telephone"=>$request->telephone,

        ]);
        //     return back()->with("success", "Administrateur mis à jour avec succè!");

        return view('Admin/voir',compact('administrateur'));
    }


    public function create()
    {
        return view('Entreprise/create');
    }

    //Le store du create

    public function store(Request $request)
    {
        

         //ajouter un admin
         $test = array();
        //$test['id'] = $id;
         $test['name'] = $request['name'];
         $test['adress'] = $request['adress'];
         $test['nom_responsable'] = $request['nom_responsable'];
         $test['email'] = $request['email'];
         $test['ifu'] = $request['ifu'];
         $test['telephone'] = $request['telephone'];
         $test['siege'] = $request['siege'];
         $test['creatorUsername'] = $request['creatorUsername'];
         $test['creatorId'] = $request['creatorId'];
         $test['createdAt'] = $request['createdAt'];
         $test['deletedFlag'] = $request['deletedFlag'];
    
          
       // dump($test);

        
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://192.168.8.106:8080/api/v1/entreprise-management/create/entreprises',$test);
        
        $entreprises = $response->json();
       // dd($entreprises);
            return back()->with("success", "Entreprise ajoutée avec succès");

       // return view('Admin/create',compact("classes"));
    }

    public function delete($id)
    {
        $variableRecuperee = session('variableEnvoyee');
    
        $url = 'http://192.168.8.106:8080/api/v1/entreprise-management/delete/entreprises/' . $id;
    
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);
    
        if ($response->successful()) {
            return back()->with("successDelete", "L'entreprise a été supprimée avec succès");
        } else {
            return back()->with("errorDelete", "Une erreur s'est produite lors de la suppression de l'entreprise");
        }
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


        $response = $client->put("http://192.168.8.106:8080/api/v1/entreprise-management/update/entreprise/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);

        
        //$response = HTTP::withBody(json_encode($test))->put('http://192.168.100.14:8080/api/v1/entreprise-management/update/entreprise/{id}' . $id);
       
        
            return back()->with("success", "Entreprise mis à jour avec succè!");

       // return view('Admin/create',compact("classes"));
    }
    public function edit($id)
    {
        
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.106:8080/api/v1/entreprise-management/show/entreprise/{entrepriseId}' . $id);

        $entreprise = $response->json();

        return view('Entreprise/edit',compact("entreprise"));
    }
}
