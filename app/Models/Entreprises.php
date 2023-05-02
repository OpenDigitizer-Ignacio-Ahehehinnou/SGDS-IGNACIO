<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprises extends Model
{
    use HasFactory;
    protected $fillable= ["nom", "adresse", "email","ifu","nom_responsable","telephone","siege"];

}
