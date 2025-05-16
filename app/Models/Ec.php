<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class EC extends Model
{
    /** @use HasFactory<\Database\Factories\EcFactory> */
    use HasFactory;

    protected $table = 'ecs';
    protected $fillable =[
        'codeEC',
        'intitule',
        'statut',
        'nbHeureEC',
        'nbHeureTD',
        'nbTotalHeure',
<<<<<<< HEAD
        'nbHeureSuivi',
        'ue_id',
=======
        'codeUE',
>>>>>>> ce1c117295369c8d598ef6adad1aeb0cd77d0116
    ];

    protected $primaryKey = 'codeEC';
    protected $typeKey = 'string';
    public $incrementing = false;

    public function ue(): BelongsTo {
        return $this->belongsTo(UE::class);
    }
}
