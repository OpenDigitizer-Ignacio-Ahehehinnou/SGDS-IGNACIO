<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class superAdminController extends Controller
{
    //

    public function index()
    {

         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');

         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.1.6:8080/api/v1/users-management/show/user');

         $superAdmin = $response->json();

            //dd($collecteurs);
        return view('superAdmin/index',compact("superAdmin"));
    }

}
