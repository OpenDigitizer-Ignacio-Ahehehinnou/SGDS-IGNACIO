<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    //
    public function index()
    {
        



        return view('Accueil/index');
    }


    public function profil()
    {
        



        return view('Accueil/profil');
    }

}
