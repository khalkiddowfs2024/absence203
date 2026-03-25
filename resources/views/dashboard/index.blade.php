@extends('adminlte::page')

@section('title', 'Tableau de Bord')

@section('content_header')
    <h1 class="m-0 text-dark">Tableau de Bord</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total_absences_today'] }}</h3>
                    <p>Absences Aujourd'hui</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-clock"></i>
                </div>
                <a href="{{ route('absences.index') }}" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['seances_today'] }}</h3>
                    <p>Séances du Jour</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['etudiants_danger'] }}</h3>
                    <p>Étudiants en Danger (>10%)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $stats['taux_assiduite'] }}<sup style="font-size: 20px">%</sup></h3>
                    <p>Taux d'Assiduité</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Absences Récentes</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover m-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Étudiant</th>
                                <th>Matière</th>
                                <th>Date/Heure</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAbsences as $absence)
                                <tr>
                                    <td>{{ $absence->etudiant->prenom }} {{ $absence->etudiant->nom }}</td>
                                    <td>{{ $absence->seance->emploiDuTemps->matiere->libelle }}</td>
                                    <td>{{ $absence->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $absence->is_justifiee ? 'success' : 'danger' }}">
                                            {{ $absence->is_justifiee ? 'Justifiée' : 'Non Justifiée' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted italic">Aucune absence enregistrée.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card card-outline card-info shadow-sm">
                <div class="card-header border-0">
                    <h3 class="card-title">Actions Rapides</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('absences.create') }}" class="btn btn-primary btn-block mb-2 py-2">
                        <i class="fas fa-plus-circle mr-1"></i> Saisir une Absence
                    </a>
                    <a href="{{ route('etudiants.index') }}" class="btn btn-info btn-block mb-2 py-2 text-white">
                        <i class="fas fa-users mr-1"></i> Liste des Étudiants
                    </a>
                    <a href="{{ route('rapports.index') }}" class="btn btn-secondary btn-block py-2">
                        <i class="fas fa-file-pdf mr-1"></i> Générer Rapports
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .small-box { border-radius: 12px; overflow: hidden; transition: transform 0.3s ease; }
        .small-box:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .card { border-radius: 12px; }
        .card-header { border-top-left-radius: 12px !important; border-top-right-radius: 12px !important; }
        .btn { border-radius: 8px; font-weight: 500; }
        .badge { padding: 0.5em 0.8em; border-radius: 6px; }
    </style>
@stop
