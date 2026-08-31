<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    /**
     * Nom de la table.
     */
    protected $table = 'service';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idService';

    /**
     * Pas de timestamps.
     */
    public $timestamps = false;

    /**
     * Champs autorisés.
     */
    protected $fillable = [
        'nomService',
        'description',
        'idDepartement',
    ];

    /**
     * Un service appartient à un département.
     */
    public function departement(): BelongsTo
    {
        return $this->belongsTo(
            Departement::class,
            'idDepartement',
            'idDepartement'
        );
    }

    /**
     * Utilisateurs affectés à ce service.
     */
    public function utilisateurs(): HasMany
    {
        return $this->hasMany(
            Utilisateur::class,
            'idService',
            'idService'
        );
    }

    /**
     * Demandes concernant ce service.
     */
    public function demandes(): HasMany
    {
        return $this->hasMany(
            DemandeStage::class,
            'idService',
            'idService'
        );
    }
}