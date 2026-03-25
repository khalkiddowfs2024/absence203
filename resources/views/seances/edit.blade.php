@extends('adminlte::page')

@section('title', 'Modifier la Séance')

@section('content_header')
    <h1>Modifier la Séance</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline shadow-sm">
                <form action="{{ route('seances.update', $seance) }}" method="POST">
                    @csrf
                    @method('PUT')
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
                                @foreach($emplois as $emploi)
                                    <option value="{{ $emploi->id }}" {{ $emploi->id == $seance->emploi_du_temps_id ? 'selected' : '' }}>
                                        {{ $emploi->classe->libelle ?? 'Classe' }} - {{ $emploi->matiere->libelle ?? 'Matière' }} ({{ $emploi->jour_nom }} {{ \Carbon\Carbon::parse($emploi->heure_debut)->format('H:i') }}-{{ \Carbon\Carbon::parse($emploi->heure_fin)->format('H:i') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Date de la Séance</label>
                                <input type="date" name="date" class="form-control" value="{{ old('date', $seance->date->format('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Statut</label>
                                <select name="statut" class="form-control">
                                    <option value="planifiee" {{ $seance->statut == 'planifiee' ? 'selected' : '' }}>Planifiée</option>
                                    <option value="realisee" {{ $seance->statut == 'realisee' ? 'selected' : '' }}>Réalisée</option>
                                    <option value="annulee" {{ $seance->statut == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label>Observations</label>
                            <textarea name="observation" class="form-control" rows="3">{{ old('observation', $seance->observation) }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('seances.index') }}" class="btn btn-default mr-2">Annuler</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
