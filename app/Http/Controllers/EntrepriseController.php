<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entreprises;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    
    public $view_administrateur_nom, $view_student_prenom, $view_student_telephone;

    public function index()
    {
         
         $entreprise1 = HTTP::get('http://192.168.100.14:8080/api/v1/entreprise-management/show/entreprise');
         $entreprises = $entreprise1->json();
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
        //ajouter un admin

        

        return view('Entreprise/create');
    }

    //Le store du create

    public function store(Request $request)
    {
        //ajouter un admin
        $request->validate([
            "nom"=>"required",
            "adresse"=>"required",
            "nom_responsable"=>"required",
            "email"=>"required",
            "ifu"=>"required",
            "telephone"=>"required",
            "siege"=>"required",
        ]);
    
            Entreprises::create($request->all());

            return back()->with("success", "Entreprise ajouté avec succè!");

       // return view('Admin/create',compact("classes"));
    }

    public function delete(Entreprises $entreprise)
    {
        $nom_complet=$entreprise->nom ;

        $entreprise->delete();

            return back()->with("successDelete", "L'entreprise '$nom_complet' a été supprimé avec succè!");

       // return view('Admin/create',compact("classes"));
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

        
        $response = HTTP::withBody(json_encode($test))->put('http://192.168.100.14:8080/api/v1/entreprise-management/update/entreprise/{id}' . $id);
       
        
            return back()->with("success", "Entreprise mis à jour avec succè!");

       // return view('Admin/create',compact("classes"));
    }
    public function edit($id)
    {
        //ajouter un admin
       
        $entreprise1 = HTTP::get('http://192.168.100.14:8080/api/v1/entreprise-management/show/entreprise/{entrepriseId}' . $id);
        $entreprise = $entreprise1->json();

        return view('Entreprise/edit',compact("entreprise"));
    }
}
