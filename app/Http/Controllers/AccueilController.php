<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Exception;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;


class AccueilController extends Controller
{
    //
    public function index()
    {
        //dd("oui");
        //dd($countEntreprises1);
        $role = session('role');
        $entreprise = session('entreprise');
        //dd($entreprise);

        
        if ($role == 12) {
            $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $entreprise = session('entreprise');
        //dd($role,$entreprisez);

        $response = HTTP::withHeaders([
                 'Authorization' => 'Bearer ' . $variableRecuperee,
             ])->get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/active");
            
             $response1 = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get('http://'.$ip_adress.'/odsolidwaist/manages-neighborhood/find/neighborhood/non_deleted-activate');

            $response2 = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get('http://'.$ip_adress.'/odsolidwaist/manages-district/find/district/non_deleted-activate');
       
            $response3 = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get('http://'.$ip_adress.'/odsolidwaist/manages-district/find/district/non_deleted-disable');
       
        //$response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/active");
        //$response1 = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/deleted");

       // $response2 = HTTP::get('http://'.$ip_adress.'/odsolidwaist/manages-district/find/district/non_deleted-activate');
        //$response3 = HTTP::get('http://'.$ip_adress.'/odsolidwaist/manages-district/find/district/non_deleted-disable');



        $entreprisess = $response->json();
        $entreprisez=$entreprisess['data']['content'];
        $countEntreprisesA=count($entreprisez);

        $quartierss1 = $response1->json();
        $quartier1=$quartierss1['data']['content'];
        $countQuartier=count($quartier1);

        $arrondissementss = $response2->json();
        $arrondissement=$arrondissementss['data']['content'];
        $countArrondissementA=count($arrondissement);

        $arrondissementss1 = $response3->json();
        $arrondissement1=$arrondissementss1['data']['content'];
        $countArrondissementI=count($arrondissement1);
        return view('Accueil/index', compact('countEntreprisesA', 'countQuartier', 'countArrondissementA', 'countArrondissementI','role','entreprise'));

        }
        if ($role == 8 or $role == 7) {

            
            $ip_adress = env('APP_IP_ADRESS');

            // Récupérer la variable de la session
            $variableRecuperee = session('variableEnvoyee');
            $entreprise = session('entreprise');
            //dd($role,$entreprisez);
            $response = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get("http://".$ip_adress."/odsolidwaist/manages-users/users/active-enabled-role-and-enterprise?isEnabled=true&roleId=8&enterpriseId={$entreprise}");
        
            $response1 = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get("http://".$ip_adress."/odsolidwaist/manages-users/users/active-enabled-role-and-enterprise?isEnabled=true&roleId=13&enterpriseId={$entreprise}");
    
            $response2 = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get("http://".$ip_adress."/odsolidwaist/manages-users/users/active-enabled-role-and-enterprise?isEnabled=true&roleId=14&enterpriseId={$entreprise}");
            $response3 = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $entreprise . "&status=signaled");
    
            //$response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-users/users/active-enabled-role-and-enterprise?isEnabled=true&roleId=8&enterpriseId={$entreprise}");
            //$response1 = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-users/users/active-enabled-role-and-enterprise?isEnabled=true&roleId=13&enterpriseId={$entreprise}");
    
           // $response2 = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-users/users/active-enabled-role-and-enterprise?isEnabled=true&roleId=14&enterpriseId={$entreprise}");
            //$response3 = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $entreprise . "&status=signaled");
    
    
    
            $adminss = $response->json();
            $admin=$adminss['data']['content'];
            $countAdmin=count($admin);
    
            $superviseurss = $response1->json();
            $superviseur=$superviseurss['data']['content'];
            $countSuperviseur=count($superviseur);
    
            $collecteurss = $response2->json();
            $collecteur=$collecteurss['data']['content'];
            $countCollecteur=count($collecteur);
    
             $signalerss = $response3->json();
             $signaler=$signalerss['data']['content'];
             $countSignaler=count($signaler);
            return view('Accueil/index', compact('countAdmin', 'countSuperviseur', 'countCollecteur','countSignaler','role','entreprise'));
    


        }

        
        return view('Accueil/index', compact('countEntreprisesA', 'countEntreprisesI', 'countArrondissementA', 'countArrondissementI'));
    }


    public function profil(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');
        $variableRecuperee = session('variableEnvoyee');

        $role = session('role');
        $nom = session('nom');
        $prenom = session('prenom');
        $entreprise = session('entreprise');
        $matricule = session('matricule');
        $telephone = session('telephone');
        $adresse = session('adresse');
        $email = session('email');
        $userId = session('userId');
        $username = session('username');


        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://".$ip_adress."/odsolidwaist/manages-role/find/role/active");

        $response1 = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/active");

        // $response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-role/find/role/active");
        // $response1 = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-entreprise/find/entreprise/active");

        $roless = $response->json(); 
        $roles=$roless['data']['content'];

        $entreprisess = $response1->json(); 
        $entrepris=$entreprisess['data']['content'];


        $entreprisee = null;

        foreach ($entrepris as $r) {
            if ($r['entrepriseId'] == $entreprise) {
                $entreprisee = $r['name'];
                break;
            }
        }

        $roleLabel = null;

        foreach ($roles as $r) {
            if ($r['roleId'] == $role) {
                $roleLabel = $r['label'];
                break;
            }
        }
       // dd($roleLabel);
        //$role=$roleLabel;

        return view('Accueil/profil', compact('nom', 'prenom', 'email','userId','entreprise','adresse', 'roleLabel', 'entreprisee','entreprise', 'matricule', 'telephone','role','username'));
    }


    public function update(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        $donnees = $request->all();
        //dd($donnees);


        $test = array();
        // $test['enterpriseId'] = $request['enterpriseId'];
        $test['current_password'] = $request['current_password'];
        $test['new_password'] = $request['new_password'];
        $test['new_password_confirmation'] = $request['new_password_confirmation'];

        //dd($test);
        $password = $request['current_password'];
        $passwordNew = $request['new_password'];
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $username = session('username');
        $userId = session('userId');
        // Créez un tableau de données à envoyer dans le corps de la requête 
        //dd($userId);
        $dataToSend = [
            'password' => $password,
            'username' => $username,
        ];

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://'.$ip_adress.'/odsolidwaist/manages-users/decode/password', $dataToSend);
        
        //$response = HTTP::post('http://'.$ip_adress.'/odsolidwaist/manages-users/decode/password', $dataToSend);

        $administrateurs = $response->json();
        //dd($administrateurs);


        if ($administrateurs['data']['passwordIsVerified'] == true) {

            try {
                $url = 'http://'.$ip_adress.'/odsolidwaist/manages-users/update/password';

                // $response = HTTP::withHeaders([
                //     'Authorization' => 'Bearer ' . $variableRecuperee,
                // ])->put($url, ['password' => $passwordNew]);
                $response = HTTP::put($url, ['password' => $passwordNew,'userId'=>$userId]);
                
                $admin = $response->json();
                // dd($admin);
                return new Response(200);
            } catch (Exception $e) {
                //dd(0);
                //return new Response(500);
            }
        } else {
            //dd(0);
            return new Response("<div class='alert alert-danger text-center' role='alert'>
            <strong>L'ancien mot de passe n'est pas correcte</strong> veuillez réessayez.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
            </div>");

            //return view('Accueil/modifierUser',compact('nom','prenom','role'));

        }




        return view('Accueil/profil');
    }

    public function modifierUser($userId)
    {
        // dump($userId);
        $user = $userId;
        // dd($user);

        // Passez ensuite cette variable à la vue pour l'affichage.
        return view('Accueil/modifierUser', compact('user'));
    }


    public function userModif(Request $request)
    {

        $ip_adress = env('APP_IP_ADRESS');

        $donnees = $request->all();
        //dd($donnees);


        $test = array();
        // $test['enterpriseId'] = $request['enterpriseId'];
        $test['id'] = $request['id'];
        $test['new_password'] = $request['new_password'];
        $test['new_password_confirmation'] = $request['new_password_confirmation'];

        //dd($test);
        $id = $request['id'];
        $passwordNew = $request['new_password'];
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');


        try {
            $url = 'http://'.$ip_adress.'/odsolidwaist/manages-users/update/password';

            // $response = HTTP::withHeaders([
            //     'Authorization' => 'Bearer ' . $variableRecuperee,
            // ])->put($url, ['password' => $passwordNew]);
                $response = HTTP::put($url, ['password' => $passwordNew,'userId'=>$id]);

            $admin = $response->json();
            // dd($admin);
            //return redirect()->back()->with('success', 'Les mots de passe ne correspondent pas.');

            return new Response(200);
        } catch (Exception $e) {
            //dd(0);
            return new Response(500);
        }

        return view('Accueil/profil');
    }

    public function logout(){

        FacadesSession::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
