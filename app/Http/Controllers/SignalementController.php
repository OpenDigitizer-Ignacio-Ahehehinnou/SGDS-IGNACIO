<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SignalementController extends Controller
{
    //
    public function index()
    {

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.103:8080/api/v1/reporting-management/show/reporting');

        $signalements = $response->json();
      //dd($signalements);
        return view('Signalement/index', compact("signalements"));
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

        
        $response = HTTP::withBody(json_encode($test))->put('http://192.168.8.103:8080/api/v1/user-management/update/user/{$id}' . $id);
       
        return back()->with("success", "Administrateur mis à jour avec succès!");

        
    }
    public function edit($id)
    {
        //ajouter un admin
        $signalement1 = HTTP::get('http://192.168.8.103:8080/api/v1/user-management/show/user/{userId}' . $id);
        $signalement = $signalement1->json();
        
        return view('Admin/edit', compact("administrateur"));
    }


    public function detail($reportingId)
    {


        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.8.103:8080/api/v1/reporting-management/show/reportings/{id}' . $reportingId);

        $signalements = $response->json();
        // dd($signalements);
      
        return view('Signalement/detail', compact("signalements"));
    }

   


}
