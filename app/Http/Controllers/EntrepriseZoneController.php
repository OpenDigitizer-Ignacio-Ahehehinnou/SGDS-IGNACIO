<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use GuzzleHttp\Client;


class EntrepriseZoneController extends Controller
{
    //
    public function index()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');
        $entreprise = session('entreprise');
        $role = session('role');

            //dd($entreprise);
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://'.$ip_adress.'/api/v1/entreprises_zones-management/create/entreprise_zone');

        $entrepriseZone = $response->json();
       //dd($entrepriseZone);

        return view('EntrepriseZone/index', compact("entrepriseZone"));
    }
}
