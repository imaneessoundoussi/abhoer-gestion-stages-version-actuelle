<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidat extends Model
{
    protected $table = 'candidat';

    protected $primaryKey = 'idCandidat';

    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'telephone',
        'email',
        'etablissement',
        'formation',
        'niveauEtude',
    ];

    public function demandes(): HasMany
    {
        return $this->hasMany(
            DemandeStage::class,
            'idCandidat',
            'idCandidat'
        );
    }
}