<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SignalementController extends Controller
{

    public function index()
    {
        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.1.6:8080/api/v1/reporting-management/show/reporting');

        $signalements = $response->json();
        //dd($signalements);
        $statusList = [];

        foreach ($signalements as $item) {
            if (isset($item['status'])) {
                $statusList[] = $item['status'];
            }
        }

           // dd($statusList);
        // Comptez le nombre d'occurrences de chaque statut
        $counts = array_count_values($statusList);
        $signaledCount = $counts["signaled"];
        $affectedCount = $counts["affected"]; // Pour obtenir le nombre de statuts "affected"
        $validatedCount = $counts["validated"];
        $signalementCount = count($statusList);

        // Filtrer les signalements par statut
        $signalementsAffected = array_filter($signalements, function ($signalement) {
            return $signalement['status'] === 'affected';
        });

        $signalementsValidated = array_filter($signalements, function ($signalement) {
            return $signalement['status'] === 'validated';
        });

        $signalementsSignaled = array_filter($signalements, function ($signalement) {
            return $signalement['status'] === 'signaled';
        });
       // dd($signalementsAffected);


        //dd($affectedStatusList);
        return view('Signalement/index', compact("signalements","signalementCount","signaledCount","affectedCount","validatedCount","signalementsAffected","signalementsValidated","signalementsSignaled"));
    }

    public function detail($reportingId)
    {


        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get('http://192.168.1.6:8080/api/v1/reporting-management/show/reportings/{id}' . $reportingId);

        $signalements = $response->json();
        // dd($signalements);

        return view('Signalement/detail', compact("signalements"));
    }

    public function delete(Request $request)
    {

        $donnees = $request->documentId;
            //dd($donnees);

        $variableRecuperee = session('variableEnvoyee');

        $url = 'http://192.168.1.6:8080/api/v1/reporting-management/delete/reportings/' . $donnees;
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->delete($url);

        return back()->with("successDelete", "Signalement supprimé avec succès");

    }


}
