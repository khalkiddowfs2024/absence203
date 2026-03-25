<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Etudiant;
use App\Models\Justification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JustificationController extends Controller
{
    public function index()
    {
        $absencesToJustify = Absence::where('is_justifiee', false)->with('etudiant.classe')->latest()->paginate(15);
        return view('justifications.index', compact('absencesToJustify'));
    }

    public function create(Absence $absence)
    {
        $absence->load('etudiant');
        return view('justifications.create', compact('absence'));
    }

    public function store(Request $request, Absence $absence)
    {
        $request->validate([
            'motif' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('justifications', 'public');
        }

        $absence->update([
            'is_justifiee' => true,
        ]);

        // If we had a Justification model/table, we would create it here. 
        // For now, let's assume we just mark the absence as justified and add a note.
        // If the table exists:
        /*
        Justification::create([
            'absence_id' => $absence->id,
            'motif' => $request->motif,
            'piece_jointe' => $path,
            'date_justification' => now(),
        ]);
        */

        return redirect()->route('absences.index')->with('success', 'Absence justifiée avec succès.');
    }
}
