@extends('adminlte::page')

@section('title', 'Créer une Séance')

@section('content_header')
    <h1>Nouvelle Séance</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline shadow-sm">
                <form action="{{ route('seances.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger shadow-sm">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label>Emploi du Temps / Classe & Matière</label>
                            <select name="emploi_du_temps_id" class="form-control select2" required>
                                <option value="">Choisir la configuration...</option>
                                @foreach($emplois as $emploi)
                                    <option value="{{ $emploi->id }}">
                                        {{ $emploi->classe->libelle ?? 'Classe' }} - {{ $emploi->matiere->libelle ?? 'Matière' }} ({{ $emploi->jour_nom }} {{ \Carbon\Carbon::parse($emploi->heure_debut)->format('H:i') }}-{{ \Carbon\Carbon::parse($emploi->heure_fin)->format('H:i') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Date de la Séance</label>
                                <input type="date" name="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Statut</label>
                                <select name="statut" class="form-control">
                                    <option value="planifiee">Planifiée</option>
                                    <option value="realisee">Réalisée</option>
                                    <option value="annulee">Annulée</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label>Observations</label>
                            <textarea name="observation" class="form-control" rows="3" placeholder="Notes additionnelles..."></textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('seances.index') }}" class="btn btn-default mr-2">Annuler</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
