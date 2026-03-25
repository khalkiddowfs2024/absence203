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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('seance_id')->constrained('seances')->onDelete('cascade');
            $table->enum('type', ['absence', 'retard'])->default('absence');
            $table->integer('duree_retard_min')->default(0);
            $table->boolean('is_justifiee')->default(false);
            $table->text('motif')->nullable();
            $table->string('piece_jointe')->nullable();
            $table->foreignId('saisie_par')->constrained('users')->onDelete('cascade');
            $table->timestamp('date_saisie')->nullable();
            $table->timestamp('date_justification')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
