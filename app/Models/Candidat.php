<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidat extends Model
{
    /**
     * Nom de la table.
     */
    protected $table = 'candidat';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idCandidat';

    /**
     * La table n'utilise pas created_at / updated_at.
     */
    public $timestamps = false;

    /**
     * Champs autorisés pour l'affectation de masse.
     */
    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'cne',
        'email',
        'telephone',
        'adresse',
        'dateNaissance',
        'etablissement',
        'formation',
        'niveauEtude',
        'anneeUniversitaire',
        'niveau',
    ];

    /**
     * Conversion des attributs.
     */
    protected $casts = [
        'dateNaissance' => 'date',
    ];

    /**
     * Un candidat peut avoir plusieurs demandes de stage.
     */
    public function demandes(): HasMany
    {
        return $this->hasMany(
            DemandeStage::class,
            'idCandidat',
            'idCandidat'
        );
    }
}