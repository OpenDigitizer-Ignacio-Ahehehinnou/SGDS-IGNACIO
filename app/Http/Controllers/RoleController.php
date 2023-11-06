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

class RoleController extends Controller
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
        ])->get("http://".$ip_adress."/odsolidwaist/manages-role/find/role/active");

       // $response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-role/find/role/active");

        $roless = $response->json(); 
        $roles1=$roless['data']['content'];
       //dd($roles);

       $currentPage = Paginator::resolveCurrentPage() ?: 1;
       $perPage = 10;
       $roles = new LengthAwarePaginator(
           array_slice($roles1, ($currentPage - 1) * $perPage, $perPage),
           count($roles1),
           $perPage,
           $currentPage,
           ['path' => Paginator::resolveCurrentPath()]
       );

        return view('Role.index', compact("roles"));
    }


    public function create()
    {
        //ajouter un admin

        return view('role/create');
    }

    public function store(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $request->validate([
            "label" => "required",
            "code" => "required"
        ]);

        $test = array();
        $test['establishedDate'] = $request['establishedDate'];
        $test['label'] = $request['label'];
        $test['code'] = $request['code'];
        $test['deletedFlag'] = $request['deletedFlag'];
        $test['createdBy'] = $request['createdBy'];
        $test['createdAt'] = $request['createdAt'];
        $test['description'] = $request['description'];

        
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://'.$ip_adress.'/odsolidwaist/manages-role/create/role', $test);
    
    
        $roless = $response->json();

        //dd($communess);

        if($roless['code']=== 200){
        $roles=$roless['data'];

       // dd($roles);
        
        return redirect()->route('rolee')->with("success", "Rôle ajoutée avec succès")->with(compact("roles"));
        }else{
            //dd(10);
            $roles=$roless;
           // dd($roles);
            return redirect()->route('role')->with("success", "Echec lors de l'\ajout du rôle");

        }
   
    }

    public function delete(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $donnees = $request->id;
            //dd($donnees);
        try{
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-role/delete/role/' . $donnees);
    
        return new Response(200);
    } catch (Exception $e) {
                //dd(0);
                //return new Response(500);
    }
   
    }


    public function update(Request $request, $departement)
    {

        $ip_adress = env('APP_IP_ADRESS');

        $request->validate([
            "code" => "required",
            "label" => "required",
        ]);

        $test = array();
        //$test['id'] = $id;
        $test['roleId'] = $request['roleId'];
        $test['label'] = $request['label'];
        $test['description'] = $request['description'];
        $test['code'] = $request['code'];
        $test['isEnabled'] = true;
        $test['deletedFlag'] = $request['deletedFlag'];
        $test['createdBy'] = $request['createdBy'];
        $test['createdAt'] = $request['createdAt'];



        // Créez une instance du client GuzzleHttp
        $client = new Client();
        

        $dataToUpdate = $test;
        // dd($test);

            $variableRecuperee = session('variableEnvoyee');

          // Créez une instance du client GuzzleHttp
            $client = new Client();
            
            $response = $client->put("http://" . $ip_adress. "/odsolidwaist/manages-role/update/role", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $variableRecuperee,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $dataToUpdate,
            ]);
            
    
        //dd($response);

        return redirect()->route('role')->with("success", "Rôle mis à jour avec succès");
    }

    public function edit($id)
    {
        $ip_adress = env('APP_IP_ADRESS');

        //Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-role/find/role/{roleId}' . $id);
    
        $role = $response->json();
        $roles=$role['data'];
        //dd($roles);

        return view('Role/edit', compact("roles"));
    }



}
