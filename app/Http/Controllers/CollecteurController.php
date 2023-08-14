<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collecteurs;
use Illuminate\Support\Facades\Http;

use App\Models\User;

class CollecteurController extends Controller
{
    
    public function index()
    {
        //créer un superviseur
        $collecteur1 = HTTP::get('http://192.168.100.14:8080/api/v1/user-management/show/user');
         $collecteurs = $collecteur1->json();
        //dd($collecteurs);
    
        return view('Collecteur/index',compact("collecteurs"));
    }
    

    public function detail(Request $request, Collecteurs $collecteur, $id)
    {
       // ajouter un admin
        $request->validate([
            "nom"=>"required",
            "prenom"=>"required",
            "email"=>"required",
            "date_naissance"=>"required",
            "adresse"=>"required",
            "telephone"=>"required",
        ]);


            $collecteurs=Collecteurs::find($id);

        $collecteur->update([
            "nom"=>$request->nom,
            "prenom"=>$request->prenom ,
            "date_naissance"=>$request->date_naissance,

            "email"=>$request->email,
            "adresse"=>$request->adresse,
            "telephone"=>$request->telephone,

        ]);
        //     return back()->with("success", "Administrateur mis à jour avec succè!");

        return view('Collecteur/voir',compact('collecteur'));
    }


    public function create()
    {
      
        return view('Collecteur/create');
    }

    //Le store du create

    public function store(Request $request)
    {
        //ajouter un admin
        $test = array();
        //$test['id'] = $id;
        $test['userId'] = $request['userId'];
        $test['firstName'] = $request['firstName'];
        $test['lastName'] = $request['lastName'];
        $test['matricule'] = $request['matricule'];
        $test['telephone'] = $request['telephone'];
        $test['adress'] = $request['adress'];
        $test['username'] = $request['username'];
        $test['password'] = $request['password'];
        $test['activationStatus'] = $request['activationStatus'];
        $test['entrepriseId'] = $request['entrepriseId'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['roleId'] = $request['roleId'];
        $test['deletedFlag'] = $request['deletedFlag'];

        //dd($test);
        $response = HTTP::withBody(json_encode($test))->post('http://192.168.100.14:8080/api/v1/user-management/created/user');


            return back()->with("success", "Collecteur ajouté avec succè!");

       // return view('Admin/create',compact("classes"));
    }

    public function delete(User $collecteur)
    {
        $nom_complet=$collecteur->name ." ". $collecteur->prenom;

        $collecteur->delete();

            return back()->with("successDelete", "Le collecteur '$nom_complet' a été supprimé avec succè!");

       // return view('Admin/create',compact("classes"));
    }

    public function update(Request $request, $id)
    {
        //ajouter un admin
        $request->validate([
            "firstName" => "required",
            "lastName" => "required",
            "matricule" => "required",
            "telephone" => "required",
            "roleId" => "required",
            "adress" => "required",
        ]);

        $test = array();
        //$test['id'] = $id;
        $test['userId'] = $request['userId'];
        $test['firstName'] = $request['firstName'];
        $test['lastName'] = $request['lastName'];
        $test['matricule'] = $request['matricule'];
        $test['telephone'] = $request['telephone'];
        $test['adress'] = $request['adress'];
        $test['username'] = $request['username'];
        $test['password'] = $request['password'];
        $test['activationStatus'] = $request['activationStatus'];
        $test['entrepriseId'] = $request['entrepriseId'];
        $test['creatorUsername'] = $request['creatorUsername'];
        $test['creatorId'] = $request['creatorId'];
        $test['createdAt'] = $request['createdAt'];
        $test['roleId'] = $request['roleId'];
        $test['deletedFlag'] = $request['deletedFlag'];

        //dd($test);
        $response = HTTP::withBody(json_encode($test))->put('http://192.168.100.14:8080/api/v1/user-management/update/user/{$id}' . $id);
    
        return back()->with("success", "Collecteur mis à jour avec succè!");

       // return view('Admin/create',compact("classes"));
    }
    public function edit($id)
    {
        //ajouter un admin

        $collecteur1 = HTTP::get('http://192.168.100.14:8080/api/v1/user-management/show/user/{userId}' . $id);
        $collecteur = $collecteur1->json();

        

        return view('Collecteur/edit',compact("collecteur"));
    }



}
