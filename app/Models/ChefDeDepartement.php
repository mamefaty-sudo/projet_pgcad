<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

class ChefDeDepartement extends Personne
{
    /** @use HasFactory<\Database\Factories\ChefDeDepartementFactory> */
    use HasFactory;

    protected $fillable = ['nom_dept'];
}
