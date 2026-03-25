<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matieres', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('code')->unique();
            $table->integer('coefficient')->default(1);
            $table->integer('volume_horaire_hebdo')->default(0);
            $table->enum('type', ['theorique', 'pratique', 'sport'])->default('theorique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matieres');
    }
};
