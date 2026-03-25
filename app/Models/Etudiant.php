<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'cin_etudiant', 'massar_id', 'nom', 'prenom', 'date_naissance', 'lieu_naissance', 
        'sexe', 'photo', 'adresse', 'ville', 'nom_parent', 'telephone_parent', 
        'email_parent', 'classe_id', 'annee_scolaire_id', 'statut'
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function sanctions()
    {
        return $this->hasMany(Sanction::class);
    }

    // Business Logic Helper
    public function scopeActive($query)
    {
        return $query->where('statut', 'actif');
    }

    public function getFullNameAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }
}
