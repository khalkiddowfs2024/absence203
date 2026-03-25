<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;

class NotificationParent extends Model
{
    use HasFactory;

    protected $table = 'notifications_parents';

    protected $fillable = ['etudiant_id', 'type', 'contenu', 'statut', 'date_envoi'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
}
