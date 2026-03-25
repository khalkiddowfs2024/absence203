<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;
use App\Models\Seance;
use App\Models\User;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id', 'seance_id', 'type', 'duree_retard_min', 'is_justifiee',
        'motif', 'piece_jointe', 'saisie_par', 'date_saisie', 'date_justification'
    ];

    protected $casts = [
        'date_saisie' => 'datetime',
        'date_justification' => 'datetime',
        'is_justifiee' => 'boolean',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function seance()
    {
        return $this->belongsTo(Seance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'saisie_par');
    }

    // Scopes
    public function scopeToday($query)
    {
        return $query->whereDate('date_saisie', now());
    }

    public function scopeJustified($query)
    {
        return $query->where('is_justifiee', true);
    }
}
