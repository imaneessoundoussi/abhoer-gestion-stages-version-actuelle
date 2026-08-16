<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable
{
    protected $table = 'utilisateur';

    protected $primaryKey = 'idUtilisateur';

    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'login',
        'motDePasse',
        'role',
        'actif',
    ];

    protected $hidden = [
        'motDePasse',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    public function historiques(): HasMany
    {
        return $this->hasMany(
            Historique::class,
            'idUtilisateur',
            'idUtilisateur'
        );
    }
}