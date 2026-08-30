<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidat', function (Blueprint $table) {

            $table->date('dateNaissance')
                ->nullable()
                ->after('cin');

            $table->string('adresse', 255)
                ->nullable()
                ->after('telephone');

            $table->string('anneeUniversitaire', 20)
                ->nullable()
                ->after('niveauEtude');

            $table->string('diplome', 150)
                ->nullable()
                ->after('anneeUniversitaire');

            $table->year('anneeObtentionDiplome')
                ->nullable()
                ->after('diplome');
        });
    }

    public function down(): void
    {
        Schema::table('candidat', function (Blueprint $table) {

            $table->dropColumn([
                'dateNaissance',
                'adresse',
                'anneeUniversitaire',
                'diplome',
                'anneeObtentionDiplome',
            ]);
        });
    }
};