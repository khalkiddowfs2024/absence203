@extends('adminlte::page')

@section('title', 'Justifier une Absence')

@section('content_header')
    <h1>Justifier une Absence</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-outline card-success shadow-lg border-0" style="border-radius: 20px;">
                <div class="card-header bg-success text-white py-3" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h3 class="card-title text-bold"><i class="fas fa-file-signature mr-2"></i> Formulaire de Justification</h3>
                </div>
                <form action="{{ route('justifications.store', $absence) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="alert alert-light border shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-1 text-muted small">Étudiant</p>
                                    <p class="text-bold mb-0 text-primary">{{ $absence->etudiant->prenom ?? 'Étudiant' }} {{ $absence->etudiant->nom ?? 'Inconnu' }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-1 text-muted small">Séance du</p>
                                    <p class="text-bold mb-0 text-info">{{ optional($absence->date_saisie)->format('d/m/Y') ?? optional(optional($absence->seance)->date)->format('d/m/Y') ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-muted small text-uppercase font-weight-bold">Motif de l'absence</label>
                            <textarea name="motif" class="form-control shadow-sm border-0 bg-light" rows="3" placeholder="Ex: Certificat médical, Raison familiale..." required></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-muted small text-uppercase font-weight-bold">Pièce Jointe (PDF, JPG, PNG)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="document" id="document">
                                <label class="custom-file-label shadow-sm border-0 bg-light" for="document">Choisir le fichier...</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 py-4 text-right">
                        <a href="{{ route('absences.index') }}" class="btn btn-link text-muted mr-3">Annuler</a>
                        <button type="submit" class="btn btn-success px-5 py-2 shadow-sm" style="border-radius: 25px;">
                            <i class="fas fa-check-circle mr-1"></i> Valider la Justification
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("document").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    })
</script>
@stop

@section('css')
    <style>
        .form-control:focus { box-shadow: 0 0 0 0.2rem rgba(40,167,69,.1) !important; background-color: #fff !important; }
    </style>
@stop
