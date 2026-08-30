<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $table = 'service';

    protected $primaryKey = 'idService';

    public $timestamps = false;

    protected $fillable = [
        'nomService',
        'description',
        'idDepartement',
    ];

    public function demandes(): HasMany
    {
        return $this->hasMany(
            DemandeStage::class,
            'idService',
            'idService'
        );
    }
}