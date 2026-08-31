<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * Nom réel de la table.
     */
    protected $table = 'notifications';

    /**
     * Clé primaire personnalisée.
     */
    protected $primaryKey = 'idNotification';

    /**
     * La table possède created_at et updated_at.
     */
    public $timestamps = true;

    /**
     * Champs pouvant être remplis.
     */
    protected $fillable = [
        'idUtilisateur',
        'idDemande',
        'titre',
        'message',
        'type',
        'lu',
    ];

    /**
     * Conversion des types.
     */
    protected $casts = [
        'lu' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Utilisateur destinataire de la notification.
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
     * Demande concernée par la notification.
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