@extends('adminlte::page')

@section('title', 'Profil Étudiant')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Profil : {{ $etudiant->prenom }} {{ $etudiant->nom }}</h1>
        <a href="{{ url()->previous() }}" class="btn btn-default shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Retour
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- Profile Card -->
            <div class="card card-primary card-outline shadow-sm" style="border-radius: 12px;">
                <div class="card-body box-profile">
                    <div class="text-center mb-3">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="fas fa-user-graduate fa-3x text-primary"></i>
                        </div>
                    </div>
                    <h3 class="profile-username text-center text-bold">{{ $etudiant->prenom }} {{ $etudiant->nom }}</h3>
                    <p class="text-muted text-center">{{ $etudiant->classe->libelle ?? 'Sans classe' }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item border-top-0">
                            <b>Massar ID</b> <a class="float-right text-dark">{{ $etudiant->massar_id }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>CIN</b> <a class="float-right text-dark">{{ $etudiant->cin_etudiant ?? '-' }}</a>
                        </li>
                        <li class="list-group-item border-bottom-0">
                            <b>Sexe</b> <a class="float-right text-dark">{{ $etudiant->sexe }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Contact Card -->
            <div class="card card-info shadow-sm" style="border-radius: 12px;">
                <div class="card-header border-0 bg-info">
                    <h3 class="card-title text-bold"><i class="fas fa-address-book mr-2"></i> Informations Tuteur</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-user text-info mr-1"></i> Responsable Legal</strong>
                    <p class="text-muted">{{ $etudiant->nom_parent }}</p>
                    <hr>
                    <strong><i class="fas fa-phone text-info mr-1"></i> Téléphone</strong>
                    <p class="text-muted">{{ $etudiant->telephone_parent }}</p>
                    <hr>
                    <strong><i class="fas fa-envelope text-info mr-1"></i> Email</strong>
                    <p class="text-muted">{{ $etudiant->email_parent ?? 'Non renseigné' }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow-sm" style="border-radius: 12px;">
                <div class="card-header p-2 bg-white border-0">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#absences" data-toggle="tab"><i class="fas fa-history mr-1"></i> Historique des Absences</a></li>
                    </ul>
                </div>
                <div class="card-body p-0">
                    <div class="tab-content">
                        <div class="active tab-pane p-3" id="absences">
                            @if($etudiant->absences && $etudiant->absences->count() > 0)
                                <table class="table table-striped table-hover m-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Séance / Matière</th>
                                            <th>Type</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($etudiant->absences as $absence)
                                            <tr>
                                                <td>{{ optional($absence->date_saisie)->format('d/m/Y') ?? optional(optional($absence->seance)->date)->format('d/m/Y') ?? '-' }}</td>
                                                <td>{{ $absence->seance->emploiDuTemps->matiere->libelle ?? '-' }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $absence->type == 'absence' ? 'danger' : 'warning' }}">
                                                        {{ ucfirst($absence->type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($absence->is_justifiee)
                                                        <span class="text-success"><i class="fas fa-check-circle mr-1"></i> Justifiée</span>
                                                    @else
                                                        <span class="text-danger"><i class="fas fa-times-circle mr-1"></i> Non Justifiée</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                                    <h5 class="text-success">Excellente assiduité !</h5>
                                    <p class="text-muted">Aucune absence ou retard enregistré pour cet étudiant.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white text-right" style="border-radius: 0 0 12px 12px;">
                    <a href="{{ route('rapports.bulletin', $etudiant) }}" class="btn btn-danger shadow-sm" target="_blank">
                        <i class="fas fa-file-pdf mr-1"></i> Générer le Bulletin PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
