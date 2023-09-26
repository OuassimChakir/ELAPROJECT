@extends('layouts.layout')
@section('title')
    liste des Etudiants
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Etudiants</h1>
            <p class="breadcrumbs"><span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Etudiants
            </p>
        </div>
        <div>
            <a href="{{ route('student.add.page') }}">
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-plus-square"></i> Ajouter un Etudiant
                </button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <form action="{{ route('student.delete.multiple') }}" method="post">
                        @csrf
                        @method('delete')
                        <table id="responsive-data-table" class="table">
                            <thead>
                                @if ($students->count() != 0)
                                    <th>
                                        <input type="checkbox" class="form-check-input" id="selectAllArchived">
                                    </th>
                                @endif
                                <th>#</th>
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Inscrie</th>
                                <th>Action</th>
                            </thead>
                            @php
                                $i = 0;
                            @endphp
                            <tbody>

                                @if (isset($students[0]->idStudent))
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="students[]"
                                                    value="{{ $student->idStudent }}"class="form-check-input archivedStudents">
                                            </td>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {{ $student->matricule }}
                                                @if ($student->pendingPayment == 0)
                                                    <span class="badge badge-success"><i class="bi bi-check-lg"></i></span>
                                                @else
                                                    <span class="badge badge-danger">{{ $student->pendingPayment }} <i
                                                            class="bi bi-hourglass"></i></span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $student->prenom_ar }}
                                                {{ $student->nom_ar }}
                                                @if ($student->sexe == 'Homme')
                                                    <span class="badge badge-pill badge-info">M</span>
                                                @else
                                                    <span class="badge badge-pill badge-purple">F</span>
                                                @endif
                                            </td>
                                            <td>{{ $student->numTel }}</td>
                                            <td>{{ $student->created_at }}</td>
                                            <td>
                                                <div class="btn-group-spaced">
                                                    <button type="button" class="add2GroupBtn btn btn-outline-success"
                                                        value="{{ $student->idStudent }}" data-bs-toggle="modal"
                                                        data-bs-target="#add2Group" data-toggle="tooltip"
                                                        data-placement="right" title="Ajouter au Groupe">
                                                        <i class="bi bi-plus-lg"></i>
                                                    </button>

                                                    <a
                                                        href="{{ route('student.profil', ['idStudent' => $student->idStudent]) }}">
                                                        <button type="button" name="show" class="btn btn-outline-info"
                                                            value="{{ $student->idStudent }}">
                                                            <i class="bi bi-person-fill"></i>
                                                        </button>
                                                    </a>
                                                    <a
                                                        href="{{ route('student.delete', ['idStudent' => $student->idStudent]) }}">
                                                        <button type="button" class="btn btn-outline-danger" name="delete"
                                                            value="{{ $student->idStudent }}"
                                                            onclick="return confirm('Voulez-vous supprimer définitivement ce Etudiant?');">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col btns">
                                <button type="submit" name="deleteAll" class="btn btn-outline-danger"
                                    onclick="return confirm('Voulez-vous supprimer définitivement ces Etudiants?');">
                                    <i class="bi bi-trash-fill"></i> Supprimer Tous
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Ajouter au Groupe --}}
    @include('pages.students.add2Group')
    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script src="{{ asset('JS/sweetAlert.js') }}"></script>
    <script>
        // Listen for click on toggle checkbox
        $('#selectAllArchived').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $(".btns").hide();
        $(":checkbox").click(function() {
            if ($(this).is(":checked")) {
                $(".btns").show();
            } else {
                $(".btns").hide();
            }
        });
    </script>
    <script>
        $('.add2GroupBtn').click(function() {
            $('#idStudent').val($(this).val());
            $('#gradesSelect').find('option').remove();
            $('#groupsResult').find('div').remove();
            $("#subjectSelect").prop('selectedIndex', 0);
        });
    </script>


    @if (session()->has('newStudent'))
        <template id="student-password">
            <swal-title>
                L'étudiant a été ajouté avec succès
            </swal-title>
            <swal-html>
                <table class="table">
                    <tr>
                        <th>Nom d'étudiant</th>
                        <td>{{ ucfirst(session()->get('newStudent')[0]['prenom']) }}
                            {{ ucfirst(session()->get('newStudent')[0]['nom']) }}</td>
                    </tr>
                    <tr>
                        <th>Matricule</th>
                        <td>{{ session()->get('newStudent')[0]['matricule'] }}</td>
                    </tr>
                    <tr>
                        <th>Mot de Passe</th>
                        <td>{{ session()->get('newStudent')[0]['password'] }}</td>
                    </tr>
                </table>
            </swal-html>
            <swal-icon type="success"></swal-icon>
            <swal-button type="confirm">
                Terminer
            </swal-button>
            <swal-param name="allowEscapeKey" value="false" />
            <swal-param name="customClass" value='{ "popup": "my-popup" }' />
            <swal-function-param name="didOpen" value="popup => console.log(popup)" />
        </template>

        <script>
            Swal.fire({
                template: '#student-password',
            });
        </script>
    @endif

@endsection
