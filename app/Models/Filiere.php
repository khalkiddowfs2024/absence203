<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Niveau;
use App\Models\Classe;

class Filiere extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'niveau_id'];

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
