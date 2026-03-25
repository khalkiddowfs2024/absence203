<?php

namespace App\Http\Controllers;

use App\Models\EmploiDuTemps;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Enseignant;
use Illuminate\Http\Request;

class EmploiDuTempsController extends Controller
{
    public function index()
    {
        $emplois = EmploiDuTemps::with(['classe', 'matiere', 'enseignant'])->orderBy('jour')->orderBy('heure_debut')->paginate(15);
        return view('emplois.index', compact('emplois'));
    }

    public function create()
    {
        $classes = Classe::all();
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();
        return view('emplois.create', compact('classes', 'matieres', 'enseignants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'matiere_id' => 'required|exists:matieres,id',
            'enseignant_id' => 'required|exists:enseignants,id',
            'jour' => 'required|integer|between:1,7',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'salle' => 'nullable|string|max:50',
            'semestre' => 'required|in:1,2'
        ]);

        EmploiDuTemps::create($request->all());

        return redirect()->route('emplois.index')->with('success', 'Créneau enregistré avec succès.');
    }

    public function show(EmploiDuTemps $emploi)
    {
        $emploi->load(['classe', 'matiere', 'enseignant', 'seances']);
        return view('emplois.show', compact('emploi'));
    }

    public function edit(EmploiDuTemps $emploi)
    {
        $classes = Classe::all();
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();
        return view('emplois.edit', compact('emploi', 'classes', 'matieres', 'enseignants'));
    }

    public function update(Request $request, EmploiDuTemps $emploi)
    {
        $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'matiere_id' => 'required|exists:matieres,id',
            'enseignant_id' => 'required|exists:enseignants,id',
            'jour' => 'required|integer|between:1,7',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'salle' => 'nullable|string|max:50',
            'semestre' => 'required|in:1,2'
        ]);

        $emploi->update($request->all());

        return redirect()->route('emplois.index')->with('success', 'Créneau mis à jour avec succès.');
    }

    public function destroy(EmploiDuTemps $emploi)
    {
        $emploi->delete();
        return redirect()->route('emplois.index')->with('success', 'Créneau supprimé.');
    }
}
