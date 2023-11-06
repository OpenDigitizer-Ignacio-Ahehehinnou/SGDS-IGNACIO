<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class superAdminController extends Controller
{
    //

    public function index()
    {
        $ip_adress = env('APP_IP_ADRESS');


         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');
                //dd($entreprise);
        $response = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://".$ip_adress."/odsolidwaist/manages-users/users/active-enabled-role-and-enterprise?isEnabled=true&roleId=12&enterpriseId=20");


         //$response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-users/users/active-enabled-role-and-enterprise?isEnabled=true&roleId=12&enterpriseId=20");

        $superAdmins = $response->json();
        $superAdmin1 = $superAdmins['data']['content'];


        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 10;
        $superAdmin = new LengthAwarePaginator(
            array_slice($superAdmin1, ($currentPage - 1) * $perPage, $perPage),
            count($superAdmin1),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );
            //dd($superAdmin);
        return view('superAdmin/index',compact("superAdmin"));
    }

    public function create()
    {
        $ip_adress = env('APP_IP_ADRESS');


         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');
         $entreprise = session('entreprise');
         $role = session('role');

            //dd($entreprise);
         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/active");

        
          $entreprisess = $response->json();
         // dd($entreprisess);
          $entreprises=$entreprisess['data']['content'];

         //dd($entreprises);
         

        //ajouter un admin
        return view('SuperAdmin/create',compact('entreprises','entreprise','role'));
    }

    //Le store du create

    public function store(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');
        //dd($request['matricule']);

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
            $prefix = 'SGDS_SuperAdmin_';

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
        $test['entrepriseId'] = $donnees['entrepriseId'];
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

            //  //dd($entreprise);
            $response = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->POST("http://".$ip_adress."/odsolidwaist/manages-users/create", $test);
        
            $administrateurss = $response->json();
            $administrateurs = $administrateurss['data'];
            //dd($administrateurs);
        //return  back()->with("success", "Administrateur ajouté avec succè!")->with(compact("administrateurs"));
        return redirect()->route('superAdmin')->with("success", "SuperAdmin ajouté avec succès")->with(compact("administrateurs"));
        

    }



    public function update(Request $request, $id)
    {
        $ip_adress = env('APP_IP_ADRESS');

           // dump(10);

        $request->validate([
            "firstName" => "required",
            "lastName" => "required",
            "matricule" => "required",
            "telephone" => "required|numeric",
            "username" => "required",
            "adress" => "required",
        ]);
           // dd($request);
        $test = array();
        $test['userId'] = $request['userId'];
        $test['firstName'] = $request['firstName'];
        $test['lastName'] = $request['lastName'];
        $test['matricule'] = $request['matricule'];
        $test['telephone'] = $request['telephone'];
        $test['photoProfil'] = $request['photoProfil'];
        $test['adress'] = $request['adress'];
        $test['username'] = $request['username'];
        $test['email'] = $request['email'];
        $test['entrepriseId'] = $request['entrepriseId'];
        $test['roleId'] = $request['roleId'];
        $test['isEnabled'] = true;
        $test['isAccountNonExpired'] = true;
        $test['isAccountNonLocked'] = true;
        $test['isCredentialsNonExpired'] = true;
        $test['updatedAt'] = $request['updatedAt'];
        $test['userIdForLog'] = $request['userIdForLog'];
        $test['createdAt'] = $request['createdAt'];
        $test['deletedFlag'] = $request['deletedFlag'];
        $test['updatedBy'] = $request['updatedBy'];
        $test['verificationCodeExpiredAt'] = $request['verificationCodeExpiredAt'];
        $test['verificationCode'] = $request['verificationCode'];
        $test['deletedAt'] = $request['deletedAt'];
        $test['createdBy'] = $request['createdBy'];
        $test['deletedBy'] = $request['deletedBy'];

        //dd($test);

        $dataToUpdate = $test;


        $variableRecuperee = session('variableEnvoyee');



        $response1 = Http::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://' . $ip_adress . '/odsolidwaist/manages-users/usernameVerification/forUpdate', [
            'userId' => $test['userId'],
            'username' => $test['username']
            // 'matricule' => $test['matricule']
        ]);
        //dd($response1->json());
        //les trois ensemble avec userId
        $response2 = Http::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://' . $ip_adress . '/odsolidwaist/manages-users/userUniqueVerification/forUpdate', [
            'userId' => $test['userId'],
            'username' => $test['username'],
            'matricule' => $test['matricule'],
            'email' => $test['email']

        ]);
        $username= $response1->json();
        $userNames=$username['data'];
        //dd($emails);
        if($userNames['isUsernameExist'] == true){

            return redirect()->back()->with('success', 'Le nom d\'utilisateur existe déjà.');

        }

        $lesTrois= $response2->json();
        //dd($lesTrois);
        $les3=$lesTrois['data'];
        if($les3['isUsernameExist'] == true){

            return redirect()->back()->with('success', 'Le nom d\'utilisateur existe déjà.');

        }
        if($les3['isEmailExist'] == true){

            return redirect()->back()->with('success', 'Le mail existe déjà.');

        }
        if($les3['isMatriculeExist'] == true){

            return redirect()->back()->with('success', 'Le matricule existe déjà.');

        }


        // // Créez une instance du client GuzzleHttp
        $client = new Client();

        $response = $client->put("http://" . $ip_adress . "/odsolidwaist/manages-users/update", [
            'headers' => [
                'Authorization' => 'Bearer ' . $variableRecuperee,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $dataToUpdate,
        ]);
        // $variableRecuperee = session('variableEnvoyee');

        // $response = HTTP::put("http://" . $ip_adress . "/odsolidwaist/manages-users/update", $test);
    
            //dd($response);
        return redirect()->route('superAdmin')->with("success", "SuperAdmin mis à jour avec succès");


    }
    public function edit($id)
    {
        //dd($id);
        $ip_adress = env('APP_IP_ADRESS');

        //ajouter un admin

           // Récupérer la variable de la session
            $variableRecuperee = session('variableEnvoyee');
            $response = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get("http://".$ip_adress."/odsolidwaist/manages-users/find/" . $id);
            //$response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-users/find/" . $id);
            //Liste des entreprises active
            $response2 = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/find/entreprise/active');
        
         //$response2 = HTTP::get('http://'.$ip_adress.'/odsolidwaist/manages-entreprise/find/entreprise/active');
        
        $administrateurs = $response->json();
        $entreprisess = $response2->json();
        $entreprises = $entreprisess['data']['content'];

        $superAdmin=$administrateurs['data'];
        //dd($superAdmin);
        //l'id de l'entreprise de l'admin
        $entrepriseId=$superAdmin['entrepriseId'];

            //je veux recuperer l'entreprise de la liste grace a son id
        $targetEntreprise = null;
        foreach ($entreprises as $entreprise) {
            if ($entreprise['entrepriseId'] === $entrepriseId) {
                $targetEntreprise = $entreprise;
                break;
            }

        }
        //dd($targetEntreprise);


        return view('SuperAdmin/edit', compact("superAdmin","targetEntreprise"));
    }


    public function delete(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

       $id = $request->id;
        //dd($id);
        //$id=50;
        try{
        $variableRecuperee = session('variableEnvoyee');

        $url = "http://".$ip_adress."/odsolidwaist/manages-users/delete/user/" .$id;

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->put($url);
        return new Response(200);
        } catch (Exception $e) {
                    //dd(0);
                    //return new Response(500);
        }
            // return back()->with("successDelete", "L'administrateur a été supprimé avec succès");

    }


}
