<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Services\RapportService;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    protected $rapportService;

    public function __construct(RapportService $rapportService)
    {
        $this->rapportService = $rapportService;
    }

    public function index()
    {
        $etudiants = Etudiant::with('classe')->get();
        return view('rapports.index', compact('etudiants'));
    }

    public function bulletin(Etudiant $etudiant)
    {
        return $this->rapportService->generateStudentBulletin($etudiant);
    }
}
