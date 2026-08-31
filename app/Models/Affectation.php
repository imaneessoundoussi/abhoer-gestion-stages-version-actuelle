<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Affectation extends Model
{
    /**
     * Nom de la table.
     */
    protected $table = 'affectation';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idAffectation';

    /**
     * Pas de timestamps.
     */
    public $timestamps = false;

    /**
     * Champs autorisés.
     */
    protected $fillable = [
        'idDemande',
        'idService',
        'dateAffectation',
        'dateDebut',
        'dateFin',
        'observation',
    ];

    /**
     * Conversion des dates.
     */
    protected $casts = [
        'dateAffectation' => 'date',
        'dateDebut' => 'date',
        'dateFin' => 'date',
    ];

    /**
     * Une affectation appartient à une demande.
     */
    public function demande(): BelongsTo
    {
        return $this->belongsTo(
            DemandeStage::class,
            'idDemande',
            'idDemande'
        );
    }

    /**
     * Une affectation appartient à un service.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(
            Service::class,
            'idService',
            'idService'
        );
    }
}