<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    //

    public function index(){

        return view('Ville.index');
    }

    public function create()
    {
        //ajouter un admin

        return view('Ville/create');
    }

    public function store(){

        return view('Ville.index');
    }
}
