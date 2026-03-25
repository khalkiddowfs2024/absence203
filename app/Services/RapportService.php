<?php

namespace App\Services;

use App\Models\Etudiant;
use App\Models\Classe;
use Barryvdh\DomPDF\Facade\Pdf;

class RapportService
{
    /**
     * Generate a PDF report (bulletin) for a student.
     */
    public function generateStudentBulletin(Etudiant $etudiant)
    {
        $absences = $etudiant->absences()->with('seance.emploiDuTemps.matiere')->get();
        $pdf = Pdf::loadView('rapports.pdf.bulletin', compact('etudiant', 'absences'));
        
        return $pdf->download("bulletin_{$etudiant->nom}.pdf");
    }

    /**
     * Generate a summary report for a class.
     */
    public function generateClassReport(Classe $classe)
    {
        // Logic for class summary
    }
}
