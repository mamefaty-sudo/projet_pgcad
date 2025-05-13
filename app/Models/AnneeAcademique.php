<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquant\HasMany;

class AnneeAcademique extends Model
{
    /** @use HasFactory<\Database\Factories\AnneeAcademiqueFactory> */
    use HasFactory;

    protected $table = 'annee_academiques';
    protected $fillable = ['id', 'date_debut', 'date_fin', 'demarrer'];
    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'demarrer' => 'boolean',
    ];

    public function semestres(): HasMany
    {
        return $this->HasMany(Semestre::class);
    }

    



}
