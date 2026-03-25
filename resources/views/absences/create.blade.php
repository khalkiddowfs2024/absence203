@extends('adminlte::page')

@section('title', 'Saisie des Absences')

@section('content_header')
    <h1>Saisie des Absences</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-outline card-primary shadow-lg border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h3 class="card-title text-bold"><i class="fas fa-edit mr-2"></i> Nouvelle Séance d'Absence</h3>
                </div>
                <form action="{{ route('absences.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger shadow-sm" style="border-radius: 12px;">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small text-uppercase font-weight-bold">Classe</label>
                                <select class="form-control select2 shadow-sm border-0 bg-light py-4" name="classe_id" id="classe_id" required>
                                    <option value="">Sélectionner une classe...</option>
                                    @foreach($classes as $classe)
                                        <option value="{{ $classe->id }}">{{ $classe->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small text-uppercase font-weight-bold">Séance (Aujourd'hui)</label>
                                <select class="form-control shadow-sm border-0 bg-light py-4" name="seance_id" id="seance_id" required>
                                    <option value="">Sélectionner une séance...</option>
                                    @foreach($seances as $seance)
                                        <option class="seance-option classe-{{ $seance->emploiDuTemps->classe_id ?? '' }}" value="{{ $seance->id }}">
                                            {{ $seance->emploiDuTemps->classe->libelle ?? '' }} | {{ $seance->emploiDuTemps->matiere->libelle ?? 'Matière' }} - {{ \Carbon\Carbon::parse($seance->emploiDuTemps->heure_debut ?? '')->format('H:i') }} à {{ \Carbon\Carbon::parse($seance->emploiDuTemps->heure_fin ?? '')->format('H:i') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="loading_spinner" class="text-center d-none my-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Chargement...</span>
                            </div>
                        </div>

                        <div id="students_container" class="mt-4 d-none">
                            <table class="table table-hover table-striped shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Étudiant</th>
                                        <th class="text-center">Présent</th>
                                        <th class="text-center">Absent</th>
                                        <th class="text-center">Retard</th>
                                    </tr>
                                </thead>
                                <tbody id="students_list">
                                    {{-- Populated by AJAX --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 py-3 text-right">
                        <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm" style="border-radius: 25px;">
                            <i class="fas fa-save mr-1"></i> Enregistrer les Absences
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
    $(document).ready(function() {
        // Hide seances by default or show all? Best to hide until class selected
        $('.seance-option').hide();
        $('#seance_id').val('');

        $('#classe_id').on('change', function() {
            let classeId = $(this).val();
            
            // Filter Seances
            $('.seance-option').hide();
            $('#seance_id').val('');
            if (classeId) {
                $('.seance-option.classe-' + classeId).show();
            }

            // AJAX call for students
            if (!classeId) {
                $('#students_container').addClass('d-none');
                return;
            }

            $('#loading_spinner').removeClass('d-none');
            $('#students_container').addClass('d-none');

            $.ajax({
                url: `/classes/${classeId}/students`,
                method: 'GET',
                success: function(students) {
                    let html = '';
                    students.forEach((student, index) => {
                        html += `
                            <tr>
                                <td>
                                    <input type="hidden" name="absences[${index}][etudiant_id]" value="${student.id}">
                                    ${student.prenom} ${student.nom}
                                </td>
                                <td class="text-center">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="present_${student.id}" name="absences[${index}][type]" value="present" checked>
                                        <label for="present_${student.id}" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="absent_${student.id}" name="absences[${index}][type]" value="absence">
                                        <label for="absent_${student.id}" class="custom-control-label text-danger"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="retard_${student.id}" name="absences[${index}][type]" value="retard">
                                        <label for="retard_${student.id}" class="custom-control-label text-warning"></label>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                    $('#students_list').html(html);
                    $('#loading_spinner').addClass('d-none');
                    $('#students_container').removeClass('d-none');
                }
            });
        });
    });
</script>
@endpush

@section('css')
    <style>
        .card { border-radius: 20px; }
        .form-control:focus { box-shadow: 0 0 0 0.2rem rgba(0,123,255,.1) !important; background-color: #fff !important; }
        .select2-container--default .select2-selection--single { border-radius: 10px !important; border: none !important; background-color: #f8f9fa !important; height: calc(2.25rem + 2px) !important; }
    </style>
@stop
