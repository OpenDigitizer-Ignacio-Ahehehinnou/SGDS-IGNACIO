<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PointController extends Controller
{
    //

    public function index(){

         // Récupérer la variable de la session
         $variableRecuperee = session('variableEnvoyee');

         $response = HTTP::withHeaders([
             'Authorization' => 'Bearer ' . $variableRecuperee,
         ])->get('http://192.168.8.106:8080/api/v1/points-management/show/point');
 
         $points = $response->json();
        //dd($points);

        return view('Point.index', compact('points'));
    }

    public function create()
    {
        //ajouter un admin

        return view('Point.create');
    }

    public function store(){

        return view('Point.index');
    }
}
