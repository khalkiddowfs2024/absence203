@extends('adminlte::page')

@section('title', 'Liste des Étudiants')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Liste des Étudiants</h1>
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus mr-1"></i> Nouvel Étudiant
        </a>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header border-0 bg-white">
            <h3 class="card-title text-bold">Filtres</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('etudiants.index') }}" method="GET" class="row">
                <div class="col-md-4">
                    <select name="classe_id" class="form-control select2 shadow-sm" onchange="this.form.submit()">
                        <option value="">Toutes les Classes</option>
                        @foreach($classes as $classe)
                            <option value="{{ $classe->id }}" {{ request('classe_id') == $classe->id ? 'selected' : '' }}>
                                {{ $classe->libelle }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-outline card-info shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead class="bg-light">
                    <tr>
                        <th>Photo</th>
                        <th>Massar ID</th>
                        <th>Nom Complet</th>
                        <th>Classe</th>
                        <th>Statut</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($etudiants as $etudiant)
                        <tr>
                            <td>
                                <img src="{{ $etudiant->photo ? asset('storage/'.$etudiant->photo) : asset('vendor/adminlte/dist/img/avatar5.png') }}" 
                                     class="img-circle elevation-1" alt="Avatar" width="40" height="40">
                            </td>
                            <td class="text-bold">{{ $etudiant->massar_id }}</td>
                            <td>{{ $etudiant->prenom }} {{ $etudiant->nom }}</td>
                            <td><span class="badge badge-info">{{ $etudiant->classe->libelle ?? '-' }}</span></td>
                            <td>
                                <span class="badge badge-{{ $etudiant->statut == 'actif' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($etudiant->statut) }}
                                </span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('etudiants.show', $etudiant) }}" class="btn btn-sm btn-outline-primary" title="Voir profil">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('etudiants.edit', $etudiant) }}" class="btn btn-sm btn-outline-info" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Aucun étudiant trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($etudiants->hasPages())
            <div class="card-footer bg-white">
                {{ $etudiants->appends(request()->input())->links() }}
            </div>
        @endif
    </div>
@stop

@section('css')
    <style>
        .card { border-radius: 12px; }
        .table img { object-fit: cover; }
        .table th { border-top: none; }
        .btn-sm { border-radius: 6px; }
    </style>
@stop
