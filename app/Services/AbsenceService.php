<?php

namespace App\Services;

use App\Models\Absence;
use App\Models\Etudiant;
use App\Models\Matiere;

class AbsenceService
{
    /**
     * Calculate the absence rate for a student in a specific subject.
     */
    public function calculateAbsenceRate(Etudiant $etudiant, Matiere $matiere)
    {
        $totalHours = $matiere->volume_horaire_hebdo * 10; // Simple approximation for a semester
        $absenceHours = $etudiant->absences()
            ->whereHas('seance.emploiDuTemps', function ($query) use ($matiere) {
                $query->where('matiere_id', $matiere->id);
            })
            ->where('type', 'absence')
            ->count();

        return ($totalHours > 0) ? ($absenceHours / $totalHours) * 100 : 0;
    }

    /**
     * Check if a student has exceeded the warning threshold (10%).
     */
    public function isAboveThreshold(Etudiant $etudiant, Matiere $matiere)
    {
        return $this->calculateAbsenceRate($etudiant, $matiere) >= 10;
    }
}
