<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;


use function Pest\Laravel\json;

class AdministrateurController extends Controller
{

    public function index()
    {
        //créer un admin

        $administrateur1 = HTTP::get('http://192.168.100.14:8080/api/v1/user-management/show/user');
        $administrateurs = $administrateur1->json();
             //dd($administrateurs);
        return view('Admin/index', compact("administrateurs"));
    }


    public function show($id)
    {
        
        $administrateur1 = HTTP::get('http://192.168.100.14:8080/api/v1/user-management/show/user/{userId}' . $id);
        $administrateurs = $administrateur1->json();
            //dd($administrateurs);
        return view('Admin/voir', compact('administrateurs'));
    }


    public function create()
    {
        //ajouter un admin
        return view('Admin/create');
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

        return  back()->with("success", "Administrateur ajouté avec succè!");
        //return redirect('/admin');

    }

    public function delete($id)
    {

        $administrateur1 = HTTP::get('http://192.168.100.14:8080/api/v1/user-management/show/user/{userId}' . $id);
        $administrateurs = $administrateur1->json();

        $nom_complet = $administrateurs['firstName'] . " " . $administrateurs['lastName'];

        return back()->with("successDelete", "L'administrateur '$nom_complet' a été supprimé avec succè!");

        // return view('Admin/create',compact("classes"));
    }

    public function update(Request $request, $id)
    {

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

        
        $response = HTTP::withBody(json_encode($test))->put('http://192.168.100.14:8080/api/v1/user-management/update/user/{$id}' . $id);
       
        return back()->with("success", "Administrateur mis à jour avec succès!");

        
    }
    public function edit($id)
    {
        //ajouter un admin
        $administrateur1 = HTTP::get('http://192.168.100.14:8080/api/v1/user-management/show/user/{userId}' . $id);
        $administrateur = $administrateur1->json();

        return view('Admin/edit', compact("administrateur"));
    }
}
