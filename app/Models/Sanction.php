<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;
use App\Models\AnneeScolaire;

class Sanction extends Model
{
    use HasFactory;

    protected $fillable = ['etudiant_id', 'type', 'date', 'description', 'annee_scolaire_id'];

    protected $casts = [
        'date' => 'date',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }
}
