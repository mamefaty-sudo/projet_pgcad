<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Semestre extends Model
{
    /** @use HasFactory<\Database\Factories\SemestreFactory> */
    use HasFactory;

    protected $fillable = ['id_semestre', 'nom_semestre', 'annee_academique_id'];

    public function anneeAcademique(): BelongsTo
    {
        return $this->belongsTo(AnneeAcademique::class);
    }

    public function ues(): BelongsToMany {
        return $this->belongsToMany(UE::class, 'semestre_ue');
    }

    public function niveaux(): BelongsToMany {
        return $this->belongsToMany(Niveau::class, 'semestre_niveau');
    }

    

}
