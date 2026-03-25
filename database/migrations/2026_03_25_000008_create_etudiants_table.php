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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('cin_etudiant')->unique()->nullable();
            $table->string('massar_id')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('lieu_naissance')->nullable();
            $table->enum('sexe', ['M', 'F']);
            $table->string('photo')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('nom_parent')->nullable();
            $table->string('telephone_parent')->nullable();
            $table->string('email_parent')->nullable();
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->onDelete('cascade');
            $table->enum('statut', ['actif', 'transfere', 'exclu'])->default('actif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
