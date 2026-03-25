@extends('adminlte::page')

@section('title', 'Détails de la Classe')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Classe : {{ $classe->libelle }}</h1>
        <a href="{{ route('classes.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left mr-1"></i> Retour
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info shadow-sm">
                <div class="card-header border-0 bg-white">
                    <h3 class="card-title text-bold">Étudiants de la classe</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped m-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Massar ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Sexe</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classe->etudiants as $etudiant)
                                <tr>
                                    <td class="text-bold">{{ $etudiant->massar_id }}</td>
                                    <td>{{ $etudiant->nom }}</td>
                                    <td>{{ $etudiant->prenom }}</td>
                                    <td>{{ $etudiant->sexe }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('etudiants.show', $etudiant) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
