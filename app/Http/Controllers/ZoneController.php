<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index(){

        return view('Zone.index');
    }

    public function create()
    {
        //ajouter un admin

        return view('Zone.create');
    }

    public function store(){

        return view('Zone.index');
    }
    //
}
