<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Niveau;
use App\Models\Filiere;
use App\Models\AnneeScolaire;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\EmploiDuTemps;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle', 'niveau_id', 'filiere_id', 'annee_scolaire_id', 'capacite', 'titulaire_id'
    ];

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function titulaire()
    {
        return $this->belongsTo(Enseignant::class, 'titulaire_id');
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }
}
