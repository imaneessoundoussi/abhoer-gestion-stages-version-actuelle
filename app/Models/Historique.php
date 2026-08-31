<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historique extends Model
{
    /**
     * Nom de la table.
     */
    protected $table = 'historique';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idHistorique';

    /**
     * Pas de timestamps.
     */
    public $timestamps = false;

    /**
     * Champs autorisés.
     */
    protected $fillable = [
        'idUtilisateur',
        'idDemande',
        'action',
        'dateAction',
        'ancienneValeur',
        'nouvelleValeur',
    ];

    /**
     * Conversion.
     */
    protected $casts = [
        'dateAction' => 'datetime',
    ];

    /**
     * L'historique appartient à un utilisateur.
     */
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(
            Utilisateur::class,
            'idUtilisateur',
            'idUtilisateur'
        );
    }

    /**
     * L'historique appartient à une demande.
     */
    public function demande(): BelongsTo
    {
        return $this->belongsTo(
            DemandeStage::class,
            'idDemande',
            'idDemande'
        );
    }
}