<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SignalementController extends Controller
{

    public function index()
    {
        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        // $response = HTTP::withHeaders([
        //     'Authorization' => 'Bearer ' . $variableRecuperee,
        // ])->get('http://192.168.8.101:8080/api/v1/reporting-management/show/reporting/odsolidwaist/manages-reporting/reports/enterprise-and-status?enterpriseId=1&status=validated&size=10&page=0');
        $variableRecuperee = session('variableEnvoyee');
        $response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=1&status=validated");
    
        $signalements = $response->json();
            //dd($signalements);
        

        return view('Signalement/index', compact("signalements","signalementCount","signaledCount","affectedCount","validatedCount","signalementsAffected","signalementsValidated","signalementsSignaled"));
    }

    public function detail($reportingId)
    {

        $ip_adress = env('APP_IP_ADRESS');

        // Récupérer la variable de la session
        $variableRecuperee = session('variableEnvoyee');

        // $response = HTTP::withHeaders([
        //     'Authorization' => 'Bearer ' . $variableRecuperee,
        // ])->get("http://".$ip_adress."/odsolidwaist/manages-reporting/find/reporting/{reportingId}" . $reportingId);
       $response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-reporting/find/reporting/{reportingId}" . $reportingId);

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


    public function detailSignalement(Request $request,$id)
    {
       //dd($id);
       $ip_adress = env('APP_IP_ADRESS');
       $entreprise = session('entreprise');
       $variableRecuperee = session('variableEnvoyee');

       // dd($ip_adress);
        // Récupérer la variable de la session
        $response = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $id . "&status=validated");

        $response1 = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $id . "&status=signaled");

        $response2 = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $id . "&status=affected");

        $response3 = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $id . "&status=collected");

        $response4 = HTTP::withHeaders([
            'Authorization' => 'Bearer ' . $variableRecuperee,
        ])->get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $id . "&status=rejected");


        //$variableRecuperee = session('variableEnvoyee');
       // $response = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $id . "&status=validated");
       // $response1 = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $id . "&status=signaled");
        //$response2 = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $id . "&status=affected");
       // $response3 = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $id . "&status=collected");
       // $response4 = HTTP::get("http://".$ip_adress."/odsolidwaist/manages-reporting/reports/active-and-enterprise-and-status?enterpriseId=" . $id . "&status=rejected");

       
        $validers = $response->json();
        $valider= $validers['data']['content'];
      // dd($validers);
        $signalers = $response1->json();
        $signaler= $signalers['data']['content'];
       // dd($signalers);
        $affecters = $response2->json();
        $affecter= $affecters['data']['content'];

        $collecters = $response3->json();
        $collecter= $collecters['data']['content'];

        $rejeters = $response4->json();
        $rejeter= $rejeters['data']['content'];

        $validatedCount=count($valider);
        $affectedCount=count($affecter);
        $signaledCount=count($signaler);
        $collecterCount=count($collecter);
        $rejeterCount=count($rejeter);

      //  dd($validatedCount);


        //dd($affecter,$signaler,$valider,$collecter,$rejeter);

        //dd($admins,$superviseurs,$collecteurs);

        return view('Signalement/index',compact('validatedCount','affectedCount','signaledCount','collecterCount','rejeterCount'
                                                        ,'entreprise','valider','signaler','affecter','rejeter','collecter'));
    }



}
