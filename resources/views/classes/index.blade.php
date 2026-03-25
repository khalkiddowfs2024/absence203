@extends('adminlte::page')

@section('title', 'Liste des Classes')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Gestion des Classes</h1>
        <a href="{{ route('classes.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus mr-1"></i> Nouvelle Classe
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        @forelse($classes as $classe)
            <div class="col-md-4 mb-4">
                <div class="card card-outline card-primary shadow-sm h-100">
                    <div class="card-header border-0 bg-white">
                        <h3 class="card-title text-bold text-primary">{{ $classe->libelle }}</h3>
                        <div class="card-tools">
                            <span class="badge badge-info">{{ $classe->niveau->libelle ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="mb-1 text-muted small">Titulaire</p>
                        <p class="text-bold mb-3">{{ $classe->titulaire->nom ?? 'Non assigné' }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-users text-muted mr-1"></i>
                                <span class="text-bold">{{ $classe->etudiants_count ?? $classe->etudiants->count() }}</span> Étudiants
                            </div>
                            <div class="progress progress-xs flex-grow-1 mx-3">
                                <div class="progress-bar bg-success" style="width: {{ ($classe->etudiants->count() / $classe->capacite) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('classes.show', $classe) }}" class="btn btn-sm btn-outline-primary btn-block">
                            <i class="fas fa-eye mr-1"></i> Voir la Liste
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Aucune classe trouvée.</p>
            </div>
        @endforelse
    </div>
@stop

@section('css')
    <style>
        .card { border-radius: 12px; transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    </style>
@stop
