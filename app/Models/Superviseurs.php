<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Superviseurs extends Model
{
    use HasFactory;
    protected $fillable= ["nom", "prenom", "email","date_naissance","adresse","telephone"];

}
