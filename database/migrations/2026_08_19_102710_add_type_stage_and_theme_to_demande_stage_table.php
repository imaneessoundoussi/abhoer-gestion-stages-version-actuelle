<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('demande_stage', function (Blueprint $table) {
            $table->string('typeStage', 100)->nullable()->after('typeDepot');
            $table->string('theme', 255)->nullable()->after('typeStage');
        });
    }

    public function down(): void
    {
        Schema::table('demande_stage', function (Blueprint $table) {
            $table->dropColumn(['typeStage', 'theme']);
        });
    }
};
