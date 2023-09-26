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
        ])->get('http://192.168.1.5:8080/api/v1/reporting-management/show/reporting');

        $signalements = $response->json();
      //dd($signalements);
        return view('Signalement/index', compact("signalements"));
    }

    public function detail($reportingId)
    {


        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.1.5:8080/api/v1/reporting-management/show/reportings/{id}' . $reportingId);

        $signalements = $response->json();
        // dd($signalements);

        return view('Signalement/detail', compact("signalements"));
    }

    public function delete(Request $request)
    {

        $donnees = $request->documentId;
            //dd($donnees);

        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://192.168.1.5:8080/api/v1/reporting-management/delete/reportings/' . $donnees;
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);

        return back()->with("successDelete", "Signalement supprimé avec succès");

    }


}
