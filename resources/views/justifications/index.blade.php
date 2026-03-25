@extends('adminlte::page')

@section('title', 'Justifications des Absences')

@section('content_header')
    <h1>Justifications des Absences</h1>
@stop

@section('content')
    <div class="card card-outline card-warning shadow-sm">
        <div class="card-header border-0 bg-white">
            <h3 class="card-title text-bold">Absences non justifiées</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead class="bg-light">
                    <tr>
                        <th>Date</th>
                        <th>Étudiant</th>
                        <th>Classe</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absencesToJustify as $absence)
                        <tr>
                            <td>{{ optional($absence->date_saisie)->format('d/m/Y') ?? optional(optional($absence->seance)->date)->format('d/m/Y') ?? '-' }}</td>
                            <td>{{ $absence->etudiant->prenom }} {{ $absence->etudiant->nom }}</td>
                            <td>{{ $absence->etudiant->classe->libelle ?? '-' }}</td>
                            <td class="text-right">
                                <a href="{{ route('justifications.create', $absence) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-file-signature mr-1"></i> Justifier
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Toutes les absences sont justifiées !</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">
            {{ $absencesToJustify->links() }}
        </div>
    </div>
@stop
