<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Seance;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    /**
     * Get students for a specific class to be used in absence entry.
     */
    public function getStudents(Classe $classe)
    {
        $students = $classe->etudiants()->orderBy('nom')->get();
        return response()->json($students);
    }

    /**
     * Display a listing of seances.
     */
    public function index()
    {
        $seances = Seance::with(['emploiDuTemps.matiere', 'emploiDuTemps.classe', 'emploiDuTemps.enseignant'])->latest()->paginate(15);
        return view('seances.index', compact('seances'));
    }

    /**
     * Show the form for creating a new seance manually (if needed).
     */
    public function create()
    {
        $emplois = \App\Models\EmploiDuTemps::with(['classe', 'matiere'])->get();
        return view('seances.create', compact('emplois'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'emploi_du_temps_id' => 'required|exists:emplois_du_temps,id',
            'date' => 'required|date',
            'statut' => 'required|in:planifiee,realisee,annulee',
            'observation' => 'nullable|string'
        ]);

        Seance::create($request->all());

        return redirect()->route('seances.index')->with('success', 'Séance créée avec succès.');
    }

    public function show(Seance $seance)
    {
        $seance->load(['emploiDuTemps.classe', 'emploiDuTemps.matiere', 'emploiDuTemps.enseignant', 'absences.etudiant']);
        return view('seances.show', compact('seance'));
    }

    public function edit(Seance $seance)
    {
        $emplois = \App\Models\EmploiDuTemps::with(['classe', 'matiere'])->get();
        return view('seances.edit', compact('seance', 'emplois'));
    }

    public function update(Request $request, Seance $seance)
    {
        $request->validate([
            'emploi_du_temps_id' => 'required|exists:emplois_du_temps,id',
            'date' => 'required|date',
            'statut' => 'required|in:planifiee,realisee,annulee',
            'observation' => 'nullable|string'
        ]);

        $seance->update($request->all());

        return redirect()->route('seances.index')->with('success', 'Séance mise à jour avec succès.');
    }

    public function destroy(Seance $seance)
    {
        $seance->delete();
        return redirect()->route('seances.index')->with('success', 'Séance supprimée.');
    }
}
