<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';

    protected $primaryKey = 'idNotification';

    public $timestamps = false;

    protected $fillable = [
        'idUtilisateur',
        'idDemande',
        'titre',
        'message',
        'type',
        'lu',
        'dateNotification',
    ];

    protected $casts = [
        'lu' => 'boolean',
        'dateNotification' => 'datetime',
    ];

    /**
     * Utilisateur destinataire
     */
    public function utilisateur()
    {
        return $this->belongsTo(
            Utilisateur::class,
            'idUtilisateur',
            'idUtilisateur'
        );
    }

    /**
     * Demande concernée
     */
    public function demande()
    {
        return $this->belongsTo(
            DemandeStage::class,
            'idDemande',
            'idDemande'
        );
    }
}