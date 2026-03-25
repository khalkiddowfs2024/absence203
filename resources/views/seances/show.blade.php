@extends('adminlte::page')

@section('title', 'Détails de la Séance')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Détails de la Séance</h1>
        <a href="{{ route('seances.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center text-bold">{{ $seance->emploiDuTemps->matiere->libelle ?? 'Matière Inconnue' }}</h3>
                    <p class="text-muted text-center">{{ $seance->emploiDuTemps->classe->libelle ?? 'Classe Inconnue' }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Date</b> <a class="float-right text-dark">{{ $seance->date->format('d/m/Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Horaire</b> <a class="float-right text-dark">{{ \Carbon\Carbon::parse($seance->emploiDuTemps->heure_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($seance->emploiDuTemps->heure_fin)->format('H:i') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Enseignant</b> <a class="float-right text-dark">{{ $seance->emploiDuTemps->enseignant->nom ?? '-' }} {{ $seance->emploiDuTemps->enseignant->prenom ?? '' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Statut</b> <span class="badge badge-info float-right">{{ ucfirst($seance->statut) }}</span>
                        </li>
                    </ul>
                    
                    @if($seance->observation)
                        <strong><i class="fas fa-info-circle mr-1"></i> Observations</strong>
                        <p class="text-muted">{{ $seance->observation }}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title text-bold">Absences enregistrées</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover m-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Étudiant</th>
                                <th>Type</th>
                                <th>Justifiée</th>
                                <th>Heure de Saisie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($seance->absences as $absence)
                                <tr>
                                    <td>{{ $absence->etudiant->prenom }} {{ $absence->etudiant->nom }}</td>
                                    <td>
                                        <span class="badge badge-{{ $absence->type == 'absence' ? 'danger' : 'warning' }}">
                                            {{ ucfirst($absence->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($absence->is_justifiee)
                                            <span class="text-success"><i class="fas fa-check"></i> Oui</span>
                                        @else
                                            <span class="text-danger"><i class="fas fa-times"></i> Non</span>
                                        @endif
                                    </td>
                                    <td>{{ $absence->date_saisie ? $absence->date_saisie->format('H:i') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Aunces enregistrée pour cette séance.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
