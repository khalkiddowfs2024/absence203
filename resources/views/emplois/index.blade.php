@extends('adminlte::page')

@section('title', 'Emplois du Temps')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Gestion des Emplois du Temps</h1>
        <a href="{{ route('emplois.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus mr-1"></i> Créer Créneau
        </a>
    </div>
@stop

@section('content')
    <div class="card card-outline card-info shadow-sm">
        <div class="card-header border-0 bg-white">
            <h3 class="card-title text-bold"><i class="fas fa-calendar-alt text-info mr-2"></i>Liste des Créneaux</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead class="bg-light">
                    <tr>
                        <th>Jour</th>
                        <th>Horaire</th>
                        <th>Classe</th>
                        <th>Matière</th>
                        <th>Enseignant</th>
                        <th>Salle</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($emplois as $emploi)
                        <tr>
                            <td><span class="badge badge-secondary">{{ $emploi->jour_nom }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($emploi->heure_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($emploi->heure_fin)->format('H:i') }}</td>
                            <td>{{ $emploi->classe->libelle ?? '-' }}</td>
                            <td>{{ $emploi->matiere->libelle ?? '-' }}</td>
                            <td>{{ $emploi->enseignant->nom ?? '-' }} {{ $emploi->enseignant->prenom ?? '' }}</td>
                            <td>{{ $emploi->salle ?? 'N/A' }}</td>
                            <td class="text-right">
                                <a href="{{ route('emplois.show', $emploi) }}" class="btn btn-sm btn-outline-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('emplois.edit', $emploi) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('emplois.destroy', $emploi) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce créneau ?');">
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
                            <td colspan="7" class="text-center py-4 text-muted">Auteur créneau d'emploi du temps trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">
            {{ $emplois->links() }}
        </div>
    </div>
@stop
