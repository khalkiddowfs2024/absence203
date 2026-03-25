<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Seance;
use App\Models\Etudiant;
use App\Models\Classe;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with(['etudiant', 'seance.emploiDuTemps.matiere'])->latest()->paginate(15);
        return view('absences.index', compact('absences'));
    }

    public function create()
    {
        $classes = Classe::all();
        $seances = Seance::whereDate('date', now())->with(['emploiDuTemps.matiere', 'emploiDuTemps.classe'])->get();
        return view('absences.create', compact('classes', 'seances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'seance_id' => 'required|exists:seances,id',
            'absences' => 'array',
            'absences.*.etudiant_id' => 'required|exists:etudiants,id',
            'absences.*.type' => 'required|in:present,absence,retard',
        ]);

        foreach ($request->absences as $data) {
            if ($data['type'] === 'present') {
                continue;
            }

            Absence::create([
                'etudiant_id' => $data['etudiant_id'],
                'seance_id' => $request->seance_id,
                'date_saisie' => now(),
                'type' => $data['type'],
                'saisie_par' => auth()->check() ? auth()->id() : 1,
                'is_justifiee' => false,
            ]);
        }

        return redirect()->route('absences.index')->with('success', 'Absences enregistrées avec succès.');
    }

    public function show(Absence $absence)
    {
        return view('absences.show', compact('absence'));
    }

    public function edit(Absence $absence)
    {
        return view('absences.edit', compact('absence'));
    }

    public function update(Request $request, Absence $absence)
    {
        // Logic to update
    }

    public function destroy(Absence $absence)
    {
        $absence->delete();
        return redirect()->route('absences.index');
    }
}
