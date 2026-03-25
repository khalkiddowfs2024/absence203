<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\Etudiant;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $table = 'annees_scolaires';

    protected $fillable = ['libelle', 'date_debut', 'date_fin', 'is_active'];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'is_active' => 'boolean',
    ];

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
}
