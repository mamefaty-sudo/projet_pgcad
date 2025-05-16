<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Relations\HasOne;
use Illuminate\Database\Relations\HasMany;
use Illuminate\Database\Relations\BelongsTo;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        
        'nom',
        'prenom',
        'email',
        'matricule',
        'statut',
        'role',
        'email',
        'password',
        'departement_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     /**
     * Vérifier si l'utilisateur est un administrateur
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

     /**
     * Vérifier si l'utilisateur est un chef de département
     *
     * @return bool
     */
    public function isChefDeDepartement()
    {
        return $this->role === 'chef_departement';
    }

       /**
     * Vérifier si l'utilisateur est un chef de filière
     *
     * @return bool
     */
    public function isChefDeFilliere()
    {
        return $this->role === 'chef_filliere';
    }

     /**
     * Vérifier si l'utilisateur est un assistant
     *
     * @return bool
     */
    public function isAssistant()
    {
        return $this->role === 'assistant';
    }

     /**
     * Relation avec le modèle ChefDeDepartement
     */
    public function chefDepartement()
    {
        return $this->hasOne(ChefDeDepartement::class, 'user_id');
    }

      /**
     * Relation avec le modèle ChefDeFilliere
     */
    public function chefsFillieres()
    {
        return $this->hasMany(ChefDeFilliere::class, 'user_id');
    }

    /**
     * Relation avec le modèle Assistant
     */
    public function assistantDepartement()
    {
        return $this->hasOne(Assistant::class, 'user_id');
    }

    /**
     * Relation avec le département auquel l'utilisateur appartient
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * Scope pour filtrer les utilisateurs par rôle
     */
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }


}
