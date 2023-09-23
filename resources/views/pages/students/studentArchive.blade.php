@extends('layouts.layout')
@section('title')
    Archive des Etudiants
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Archive des Etudiants</h1>
            <p class="breadcrumbs"><span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Archive des Etudiants
            </p>
        </div>
    </div>
    @if ($students != false)
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-body">
                        <form action="{{ route('student.archive.multiple') }}" method="post">
                            @csrf
                            @method('post')
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
                                   
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="archivedStudents[]"
                                                        value="{{ $student->idStudent }}"class="form-check-input"
                                                        id="selectAllArchived">
                                                </td>
                                                <td>{{ ++$i }}</td>
                                                <td>
                                                    {{ $student->matricule }}
                                                    @if ($student->pendingPayment == 0)
                                                        <span class="badge badge-success"><i
                                                                class="bi bi-check-lg"></i></span>
                                                    @else
                                                        <span class="badge badge-danger">{{ $student->pendingPayment }} <i
                                                                class="bi bi-hourglass"></i></span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $student->prenom_fr }}
                                                    {{ $student->nom_fr }}
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
                                                        <a
                                                            href="{{ route('student.archive.profil', ['idStudent' => $student->idStudent]) }}">
                                                            <button type="button" name="show"
                                                                class="btn btn-outline-info"
                                                                value="{{ $student->idStudent }}">
                                                                <i class="bi bi-person-fill"></i>
                                                            </button>
                                                        </a>
                                                        <a
                                                            href="{{ route('student.archive.restore', ['idStudent' => $student->idStudent]) }}">
                                                            <button type="button" name="show"
                                                                class="btn btn-outline-success"
                                                                value="{{ $student->idStudent }}"
                                                                onclick="return confirm('Vous êtes sûr?');">
                                                                <i class="bi bi-arrow-repeat"></i>
                                                            </button>
                                                        </a>
                                                        <a
                                                            href="{{ route('student.archive.delete', ['idStudent' => $student->idStudent]) }}">
                                                            <button type="button" class="btn btn-outline-danger"
                                                                name="delete" value="{{ $student->idStudent }}"
                                                                onclick="return confirm('Voulez-vous supprimer définitivement ce Etudiant?');">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col btns">
                                    <button type="submit" name="restoreAll" class="btn btn-outline-success"
                                        onclick="return confirm('Vous êtes sûr?');">
                                        <i class="bi bi-arrow-repeat"></i> Restaurer la Sélection
                                    </button>
                                    <button type="submit" name="deleteAll" class="btn btn-outline-danger"
                                        onclick="return confirm('Voulez-vous supprimer définitivement ces étudiants?');">
                                        <i class="bi bi-trash-fill"></i> Supprimer la Sélection
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <script src="{{ asset('JS/jquery.min.js') }}"></script>
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

@endsection
