<?php

namespace App\Services;

use App\Models\Etudiant;
use App\Models\NotificationParent;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send an absence alert to parents.
     */
    public function sendAbsenceAlert(Etudiant $etudiant, string $message, string $type = 'email')
    {
        // Mocking the send process for now
        Log::info("Sending {$type} notification to parent of {$etudiant->nom}: {$message}");

        return NotificationParent::create([
            'etudiant_id' => $etudiant->id,
            'type' => $type,
            'contenu' => $message,
            'statut' => 'envoyé',
            'date_envoi' => now(),
        ]);
    }
}
