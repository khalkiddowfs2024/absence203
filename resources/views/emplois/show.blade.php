@extends('adminlte::page')

@section('title', 'Détails du Créneau')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Détails du Créneau : {{ $emploi->jour_nom }} ({{ \Carbon\Carbon::parse($emploi->heure_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($emploi->heure_fin)->format('H:i') }})</h1>
        <a href="{{ route('emplois.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Informations Générales</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>Classe</b> <a class="float-right text-dark">{{ $emploi->classe->libelle ?? '-' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Matière</b> <a class="float-right text-dark">{{ $emploi->matiere->libelle ?? '-' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Enseignant</b> <a class="float-right text-dark">{{ $emploi->enseignant->nom ?? '-' }} {{ $emploi->enseignant->prenom ?? '' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Salle</b> <a class="float-right text-dark">{{ $emploi->salle ?? 'N/A' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Semestre</b> <a class="float-right text-dark">S{{ $emploi->semestre }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title text-bold">Séances associées à ce créneau</h3>
                    <div class="card-tools">
                        <a href="{{ route('seances.create') }}" class="btn btn-xs btn-primary"><i class="fas fa-plus"></i> Créer Séance</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover m-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Date de séance</th>
                                <th>Statut</th>
                                <th>Observation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($emploi->seances as $seance)
                                <tr>
                                    <td>
                                        <a href="{{ route('seances.show', $seance) }}">
                                            {{ $seance->date->format('d/m/Y') }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $seance->statut == 'planifiee' ? 'info' : ($seance->statut == 'realisee' ? 'success' : 'danger') }}">
                                            {{ ucfirst($seance->statut) }}
                                        </span>
                                    </td>
                                    <td>{{ $seance->observation ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Aucune séance n'a été créée pour ce créneau horraire.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
