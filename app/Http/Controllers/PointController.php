<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PointController extends Controller
{
    //

    public function index(){

        return view('Point.index');
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
