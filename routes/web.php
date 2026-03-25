<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\JustificationController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ParametreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('etudiants', EtudiantController::class);
    Route::get('/classes/{classe}/students', [SeanceController::class, 'getStudents'])->name('classes.students');
    Route::resource('classes', ClasseController::class)->parameters(['classes' => 'classe']);
    Route::resource('emplois', App\Http\Controllers\EmploiDuTempsController::class)->parameters(['emplois' => 'emploi']);
    Route::resource('absences', AbsenceController::class);
    Route::resource('seances', SeanceController::class);
    Route::resource('justifications', JustificationController::class);
    
    Route::get('/rapports', [RapportController::class, 'index'])->name('rapports.index');
    Route::get('/rapports/bulletin/{etudiant}', [RapportController::class, 'bulletin'])->name('rapports.bulletin');
    
    Route::get('/parametres', [ParametreController::class, 'index'])->name('parametres.index');
    Route::post('/parametres', [ParametreController::class, 'update'])->name('parametres.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
