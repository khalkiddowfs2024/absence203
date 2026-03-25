@extends('adminlte::page')

@section('title', 'Paramètres du Système')

@section('content_header')
    <h1>Paramètres du Système</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header border-0 bg-white">
                    <h3 class="card-title text-bold">Établissement</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('parametres.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nom de l'Établissement</label>
                            <input type="text" name="nom_ecole" class="form-control" value="{{ $etablissement->nom ?? 'Mon École' }}">
                        </div>
                        <div class="form-group">
                            <label>Adresse</label>
                            <textarea name="adresse_ecole" class="form-control">{{ $etablissement->adresse ?? '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block shadow-sm">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-outline card-info shadow-sm">
                <div class="card-header border-0 bg-white">
                    <h3 class="card-title text-bold">Configuration des Seuils</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('parametres.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Seuil d'alerte Absence (en %)</label>
                            <input type="number" name="seuil_alerte" class="form-control" value="{{ $parametres['seuil_alerte'] ?? 10 }}">
                        </div>
                        <div class="form-group">
                            <label>Nombre d'heures par défaut / séance</label>
                            <input type="number" name="heures_par_seance" class="form-control" value="{{ $parametres['heures_par_seance'] ?? 1 }}">
                        </div>
                        <button type="submit" class="btn btn-info btn-block shadow-sm text-white">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
