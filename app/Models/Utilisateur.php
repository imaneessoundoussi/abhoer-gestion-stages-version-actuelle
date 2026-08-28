<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    /**
     * Nom de la table.
     */
    protected $table = 'utilisateur';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idUtilisateur';

    /**
     * La table n'utilise pas created_at / updated_at.
     */
    public $timestamps = false;

    /**
     * Champs autorisés.
     */
    protected $fillable = [
        'nom',
        'prenom',
        'login',
        'motDePasse',
        'role',
        'actif',
        'idCandidat',
    ];

    /**
     * Champs cachés.
     */
    protected $hidden = [
        'motDePasse',
    ];

    /**
     * Mot de passe utilisé par Laravel pour l'authentification.
     */
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    /**
     * Candidat associé à l'utilisateur.
     */
    public function candidat(): BelongsTo
    {
        return $this->belongsTo(
            Candidat::class,
            'idCandidat',
            'idCandidat'
        );
    }
}