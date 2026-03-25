<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Classe;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $query = Etudiant::query();
        if ($request->has('classe_id')) {
            $query->where('classe_id', $request->classe_id);
        }
        $etudiants = $query->with('classe')->paginate(15);
        $classes = Classe::all();
        
        return view('etudiants.index', compact('etudiants', 'classes'));
    }

    public function create()
    {
        $classes = Classe::all();
        return view('etudiants.create', compact('classes'));
    }

    public function store(Request $request)
    {
        // Logic to store
    }

    public function show(Etudiant $etudiant)
    {
        $etudiant->load(['absences.seance.emploiDuTemps.matiere', 'classe', 'sanctions']);
        return view('etudiants.show', compact('etudiant'));
    }

    public function edit(Etudiant $etudiant)
    {
        $classes = Classe::all();
        return view('etudiants.edit', compact('etudiant', 'classes'));
    }

    public function update(Request $request, Etudiant $etudiant)
    {
        // Logic to update
    }

    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('etudiants.index');
    }
}
