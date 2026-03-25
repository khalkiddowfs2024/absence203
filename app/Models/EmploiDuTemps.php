<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\Seance;

class EmploiDuTemps extends Model
{
    use HasFactory;

    protected $table = 'emplois_du_temps';

    protected $fillable = [
        'classe_id', 'matiere_id', 'enseignant_id', 'jour', 'heure_debut', 'heure_fin', 'salle', 'semestre'
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    public function seances()
    {
        return $this->hasMany(Seance::class);
    }

    public function getJourNomAttribute()
    {
        $jours = [
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'Samedi',
            7 => 'Dimanche'
        ];
        
        return $jours[$this->jour] ?? 'Inconnu';
    }
}
