@extends('layouts.layout')
@section('title')
    liste des Professeurs
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Liste des Professeurs</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Professeurs
            </p>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser"><i
                    class="bi bi-plus-square"></i> Ajouter un Professeur
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <form action="{{ route('teachers.delete.multiple') }}" method="POST">
                        @method('delete')
                        @csrf
                        <div class="table-responsive">
                            <table id="responsive-data-table" class="table">
                                <thead>
                                    <tr>
                                        @if ($teachers->count() != 0)
                                            <th>
                                                <input type="checkbox" class="form-check-input" id="selectAllArchived">
                                            </th>
                                        @endif
                                        <th>Nom</th>
                                        <th>Téléphone</th>
                                        <th>Matière Enseignée</th>
                                        <th>Date d'engagement</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="teachers[]" value="{{ $teacher->idProfesseur }}"
                                                    class="form-check-input archivedStudents">
                                            </td>
                                            <td>
                                                {{ $teacher->prenom }}
                                                {{ $teacher->nom }}
                                                @if ($teacher->sexe == 'M')
                                                    <div class="badge badge-pill badge-info">M</div>
                                                @else
                                                    <div class="badge badge-pill badge-purple">F</div>
                                                @endif
                                            </td>
                                            <td>{{ $teacher->numTel }}</td>
                                            <td>
                                                <div class="badge bg-dark">{{ $teacher->libelle }}</div>
                                            </td>
                                            <td>{{ $teacher->created_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a
                                                        href="{{ route('teachers.profil', ['idProfesseur' => $teacher->idProfesseur]) }}">
                                                        <button type="button" name="edit" class="btn btn-outline-info"
                                                            value="{{ $teacher->idProfesseur }}">
                                                            <i class="bi bi-person-fill"></i>
                                                        </button>
                                                    </a>
                                                    <a
                                                        href="{{ route('teachers.delete', ['idProfesseur' => $teacher->idProfesseur]) }}">
                                                        <button type="button" class="btn btn-outline-danger" name="delete"
                                                            onclick="return confirm('Vous êtes sûr?');">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col btns">
                                <button type="submit" name="deleteAll" class="btn btn-outline-danger"
                                    onclick="return confirm('Voulez-vous supprimer ces Professeurs?');">
                                    <i class="bi bi-trash-fill"></i> Supprimer la Sélection
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Ajouter un teacher -->
    @include('pages.teachers.add_teacher')
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
    @if (session()->has('newProfesseur'))
        <template id="professeur-password">
            <swal-title>
                Professeur a été ajouté avec succès
            </swal-title>
            <swal-html>
                <table class="table">
                    <tr>
                        <th>Nom du Professeur</th>
                        <td>{{ ucfirst(session()->get('newProfesseur')[0]['prenom']) }}
                            {{ ucfirst(session()->get('newProfesseur')[0]['nom']) }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ session()->get('newProfesseur')[0]['username'] }}</td>
                    </tr>
                    <tr>
                        <th>Mot de Passe</th>
                        <td>{{ session()->get('newProfesseur')[0]['password'] }}</td>
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
                template: '#professeur-password',
            });
        </script>
    @endif
@endsection
