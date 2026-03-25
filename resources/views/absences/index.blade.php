@extends('adminlte::page')

@section('title', 'Historique des Absences')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Historique des Absences</h1>
        <a href="{{ route('absences.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Nouvelle Saisie
        </a>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead class="bg-light">
                    <tr>
                        <th>Date</th>
                        <th>Étudiant</th>
                        <th>Classe</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absences as $absence)
                        <tr>
                            <td>{{ optional($absence->date_saisie)->format('d/m/Y') ?? optional(optional($absence->seance)->date)->format('d/m/Y') ?? '-' }}</td>
                            <td class="text-bold">{{ $absence->etudiant->prenom }} {{ $absence->etudiant->nom }}</td>
                            <td><span class="badge badge-secondary">{{ $absence->etudiant->classe->libelle ?? '-' }}</span></td>
                            <td>
                                <span class="badge badge-{{ $absence->type == 'absence' ? 'danger' : 'warning' }}">
                                    {{ ucfirst($absence->type) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $absence->is_justifiee ? 'success' : 'outline-danger' }}">
                                    {{ $absence->is_justifiee ? 'Justifiée' : 'Non Justifiée' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('absences.show', $absence) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$absence->is_justifiee)
                                    <a href="#" class="btn btn-sm btn-outline-success" title="Justifier">
                                        <i class="fas fa-file-signature"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Aucune absence enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($absences->hasPages())
            <div class="card-footer bg-white">
                {{ $absences->links() }}
            </div>
        @endif
    </div>
@stop

@section('css')
    <style>
        .card { border-radius: 12px; }
        .badge { padding: 0.5em 0.8em; }
    </style>
@stop
