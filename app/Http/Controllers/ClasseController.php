<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Enseignant;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::with(['niveau', 'filiere', 'titulaire'])->get();
        return view('classes.index', compact('classes'));
    }

    public function show(Classe $classe)
    {
        $classe->load(['etudiants', 'niveau', 'filiere', 'titulaire']);
        return view('classes.show', compact('classe'));
    }

    public function create()
    {
        $niveaux = Niveau::all();
        $enseignants = Enseignant::all();
        return view('classes.create', compact('niveaux', 'enseignants'));
    }
}
