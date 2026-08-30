<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajouter le type de stage à la demande.
     */
    public function up(): void
    {
        Schema::table('demande_stage', function (Blueprint $table) {
            $table->string('typeStage', 100)
                ->nullable()
                ->after('typeDepot');
        });
    }

    /**
     * Annuler les modifications.
     */
    public function down(): void
    {
        Schema::table('demande_stage', function (Blueprint $table) {
            $table->dropColumn('typeStage');
        });
    }
};