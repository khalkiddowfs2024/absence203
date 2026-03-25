@extends('adminlte::page')

@section('title', 'Créer Emploi du Temps')

@section('content_header')
    <h1>Ajouter un Créneau Horraire</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card card-primary card-outline shadow-sm">
                <form action="{{ route('emplois.store') }}" method="POST">
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

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Classe</label>
                                <select name="classe_id" class="form-control select2" required>
                                    <option value="">Sélectionner une classe</option>
                                    @foreach($classes as $classe)
                                        <option value="{{ $classe->id }}">{{ $classe->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Matière</label>
                                <select name="matiere_id" class="form-control select2" required>
                                    <option value="">Sélectionner une matière</option>
                                    @foreach($matieres as $matiere)
                                        <option value="{{ $matiere->id }}">{{ $matiere->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Enseignant</label>
                                <select name="enseignant_id" class="form-control select2" required>
                                    <option value="">Sélectionner un enseignant</option>
                                    @foreach($enseignants as $enseignant)
                                        <option value="{{ $enseignant->id }}">{{ $enseignant->nom }} {{ $enseignant->prenom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4 form-group">
                                <label>Jour de la semaine</label>
                                <select name="jour" class="form-control" required>
                                    <option value="1">Lundi</option>
                                    <option value="2">Mardi</option>
                                    <option value="3">Mercredi</option>
                                    <option value="4">Jeudi</option>
                                    <option value="5">Vendredi</option>
                                    <option value="6">Samedi</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Heure de début</label>
                                <input type="time" name="heure_debut" class="form-control" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Heure de fin</label>
                                <input type="time" name="heure_fin" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 form-group">
                                <label>Semestre</label>
                                <select name="semestre" class="form-control" required>
                                    <option value="1">Semestre 1</option>
                                    <option value="2">Semestre 2</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Salle (Optionnel)</label>
                                <input type="text" name="salle" class="form-control" placeholder="Ex: Salle 12, Amphi B...">
                            </div>
                        </div>

                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('emplois.index') }}" class="btn btn-default mr-2">Annuler</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
