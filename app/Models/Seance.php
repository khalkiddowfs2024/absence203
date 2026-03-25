<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Absence;
use App\Models\EmploiDuTemps;

class Seance extends Model
{
    use HasFactory;

    protected $fillable = ['emploi_du_temps_id', 'date', 'statut', 'observation'];

    protected $casts = [
        'date' => 'date',
    ];

    public function emploiDuTemps()
    {
        return $this->belongsTo(EmploiDuTemps::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
}
