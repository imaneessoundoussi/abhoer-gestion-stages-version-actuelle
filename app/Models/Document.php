<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    /**
     * Nom de la table.
     */
    protected $table = 'document';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idDocument';

    /**
     * Pas de timestamps.
     */
    public $timestamps = false;

    /**
     * Champs autorisés.
     */
    protected $fillable = [
        'idDemande',
        'typeDocument',
        'nomFichier',
        'cheminFichier',
        'dateAjout',
    ];

    /**
     * Conversion de la date.
     */
    protected $casts = [
        'dateAjout' => 'datetime',
    ];

    /**
     * Un document appartient à une demande.
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