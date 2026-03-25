<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Classe;
use App\Models\EmploiDuTemps;

class Enseignant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'cin', 'nom', 'prenom', 'specialite', 'grade', 'telephone', 'date_embauche'
    ];

    protected $casts = [
        'date_embauche' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classes()
    {
        return $this->hasMany(Classe::class, 'titulaire_id');
    }

    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }
}
