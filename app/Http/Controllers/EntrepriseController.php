<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entreprises;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class EntrepriseController extends Controller
{

    public $view_administrateur_nom, $view_student_prenom, $view_student_telephone;

    public function index()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/find/entreprise/active');
       // $response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/active");

        $entreprisess = $response->json();
        //dd($entreprisess);
        $entreprises=$entreprisess['data']['content'];
    
        return view('Entreprise/index',compact("entreprises"));

    }


    public function ListeSupprimer()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/find/entreprise/deleted');
       // $response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/deleted");

        $entreprisess = $response->json();
        //dd($entreprisess);
        $entreprises=$entreprisess['data']['content'];
    
        return view('Entreprise/EntrepriseSupprimer',compact("entreprises"));

    }



    public function detail(Request $request,$id)
    {

        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $entreprise = session('entreprise');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/{$id}");
       // $response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/{$id}");

        $entreprisess = $response->json();
        $entreprises=$entreprisess['data'];
       // dd($entreprises);
       
        return view('entreprise/voir',compact('entreprises','entreprise'));
    }


    public function create()
    {

    
        return view('Entreprise/create');
    }

    //Le store du create

    public function store(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $request->validate([
            "name"=>"required",
            "ifu"=>"required",
            "email"=>"required",
            "code"=>"required",
            "address"=>"required",
            "telephone"=>"required",
        ]);

        
         //ajouter un admin
        $test = array();
        //$test['id'] = $id;
        $test['name'] = $request['name'];
        $test['address'] = $request['address'];
        $test['manager'] = $request['manager'];
        $test['email'] = $request['email'];
        $test['ifu'] = $request['ifu'];
        $test['telephone'] = $request['telephone'];
        $test['code'] = $request['code'];
        $test['userIdForLog'] = $request['userIdForLog'];
        $test['updatedAt'] = $request['updatedAt'];
        $test['updatedBy'] = $request['updatedBy'];
        $test['createdBy'] = $request['createdBy'];
        $test['isParentCompany'] = $request['isParentCompany'];
        $test['deletedFlag'] = $request['deletedFlag'];

        //dd($test);

       // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response2 = Http::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://' . $ip_adress . '/odsolidwaist/manages-users/emailVerification/forCreation', [
           // 'userId' => $test['userId'],
            'email' => $test['email']
            // 'matricule' => $test['matricule']
        ]);

        $emails= $response2->json();
        $email=$emails['data'];
        //dd($emails);
        if($email['isEmailExist'] == true){

            return redirect()->back()->with('success', 'Cet adresse mail pour entreprise existe déjà.');

        }


        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/create/entreprise',$test);

        // $variableRecuperee = session('variableEnvoyee');
        // $response = HTTP::post('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/create/entreprise',$test);
        
        $entreprisess = $response->json();

        if($entreprisess['code']=== 200){
        $entreprises=$entreprisess['data'];
        


        // Enregistrer le manager

        
        $request->validate([
            "firstName" => "required",
            "lastName" => "required",
            "telephone" => "required|numeric",
            "username" => "required",
            "adress" => "required",
            "password" => "required|min:8",
            "email" => "required"
        ]);

         // Obtenez la date actuelle sous forme de chaîne au format ISO 8601 avec une précision de millisecondes.
        $createdAt = Carbon::now()->toIso8601String();
        //dd($createdAt);
        //Générer matricule
            // Vous pouvez personnaliser le préfixe selon vos besoins
            $prefix = 'SGDS_AdminManager_';

            $nombreAleatoire = rand(0, 1000); // Utilisation de rand()

            // Formatage du nouveau matricule avec la partie numérique
            $newMatricule = $prefix . $nombreAleatoire;
        //Fin matricule
        //ajouter un admin
        $donnees = $request->all();

        //dd($donnees);
        $test = array();
        //$test['id'] = $id;
       // $test['userId'] = 105;
        $test['firstName'] = $donnees['firstName'];
        $test['lastName'] = $donnees['lastName'];
        if($request['matricule']  === null){
            $test['matricule'] = $newMatricule;
        }else{
            $test['matricule'] = $donnees['matricule'];

        }
        $test['telephone'] = $donnees['telephone'];
        $test['photoProfil'] = $donnees['photoProfil'];

        $test['adress'] = $donnees['adress'];
        $test['username'] = $donnees['username'];
        $test['password'] = $donnees['password'];
        $test['password_confirm'] = $donnees['password_confirm'];

        $test['email'] = $donnees['email'];
        $test['entrepriseId'] = $entreprises['entrepriseId'];
        $test['roleId'] = $donnees['roleId'];
        $test['isEnabled'] = true;
        $test['isAccountNonExpired'] = true;
        $test['isAccountNonLocked'] = true;
        $test['isCredentialsNonExpired'] = true;
        $test['creatorUsername'] = $donnees['creatorUsername'];
        $test['creatorId'] = $donnees['creatorId'];
        $test['createdAt'] = $createdAt;
        $test['roleId'] = $donnees['roleId'];
        $test['deletedFlag'] = $donnees['deletedFlag'];
        //dd($test);
        if ($donnees['password_confirm'] != $donnees['password']) {
            return redirect()->back()->withInput($donnees)->with('success', 'Les mots de passe ne correspondent pas.');
        }

             $variableRecuperee = session('variableEnvoyee');

             $response1 = Http::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->post('http://' . $ip_adress . '/odsolidwaist/manages-users/userUniqueVerification/forCreation', [
                'email' => $test['email'],
                'username' => $test['username'],
                'matricule' => $test['matricule']
            ]);
            $email= $response1->json();
           // dd($email);

            $emails=$email['data'];
            //dd($emails);
            if($emails['isUsernameExist'] == true){

                return redirect()->back()->withInput($donnees)->with('success', 'Le nom d\'utilisateur existe déjà.');

            }
            if($emails['isEmailExist'] == true){

                return redirect()->back()->withInput($donnees)->with('success', 'Le mail existe déjà.');

            }
            if($emails['isMatriculeExist'] == true){

                return redirect()->back()->withInput($donnees)->with('success', 'Le matricule existe déjà.');

            }

            $response = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->POST('http://'.$ip_adress.'/odsolidwaist/manages-users/create', $test);
        
            
            // $variableRecuperee = session('variableEnvoyee');
            // $response = HTTP::POST('http://'.$ip_adress.'/odsolidwaist/manages-users/create', $test);
        
            $administrateurss = $response->json();
            $administrateurs = $administrateurss['data'];










        return redirect()->route('entreprise')->with("success", "Entreprise ajouté avec succès")->with(compact("entreprises"));;
        }else{
            //dd(10);
            return redirect()->route('entreprise')->with("success", "Echec lors del'\ajout d'\entreprise");;

        }
       // return view('Admin/create',compact("classes"));
    }

    public function delete(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $donnees = $request->documentId;
            //dd($donnees);

        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/delete/entreprise/' . $donnees);
    
        return back()->with("successDelete", "Entreprise a été supprimé avec succès");

    }

    public function update(Request $request, $id)
    {
        $ip_adress= env('APP_IP_ADRESS');

        //ajouter un admin
        $request->validate([
            "name"=>"required",
            "ifu"=>"required",
            "email"=>"required",
            "code"=>"required",
            "address"=>"required",
            "telephone"=>"required",
        ]);

        $test = array();
        //$test['id'] = $id;
        $test['entrepriseId'] = $request['entrepriseId'];

        $test['name'] = $request['name'];
        $test['address'] = $request['address'];
        $test['manager'] = $request['manager'];

        $test['telephone'] = $request['telephone'];
        $test['ifu'] = $request['ifu'];
        $test['email'] = $request['email'];
        $test['entrepriseId'] = $request['entrepriseId'];
        $test['isParentCompany'] = false;
        $test['code'] = $request['code'];
        $test['createdBy'] = $request['createdBy'];
        $test['deletedFlag'] = $request['deletedFlag'];
        $test['updatedBy'] = $request['updatedBy'];
        $test['updatedAt'] = $request['updatedAt'];
        $test['userIdForLog'] = $request['userIdForLog'];


        //dd($test);
        $dataToUpdate = $test;
        //dd($dataToUpdate);
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        // Créez une instance du client GuzzleHttp
        $client = new Client();


        $response = $client->put("http://" .$ip_adress."/odsolidwaist/manages-entreprise/update/entreprise", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);


        //$response = HTTP::withBody(json_encode($test))->put('http://192.168.100.14:8080/api/v1/entreprise-management/update/entreprise/{id}' . $id);


        return redirect()->route('admin')->with("success", "Entreprise mis à jour avec succès");

       // return view('Admin/create',compact("classes"));
    }

    public function edit($id)
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/find/entreprise/{entrepriseId}' . $id);

        $entreprises = $response->json();
        $entreprise=$entreprises['data'];


        return view('Entreprise/edit',compact("entreprise"));
    }
}