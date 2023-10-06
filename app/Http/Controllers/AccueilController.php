<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Exception;

class AccueilController extends Controller
{
    //
    public function index()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $role = session('role');
        $entreprisez = session('entreprise');
        //dd($role,$entreprisez);

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/api/v1/user-management/show/user');
        //'http://'.$ip_adress.'/
        $administrateurs = $response->json();

        $respons = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/api/v1/entreprise-management/show/entreprise');

        $entreprises = $respons->json();

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/api/v1/reporting-management/show/reporting');

        $signalements = $response->json();

        //dd($entreprises);

        if ($role === "SUPERADMIN") {
            // dd(50);
            $libelles = [];


            foreach ($administrateurs as $administrateur) {
                if (isset($administrateur['roleModel']['libelle'])) {
                    $libelles[] = $administrateur['roleModel']['libelle'];
                    // dd($libelles);
                }
            }

            $countCollector = 0; // Initialisez le compteur à zéro
            $countSupervisor = 0;
            $countAdmin = 0;
            $countSignalement = count($signalements);

            foreach ($libelles as $libelle) {
                if ($libelle === "COLLECTOR") {
                    $countCollector++;
                }
            }

            foreach ($libelles as $libelle) {
                if ($libelle === "SUPERVISOR") {
                    $countSupervisor++;
                }
            }

            foreach ($libelles as $libelle) {
                if ($libelle === "ADMIN") {
                    $countAdmin++;
                }
            }

            //dd($countAdmin);
            return view('Accueil/index', compact('countAdmin', 'countSignalement', 'countCollector', 'countSupervisor'));
        }

        if ($role === "ADMIN") {

            $libelles = [];
            $entreprises = [];

            foreach ($administrateurs as $administrateur) {
                if (isset($administrateur['roleModel']['libelle'])) {
                    $libelles[] = $administrateur['roleModel']['libelle'];
                }

                if (isset($administrateur['entrepriseModel']['name'])) {
                    $entreprises[] = $administrateur['entrepriseModel']['name'];
                }
            }
               // dd($libelles,$entreprises);
            $countCollector = 0;
            $countSupervisor = 0;
            $countAdmin = 0;
            $countSignalement = count($signalements);

            for ($i = 0; $i < count($libelles) && $i < count($entreprises); $i++) {
                $libelle = $libelles[$i];
                $entrepris = $entreprises[$i];

                if ($libelle === "SUPERVISOR" && $entrepris === $entreprisez) {
                    $countSupervisor++;
                }


                if ($libelle === "ADMIN" && $entrepris === $entreprisez) {
                    $countAdmin++;
                }

                if ($libelle === "COLLECTOR" && $entrepris === $entreprisez) {
                    $countCollector++;
                }
            }

            //dd($countAdmin,$countCollector,$countSupervisor);

            return view('Accueil/index', compact('countAdmin', 'countSignalement', 'countCollector', 'countSupervisor'));
        }
        return view('Accueil/index', compact('countAdmin', 'countSignalement', 'countCollector', 'countSupervisor'));
    }


    public function profil(Request $request)
    {
        $role = session('role');
        $nom = session('nom');
        $prenom = session('prenom');
        $entreprise = session('entreprise');
        $matricule = session('matricule');
        $telephone = session('telephone');
        $adresse = session('adresse');

        return view('Accueil/profil', compact('nom', 'prenom', 'adresse', 'role', 'entreprise', 'matricule', 'telephone'));
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
        // Créez un tableau de données à envoyer dans le corps de la requête POST
        $dataToSend = [
            'password' => $password,
            'username' => $username,
        ];

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->post('http://'.$ip_adress.'/api/v1/users-management/decode', $dataToSend);

        $administrateurs = $response->json();
        // dd($administrateurs);


        if ($administrateurs['passwordIsVerified'] == true) {

            try {
                $url = 'http://'.$ip_adress.'/api/v1/users-management/update/user/password/' . $userId;

                $response = HTTP::withHeaders([
                    'Authorization' => 'Bearer ' . $variableRecuperee,
                ])->put($url, ['password' => $passwordNew]);

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
            $url = 'http://'.$ip_adress.'/api/v1/users-management/update/user/password/' . $id;

            $response = HTTP::withHeaders([
                'Authorization' => 'Bearer ' . $variableRecuperee,
            ])->put($url, ['password' => $passwordNew]);

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
}
