<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Exception;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function username(){


        return view('profile.username');
    }

    public function username2(Request $request)
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérez la valeur du champ "username" depuis le formulaire
        $username = $request->input('username');

        // Créez un tableau associatif avec "username" comme clé
        $data = [
            'username' => $username,
        ];

        // Convertissez le tableau en JSON
        $jsonData = json_encode($data);

        //Effectuez une requête HTTP POST vers l'URL distante en envoyant le JSON
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->send('PUT', "http://".$ip_adress."/odsolidwaist/manages-users/update/generate/code", [
            'body' => $jsonData,
        ]);
        //$response = HTTP::put("http://".$ip_adress."/odsolidwaist/manages-users/update/generate/code" , $jsonData);

            $administrateurs = $response->json();

           //dd($administrateurs);
           if($administrateurs['code']== 201){
            return redirect()->back()->with('error_msg', 'Veuillez entrer un nom d\'utilisateur correct');

           }
           $generationStatus = $administrateurs['data']['verificationCode'];
           //dd($generationStatus);
           $generationCode = $administrateurs['code'];

           //dd($generationCode);
          if ($generationStatus == true) {
            return redirect()->route('code', ['username' => $username]);
           // return redirect()->route('code', ['username' => $username,'generationCode'=>$generationCode]);

        }

            else {
                return redirect()->back()->with('error_msg', 'Erreur lors de la génération du code.');
            }

    }


    public function code($username){

        return view('profile.code',['username' => $username]);
    }

    public function code2(Request $request){
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérez la valeur du champ "code" depuis le formulaire
        $code1 = $request->input('code1');
        $code2 = $request->input('code2');
        $code3 = $request->input('code3');
        $code4 = $request->input('code4');
        $code5 = $request->input('code5');
        $code6 = $request->input('code6');
        $username = $request->input('username');

        // Concaténez les valeurs pour former un nombre
        $codeComplet = $code1 . $code2 . $code3 . $code4 . $code5 . $code6;

        // Convertissez la chaîne résultante en un nombre entier si nécessaire
        $codeNombre = intval($codeComplet);

        //dd($codeNombre);
         // Créez un tableau associatif avec "username" comme clé
         $data = [
            'username' => $username,
            'verificationCode'=>$codeNombre,
        ];


       // Convertissez le tableau en JSON
       $jsonData = json_encode($data);
       //dd($jsonData);
       // Effectuez une requête HTTP POST vers l'URL distante en envoyant le JSON
       $response = Http::withHeaders([
           'Content-Type' => 'application/json',
       ])->send('POST', "http://".$ip_adress."/odsolidwaist/manages-users/codeVerification", [
           'body' => $jsonData,
       ]);
           $administrateurs = $response->json();

          // return redirect()->back()->with('error_msg', 'Code expiré veuillez regénérer un autre.');

          //dd($administrateurs);
          if($administrateurs== null){

          }
          $verificationStatus = $administrateurs['data']['isValideCode'];
         // dd($verificationStatus);
         if ($verificationStatus == true) {
           return redirect()->route('newPass',['username' => $username]);
       }

            else {
                return redirect()->back()->with('error_msg', 'Le code saisi n\'est pas correct, veuillez réessayer.');
           }

    }

    public function newPass($username){

        return view('profile.newPass',['username' => $username]);
    }


    public function newPass2(Request $request){
        //dd($request);
        $ip_adress = env('APP_IP_ADRESS');

        $username = $request['username'];
        $passwordNew = $request['new_password'];

            // j'ai changer ce endpoint
        try {
            $url = "http://".$ip_adress."/odsolidwaist/manages-users/recovery/password" .$username;

            $response = Http::put($url, ['password' => $passwordNew]);

            $admin = $response->json();
             //dd($admin);

            return new Response(200);
        } catch (Exception $e) {
                //dd(0);
                return new Response(500);
        }

        return view('profile.newPass');
    }

}
