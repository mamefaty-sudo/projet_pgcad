<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

class ChefDeFilliere extends Personne
{
    /** @use HasFactory<\Database\Factories\ChefDeFilliereFactory> */
    use HasFactory;

    protected $fillable = ['nom_filliere'];
}
