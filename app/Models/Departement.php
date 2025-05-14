<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departement extends Model
{
    /** @use HasFactory<\Database\Factories\DepartementFactory> */
    use HasFactory;
    
    protected $fillable = ['nom'];

    public function niveaux(): HasMany
    {
        return $this->hasMany(Niveau::class);
    }
}
