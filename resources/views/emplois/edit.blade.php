@extends('adminlte::page')

@section('title', 'Modifier Créneau')

@section('content_header')
    <h1>Modifier le Créneau</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card card-primary card-outline shadow-sm">
                <form action="{{ route('emplois.update', $emploi) }}" method="POST">
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

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Classe</label>
                                <select name="classe_id" class="form-control select2" required>
                                    @foreach($classes as $classe)
                                        <option value="{{ $classe->id }}" {{ $emploi->classe_id == $classe->id ? 'selected' : '' }}>{{ $classe->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Matière</label>
                                <select name="matiere_id" class="form-control select2" required>
                                    @foreach($matieres as $matiere)
                                        <option value="{{ $matiere->id }}" {{ $emploi->matiere_id == $matiere->id ? 'selected' : '' }}>{{ $matiere->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Enseignant</label>
                                <select name="enseignant_id" class="form-control select2" required>
                                    @foreach($enseignants as $enseignant)
                                        <option value="{{ $enseignant->id }}" {{ $emploi->enseignant_id == $enseignant->id ? 'selected' : '' }}>{{ $enseignant->nom }} {{ $enseignant->prenom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4 form-group">
                                <label>Jour de la semaine</label>
                                <select name="jour" class="form-control" required>
                                    @foreach([1 => 'Lundi', 2 => 'Mardi', 3 => 'Mercredi', 4 => 'Jeudi', 5 => 'Vendredi', 6 => 'Samedi'] as $val => $label)
                                        <option value="{{ $val }}" {{ $emploi->jour == $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Heure de début</label>
                                <input type="time" name="heure_debut" class="form-control" value="{{ \Carbon\Carbon::parse($emploi->heure_debut)->format('H:i') }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Heure de fin</label>
                                <input type="time" name="heure_fin" class="form-control" value="{{ \Carbon\Carbon::parse($emploi->heure_fin)->format('H:i') }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 form-group">
                                <label>Semestre</label>
                                <select name="semestre" class="form-control" required>
                                    <option value="1" {{ $emploi->semestre == 1 ? 'selected' : '' }}>Semestre 1</option>
                                    <option value="2" {{ $emploi->semestre == 2 ? 'selected' : '' }}>Semestre 2</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Salle (Optionnel)</label>
                                <input type="text" name="salle" class="form-control" value="{{ $emploi->salle }}">
                            </div>
                        </div>

                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('emplois.index') }}" class="btn btn-default mr-2">Annuler</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
