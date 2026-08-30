<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DemandeStage extends Model
{
    /**
     * Nom de la table.
     */
    protected $table = 'demande_stage';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idDemande';

    /**
     * La table n'utilise pas created_at / updated_at.
     */
    public $timestamps = false;

    /**
     * Champs autorisés pour l'affectation de masse.
     */
    protected $fillable = [
        'idCandidat',
        'idService',
        'numeroDemande',
        'dateDepot',
        'dateDebut',
        'dateFin',
        'theme',
        'motivation',
        'statut',
        'typeDepot',
        'typeStage',
        'theme',
        'observation',
    ];

    /**
     * Conversion des dates.
     */
    protected $casts = [
        'dateDepot' => 'date',
        'dateDebut' => 'date',
        'dateFin' => 'date',
    ];

    /**
     * Une demande appartient à un candidat.
     */
    public function candidat(): BelongsTo
    {
        return $this->belongsTo(
            Candidat::class,
            'idCandidat',
            'idCandidat'
        );
    }

    /**
     * Une demande appartient à un service.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(
            Service::class,
            'idService',
            'idService'
        );
    }

    /**
     * Une demande possède plusieurs documents.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(
            Document::class,
            'idDemande',
            'idDemande'
        );
    }
}