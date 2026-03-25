<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Absence;
use App\Models\Etudiant;
use App\Models\Seance;
use App\Models\Classe;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_absences_today' => Absence::today()->count(),
            'seances_today' => Seance::whereDate('date', now())->count(),
            'etudiants_danger' => 0, // Placeholder for logic
            'taux_assiduite' => 95, // Placeholder
        ];

        $recentAbsences = Absence::with(['etudiant', 'seance.emploiDuTemps.matiere'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentAbsences'));
    }
}
