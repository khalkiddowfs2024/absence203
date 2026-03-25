<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use App\Models\Etablissement;
use App\Models\AnneeScolaire;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function index()
    {
        $etablissement = Etablissement::first();
        $annees = AnneeScolaire::all();
        $parametres = Parametre::all()->pluck('valeur', 'cle');
        
        return view('parametres.index', compact('etablissement', 'annees', 'parametres'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');
        
        foreach ($data as $key => $value) {
            Parametre::updateOrCreate(['cle' => $key], ['valeur' => $value]);
        }

        return redirect()->back()->with('success', 'Paramètres mis à jour.');
    }
}
