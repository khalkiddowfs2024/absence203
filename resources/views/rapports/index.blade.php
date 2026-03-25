@extends('adminlte::page')

@section('title', 'Rapports & Bulletins')

@section('content_header')
    <h1>Génération des Rapports</h1>
@stop

@section('content')
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header border-0 bg-white">
            <h3 class="card-title text-bold">Sélectionner un Étudiant pour générer un bulletin</h3>
        </div>
        <div class="card-body">
            <table class="table table-hover datatable border-0">
                <thead>
                    <tr>
                        <th>Nom Complet</th>
                        <th>Classe</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etudiants as $etudiant)
                        <tr>
                            <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                            <td>{{ $etudiant->classe->libelle ?? '-' }}</td>
                            <td class="text-right">
                                <a href="{{ route('rapports.bulletin', $etudiant) }}" class="btn btn-sm btn-danger shadow-sm">
                                    <i class="fas fa-file-pdf mr-1"></i> Télécharger PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
@stop
