@extends('adminlte::page')

@section('title', 'Gestion des Séances')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Séances de Cours</h1>
        <a href="{{ route('seances.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus mr-1"></i> Nouvelle Séance
        </a>
    </div>
@stop

@section('content')
    <div class="card card-outline card-info shadow-sm">
        <div class="card-header border-0 bg-white">
            <h3 class="card-title text-bold">Historique des Séances</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead class="bg-light">
                    <tr>
                        <th>Date</th>
                        <th>Matière</th>
                        <th>Classe</th>
                        <th>Enseignant</th>
                        <th>Statut</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($seances as $seance)
                        <tr>
                            <td>{{ $seance->date->format('d/m/Y') }}</td>
                            <td>{{ $seance->emploiDuTemps->matiere->libelle ?? '-' }}</td>
                            <td>{{ $seance->emploiDuTemps->classe->libelle ?? '-' }}</td>
                            <td>{{ $seance->emploiDuTemps->enseignant->nom ?? '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $seance->statut == 'planifiee' ? 'info' : ($seance->statut == 'realisee' ? 'success' : 'danger') }}">
                                    {{ ucfirst($seance->statut) }}
                                </span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('seances.show', $seance) }}" class="btn btn-sm btn-outline-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('seances.edit', $seance) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('seances.destroy', $seance) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette séance ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Aucune séance enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">
            {{ $seances->links() }}
        </div>
    </div>
@stop
