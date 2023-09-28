@extends('layouts.layout')
@section('title')
    {{ $group->designation }}
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ $group->designation }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span><a href="{{ route('groups') }}">Groupes</a>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ $group->designation }}
            </p>
        </div>
        @staff
        <div>
            <a href="{{route('group.incomes',['idGroup' => $group->idGroup, 'datePayment' => 'all'])}}" target="_blank">
                <button type="button" class="btn btn-primary">
                    Revenus
                </button>
            </a>
            <button type="button" class="deleteGroup btn btn-outline-danger" name="delete" value="{{$group->idGroup}}">
                <i class="bi bi-trash-fill"></i> Supprimer
            </button>
        </div>
        @endstaff
    </div>


    <div class="card bg-white profile-content">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="profile-content-right profile-right-spacing py-5">
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                        {{-- Informations --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile"
                                aria-selected="true">Informations</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="emploi-tab" data-bs-toggle="tab" data-bs-target="#emploi"
                                type="button" role="tab" aria-controls="emploi"
                                aria-selected="false">Emploi du Temps</button>
                        </li>
                        @staff
                        {{-- Paramètres --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings"
                                type="button" role="tab" aria-controls="settings"
                                aria-selected="false">Paramètres</button>
                        </li>
                        @endstaff
                        @teacher
                        {{-- Absence --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="markAttendance-tab" data-bs-toggle="tab"
                                data-bs-target="#markAttendance" type="button" role="tab" aria-controls="markAttendance"
                                aria-selected="false">Marquer l'Absence</button>
                        </li>
                        @endteacher
                        @staff
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance"
                                type="button" role="tab" aria-controls="attendance"
                                aria-selected="false">Paramètres d'Absence</button>
                        </li>
                        @endstaff
                        
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                        {{-- Informations --}}
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="tab-widget mt-5">
                                <div class="row">
                                @teacher
                                        <div class="col-xl-4">
                                            <div class="media widget-media p-3 bg-white border">
                                                <div class="icon rounded-circle mr-3 bg-primary">
                                                    <i class="bi bi-collection-fill text-white"></i>
                                                </div>

                                                <div class="media-body align-self-center">
                                                    <h4 class="text-primary mb-2">{{ $group->designation }}</h4>
                                                    <p>Designation</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="media widget-media p-3 bg-white border">
                                                <div class="icon rounded-circle bg-warning mr-3">
                                                    <i class="bi bi-person-video3 text-white"></i>
                                                </div>

                                                <div class="media-body align-self-center">
                                                    <h4 class="text-primary mb-2">
                                                        @if (is_null($group->idProfesseur))
                                                            Non Assigné
                                                        @else
                                                        <a href="{{ route('teachers.profil', ['idProfesseur' => $group->idProfesseur]) }}">
                                                            {{ $group->prenom . ' ' . $group->nom }}
                                                        </a> 
                                                        @endif
                                                    </h4>
                                                    <p>Encadrant</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="media widget-media p-3 bg-white border">
                                                <div class="icon rounded-circle mr-3 bg-success">
                                                    <i class="bi bi-people-fill text-white"></i>
                                                </div>

                                                <div class="media-body align-self-center">
                                                    <h4 class="text-primary mb-2">
                                                        {{ $group->nbElements }}/{{ $group->capacity }}</h4>
                                                    <p>Capacité</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                        <div class="col-xl-6">
                                            <div class="media widget-media p-3 bg-white border">
                                                <div class="icon rounded-circle mr-3 bg-primary">
                                                    <i class="bi bi-collection-fill text-white"></i>
                                                </div>

                                                <div class="media-body align-self-center">
                                                    <h4 class="text-primary mb-2">{{ $group->designation }}</h4>
                                                    <p>Designation</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="media widget-media p-3 bg-white border">
                                                <div class="icon rounded-circle bg-warning mr-3">
                                                    <i class="bi bi-person-video3 text-white"></i>
                                                </div>

                                                <div class="media-body align-self-center">
                                                    <h4 class="text-primary mb-2">
                                                        @if (is_null($group->idProfesseur))
                                                            Non Assigné
                                                        @else
                                                        <a href="{{ route('teachers.profil', ['idProfesseur' => $group->idProfesseur]) }}">
                                                            {{ $group->prenom . ' ' . $group->nom }}
                                                        </a> 
                                                        @endif
                                                    </h4>
                                                    <p>Encadrant</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endteacher

                                <div class="row">
                                    @admin
                                    <div class="col-xl-4">
                                        <div class="media widget-media p-3 bg-white border">
                                            <div class="icon rounded-circle mr-3 text-white bg-dark">
                                                <i class="bi bi-book-fill text-white"></i>
                                            </div>

                                            <div class="media-body align-self-center">
                                                <h4 class="text-primary mb-2">{{ $group->short }}</h4>
                                                <p>Matière</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-4">
                                        <div class="media widget-media p-3 bg-white border">
                                            <div class="icon rounded-circle mr-3 bg-success">
                                                <i class="bi bi-calendar-date text-white"></i>
                                            </div>

                                            <div class="media-body align-self-center">
                                                <h4 class="text-primary mb-2">{{ date_format(date_create($group->created_at), 'd-m-Y') }}</h4>
                                                <p>Année de Creation</p>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-xl-6">
                                        <div class="media widget-media p-3 bg-white border">
                                            <div class="icon rounded-circle mr-3 text-white bg-dark">
                                                <i class="bi bi-book-fill text-white"></i>
                                            </div>

                                            <div class="media-body align-self-center">
                                                <h4 class="text-primary mb-2">{{ $group->short }}</h4>
                                                <p>Matière</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-6">
                                        <div class="media widget-media p-3 bg-white border">
                                            <div class="icon rounded-circle mr-3 bg-success">
                                                <i class="bi bi-calendar-date text-white"></i>
                                            </div>

                                            <div class="media-body align-self-center">
                                                <h4 class="text-primary mb-2">{{ date_format(date_create($group->created_at), 'd-m-Y') }}</h4>
                                                <p>Année de Creation</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endadmin
                                </div>

                                <div class="col-xl-12">
                                    <div class="media widget-media p-3 bg-white border">
                                        <div class="icon rounded-circle bg-purple mr-3">
                                            <i class="bi bi-list-ol text-white"></i>
                                        </div>

                                        <div class="media-body align-self-center">
                                            <h4 class="text-primary mb-2">Niveaux</h4>
                                            <p>
                                                @foreach ($groupGrades as $grade)
                                                    <span class="badge badge-primary">{{ $grade->grade }}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @staff
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="tab-pane-content mt-5">
                                            <form action="{{ route('classroom.multipleCancel') }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="table-responsive">
                                                    <table id="responsive-data-table" class="table">
                                                        <thead>
                                                            <tr>
                                                                @if ($students->count() != 0)
                                                                    <th>
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="selectAllArchived">
                                                                    </th>
                                                                @endif
                                                                <th>#</th>
                                                                <th>Nom</th>
                                                                <th>Téléphone</th>
                                                                <th>Rejoint le</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($students as $student)
                                                                <tr>
                                                                    <td>
                                                                        <input type="checkbox" name="students[]" value="{{ $student->idElement }}" class="form-check-input archivedStudents">
                                                                    </td>
                                                                    <td>
                                                                        {{ $student->matricule }}
                                                                        @if ($student->pendingPaiment == 0)
                                                                            <span class="badge badge-success"><i class="bi bi-check-lg"></i></span>
                                                                        @else
                                                                            <span class="badge badge-danger">{{ $student->pendingPaiment }} <i class="bi bi-hourglass"></i></span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a
                                                                            href="{{ route('student.profil', ['idStudent' => $student->idStudent]) }}">
                                                                            {{$student->prenom_fr}} {{$student->nom_fr}} - {{$student->prenom_ar}} {{$student->nom_ar}}
                                                                        </a>
                                                                        @if ($student->sexe == 'Homme')
                                                                            <span class="badge badge-pill badge-info">M</span>
                                                                        @else
                                                                            <span
                                                                                class="badge badge-pill badge-purple">F</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $student->numTel }}</td>
                                                                    <td>{{ $student->dateAjout }}</td>
                                                                    <td>
                                                                        <div class="btn-group-spaced">
                                                                            <button type="button" class="addNote btn btn-outline-primary" value="{{$student->idElement}}">
                                                                                <i class="bi bi-info"></i>
                                                                            </button>
                                                                            <button type="button" class="btn btn-outline-danger" onclick="cancelAssignment({{$student->idElement}});">
                                                                                <i class="bi bi-trash-fill"></i>
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="col btns">
                                                        <button type="submit" name="deleteAll"
                                                            class="btn btn-outline-danger"
                                                            onclick="return confirm('Voulez-vous supprimer définitivement ces Professeurs?');"
                                                            value="{{ $group->idGroup }}">
                                                            <i class="bi bi-trash-fill"></i> Supprimer la Sélection
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endstaff
                                @onlyteacher
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="tab-pane-content mt-5">
                                            <div class="table-responsive">
                                                <table id="responsive-data-table" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nom</th>
                                                            <th>Rejoint le</th>
                                                        </tr>
                                                    </thead>
        
                                                    <tbody>
                                                        @foreach ($students as $student)
                                                            <tr>
                                                                <td>
                                                                    {{ $student->matricule }}
                                                                </td>
                                                                <td>
                                                                    {{$student->prenom_fr}} {{$student->nom_fr}} - {{$student->prenom_ar}} {{$student->nom_ar}}
                                                                    @if ($student->sexe == 'Homme')
                                                                        <span class="badge badge-pill badge-info">M</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-pill badge-purple">F</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $student->dateAjout }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endonlyteacher
                            </div>
                        </div>

                        @staff
                        {{-- Parametres --}}
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                            <div class="tab-pane-content mt-5">
                                <form action="{{ route('groups.update', ['idGroup' => $group->idGroup]) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="modal-header px-4">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Créer un Groupe</h5>
                                    </div>

                                    <div class="modal-body px-4">
                                        <div class="row mb-2">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="capacity">Capacité du Groupe</label>
                                                    <input type="number" max="50" min="1"
                                                        class="form-control" name="capacity"
                                                        value="{{ $group->capacity }}" id="capacity" required>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="capacity">Prix Individuel</label>
                                                    <input type="number" min="1" class="form-control"
                                                        name="amount" id="amount" value="{{ $group->amount }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="debutFormation">Début de formation</label>
                                                    <input type="date" class="form-control" name="debutFormation" id="debutFormation" value='{{$group->debutFormation}}' required>
                                                </div>
                                            </div>
                    
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="finFormation">Fin de formation</label>
                                                    <input type="date" class="form-control" name="finFormation" id="finFormation" value="{{$group->finFormation}}" required>
                                                </div>
                                            </div>

                                            {{-- Staff --}}
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label for="form-label">Professeur Assigné</label>
                                                    <select name="idProfesseur" id="idProfesseur" class="form-select"
                                                        required>
                                                        <option disabled selected>-- Choisir un Professeur --</option>
                                                        @foreach ($professeurs as $professeur)
                                                            @if ($group->idProfesseur == $professeur->idProfesseur)
                                                                <option value="{{ $professeur->idProfesseur }}" selected>
                                                                @else
                                                                <option value="{{ $professeur->idProfesseur }}">
                                                            @endif
                                                            {{ $professeur->prenom . ' ' . $professeur->nom }} |
                                                            {{ $professeur->libelle }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- Matières --}}
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label for="form-label">Matières</label>
                                                    <select name="idSubject" id="id-Subject" class="form-select"
                                                        required>
                                                        <option disabled selected>-- Choisir une Matière --</option>
                                                        @foreach ($courseTypes as $courseType)
                                                            <optgroup label="{{ $courseType->course }}">
                                                                @foreach ($subjects as $subject)
                                                                    @if ($courseType->idCourseType == $subject->idCourseType)
                                                                        @if ($group->idSubject == $subject->idSubject)
                                                                            <option value="{{ $subject->idSubject }}"
                                                                                selected>
                                                                            @else
                                                                            <option value="{{ $subject->idSubject }}">
                                                                        @endif
                                                                        {{ $subject->libelle }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- Grade Category --}}
                                            <div class="col-lg-12">
                                                <div class="form-group mb-4">
                                                    <label for="form-label">Catégories des Niveaux</label>
                                                    <select name="gradeCategory" id="gradeCategory" class="form-select"
                                                        required>
                                                        <option disabled selected>-- Choisir une Catégorie -- </option>
                                                        @php
                                                            if (isset($groupGrades[0])) {
                                                                $idGradeCategory = $groupGrades[0]->idGradeCategory;
                                                            }
                                                        @endphp
                                                        @foreach ($gradesCategories as $categorie)
                                                            @if (isset($idGradeCategory) && $categorie->idGradeCategory == $idGradeCategory)
                                                                <option value="{{ $categorie->idGradeCategory }}"
                                                                    selected>
                                                                @else
                                                                <option value="{{ $categorie->idGradeCategory }}">
                                                            @endif
                                                            {{ $categorie->category }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="card p-2 mt-2">
                                                    <div class="card-title pl-3 pt-3">
                                                        <h5>Niveaux</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-bordered" id="gradesGenerationTable">
                                                            <tbody id="grades">
                                                                @if (isset($groupGrades[0]))
                                                                    <tr>
                                                                        @for ($i = 1; $i <= count($grades); $i++)
                                                                            <div>
                                                                                <td class="align-middle checkCol">
                                                                                    @php
                                                                                        foreach ($groupGrades as $item) {
                                                                                            if ($item->idGrade == $grades[$i - 1]->idGrade) {
                                                                                                $flag = true;
                                                                                                break;
                                                                                            } else {
                                                                                                $flag = false;
                                                                                            }
                                                                                        }
                                                                                    @endphp
                                                                                    @if ($flag)
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input form-control"
                                                                                            id="grade{{ $i }}"
                                                                                            name="grades[]"
                                                                                            value="{{ $grades[$i - 1]->idGrade }}"
                                                                                            checked>
                                                                                    @else
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input form-control"
                                                                                            id="grade{{ $i }}"
                                                                                            name="grades[]"
                                                                                            value="{{ $grades[$i - 1]->idGrade }}">
                                                                                    @endif
                                                                                </td>
                                                                                <td class="infoCol">
                                                                                    <label for="grade{{ $i }}">
                                                                                        {{ $grades[$i - 1]->grade }}
                                                                                    </label>
                                                                                </td>
                                                                            </div>
                                                                            @if ($i == count($grades))
                                                                    </tr>
                                                                @elseif($i % 3 == 0)
                                                                    </tr>
                                                                    <tr>
                                                                @endif
                                                                @endfor
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="modal-footer px-4">
                                        <button type="button" class="btn btn-secondary btn-pill"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="updateGroup"
                                            class="btn btn-warning btn-pill">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endstaff
                        @teacher
                        {{-- Attendance --}}
                        <div class="tab-pane fade" id="markAttendance" role="tabpanel" aria-labelledby="markAttendance-tab">
                            <div class="tab-pane-content">
                                <div class="card p-4 mb-4">
                                    <h3 class="card-title">Afficher d'absences</h3>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <form method="POST" action="{{ route('getAttendance') }}" target="_blank">
                                                @csrf
                                                @method('post')
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <input type="month" name="dateAbsence" class="form-control" value="{{ date('Y-m') }}">
                                                        <input type="hidden" name="idGroup" value="{{$group->idGroup}}">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="submit" name="getAttendance" class="btn btn-primary btn-pill form-control">Recherche</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card p-4">
                                    <h3 class="card-title">Marquer l'Absence</h3>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('absence.add', ['idGroup' => $group->idGroup]) }}">
                                            <div class="table-responsive">
                                                <table id="responsive-data-table" class="table">
                                                    <div class="col-3 input-group-date">
                                                    @csrf
                                                    @method('post')
                                                    <input type="date" name="dateAbsence" class="form-control" value="{{ date('Y-m-d') }}">
                                                    </div>
                                                    <thead>
                                                        <tr>
                                                            @if ($students->count() != 0)
                                                                <th>
                                                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                                                </th>
                                                            @endif
                                                            <th>#</th>
                                                            <th>Nom</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($students as $student)
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" class="form-check-input students">
                                                                </td>
                                                                <td>
                                                                    {{ $student->matricule }}
                                                                    <input type="hidden" name="students[]" class="form-control"
                                                                        value="{{ $student->idStudent }}">
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('student.profil', ['idStudent' => $student->idStudent]) }}">
                                                                        {{$student->prenom_fr}} {{$student->nom_fr}} - {{$student->prenom_ar}} {{$student->nom_ar}}
                                                                    </a>
                                                                    @if ($student->sexe == 'Homme')
                                                                        <span class="badge badge-pill badge-info">M</span>
                                                                    @else
                                                                        <span class="badge badge-pill badge-purple">F</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <select name="absence[]" id="id-Subject"
                                                                        class="absenceState form-select form-control" required>
                                                                        <option value="0">
                                                                            Présent
                                                                        </option>
                                                                        <option value="1">
                                                                            Absent
                                                                        </option>
                                                                        <option value="2">
                                                                            Justifié
                                                                        </option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button type="submit" name="markAttendance" class="btn btn-primary btn-pill">Marquée L'absence</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endteacher
                        @staff
                        {{-- Attendance Settings --}}
                        <div class="tab-pane fade" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                            <div class="tab-pane-content mt-5">
                                <div class="card p-4 mb-2">
                                    <div class="card-body">
                                        <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <input type="month" name="dateAbsence" id="absenceDateInput" class="form-control" value="{{ date('Y-m') }}" required>
                                                        <input type="hidden" name="idGroup" value="{{$group->idGroup}}">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select name="idAttendance" class="form-control" id="attendanceSelect" required disabled>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button id="getAttendanceButton" class="btn btn-primary btn-pill form-control" disabled>Recherche</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card p-4" id="updateAttendanceSection">
                                    <h3 class="card-title">Gérer l'Absence</h3>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('attendance.update') }}">
                                            <div class="table-responsive">
                                                <table id="responsive-data-table" class="table">
                                                    <div class="col-3 input-group-date">
                                                    @csrf
                                                    @method('post')
                                                    <input type="date" name="dateAbsence" id="updatedDateAbsence" class="form-control" value="{{ date('Y-m-d') }}">
                                                    <input type="hidden" name="idGroup" value="{{$group->idGroup}}">
                                                    <input type="hidden" name="deletionDateAbsence" id="deletionDateAbsence">
                                                    </div>
                                                    <thead>
                                                        <tr>
                                                            @if ($students->count() != 0)
                                                                <th>
                                                                    <input type="checkbox" class="form-check-input" id="selectAllUpdated">
                                                                </th>
                                                            @endif
                                                            <th>#</th>
                                                            <th>Nom</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="updateAttendanceStudents">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button type="submit" name="updateAttendance" id="updateAttendanceBtn" class="btn btn-warning btn-pill" disabled>Modifier L'absence</button>
                                            <button type="submit" name="deleteAttendance" id="deleteAttendanceBtn" class="btn btn-outline-danger btn-pill" formaction="{{route('attendance.delete')}}" onclick="return confirm('ATTENTION: Vous êtes sur le point de supprimer cette présence!!');" disabled>Supprimer L'absence</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endstaff

                        {{-- Emploi du Temps --}}
                        @include('pages.groupes.sections.emploi')
                    </div>
                </div>
            </div>
        </div>

        @include('pages.students.add2Group')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('JS/sweetAlert.js') }}"></script>
        @if (!isset($groupGrades[0]))
            <script>
                $("#gradesGenerationTable").hide();
            </script>
        @endif
        <script type='text/javascript'>
            $(document).ready(function() {

                // Department Change
                $('#gradeCategory').change(function() {

                    // Department id
                    var id = $(this).val();
                    // Empty the dropdown
                    $('#grades').empty();

                    // AJAX request 
                    $.ajax({
                        url: '/groupes/get/' + id,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            var len = 0;
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }

                            if (len > 0) {
                                // Read data and create  html
                                var html = '<tr>';
                                for (var i = 1; i <= len; i++) {
                                    var id = response['data'][i - 1].idGrade;
                                    var grade = response['data'][i - 1].grade;
                                    html +=
                                        '<div> <td class="align-middle checkCol"> <input type="checkbox" class="form-check-input form-control" id="grade' +
                                        i + '" name="grades[]" value="' +
                                        id + '"> </td> <td class="infoCol"><label for="grade' + i +
                                        '">' + grade +
                                        '</label></td> </div>';
                                    if (i == len)
                                        html += '</tr>';
                                    else if (i % 3 == 0)
                                        html += '</tr><tr>';
                                }
                                $("#grades").append(html);
                            }
                            $("#gradesGenerationTable").show();

                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                });
            });
        </script>
        <script type='text/javascript'>
            $(document).ready(function() {
                $('#cancelBtn').on('click',function() {
                    location.reload(true);
                });
            });
            $('#selectAllArchived').on('click',function(event) {
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
            $('#selectAll').on('click',function(event) {
                if (this.checked) {
                    // Iterate each checkbox
                    $('.students').each(function() {
                        this.checked = true;
                        $(this).closest('tr').find('.absenceState option:first-child').prop('selected', false);
                        $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected', true);
                    });
                } else {
                    $('.students').each(function() {
                        this.checked = false;
                        $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected', false);
                        $(this).closest('tr').find('.absenceState option:first-child').prop('selected', true);
                    });
                }
            });
            $(document).ready(function() {
                $('.students').on('click',function(event) {
                    if (this.checked) {
                        // Iterate each checkbox
                        $(this).closest('tr').find('.absenceState option:first-child').prop('selected', false);
                        $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected', true);
                    } else {
                        $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected', false);
                        $(this).closest('tr').find('.absenceState option:first-child').prop('selected', true);
                    }
                });
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
            function cancelAssignment(idElement){
                var id = idElement;
                Swal.fire({
                    title: "Voulez-vous retirer cet étudiant de ce groupe ?",
                    showCancelButton: true,
                    confirmButtonText: 'Oui',
                    cancelButtonText: `Annuler`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/classrooms/remove/"+id;
                    }
                })
            }

        </script>

        {{-- Script: Generation of Select with available date of attendance --}}
        <script>
            $(document).ready(function(){
                $('#absenceDateInput').on('change',function(){
                    var dateAbsence = $(this).val();
                    var idGroup = '{{$group->idGroup}}';
                    $('#attendanceSelect').empty();
                    $('#attendanceSelect').prop('disabled',false);
                     // AJAX request 
                    $.ajax({
                        url: '/attendance/' + idGroup + '/' + dateAbsence,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            var len = response.length;
                            if (len > 0) {
                                // Read data and create  html
                                var html = '';
                                for (var i = 0; i < len; i++) {
                                    html = '<option value=' + response[i].dateAbsence + '>' + response[i].dateAbsence + '</option>';
                                    $("#attendanceSelect").append(html);
                                }
                                $('#getAttendanceButton').prop('disabled',false);
                            }else{
                                $('#attendanceSelect').prop('disabled',true);
                                $('#getAttendanceButton').prop('disabled',true);
                            }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                });
            });
        </script>

        {{-- Script: Getting Attendance Data --}}
        <script>
            $(document).ready(function(){
                $('#getAttendanceButton').on('click',function(){
                    var dateAbsence = $('#attendanceSelect').val();
                    var idGroup = '{{$group->idGroup}}';
                    $('#updateAttendanceStudents').empty();
                     // AJAX request 
                    $.ajax({
                        url: '/attendance/update/' + idGroup + '-' + dateAbsence,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            var len = response.length;
                            if (len > 0) {
                                $('#updatedDateAbsence').val(dateAbsence);
                                $('#deletionDateAbsence').val(dateAbsence);
                                // Read data and create  html
                                var html = '';
                                for (var i = 0; i < len; i++) {
                                    html = '<tr>';
                                    html += '<td> <input type="checkbox" class="form-check-input updatedAttendanceStudents" '+((response[i].absence == 1) ? 'checked' : '') + '/> </td>'
                                    html += '<td> ' + response[i].matricule + '<input type="hidden" name="attendances[]" class="form-control" value="' + response[i].idAttendance + '" /> </td>';

                                    html += '<td> <a href="/student/'+response[i].idStudent+'" > '+response[i].prenom_fr+' '+response[i].nom_fr+' - '+response[i].prenom_ar+' '+response[i].nom_ar+'</a> '+((response[i].sexe == 'Homme') ? '<span class="badge badge-pill badge-info">M</span>' : '<span class="badge badge-pill badge-purple">F</span>')+' </td>';
                                    html += '<td> <select name="absence[]" id="id-Subject" class="updatedAbsenceState form-select form-control" required >';
                                    html += '<option value="0" '+((response[i].absence == 0) ? 'selected' : '')+'>Présent</option>';
                                    html += '<option value="1" '+((response[i].absence == 1) ? 'selected' : '')+'>Absent</option>';
                                    html += '<option value="2" '+((response[i].absence == 2) ? 'selected' : '')+'>Justifié</option></select></td></tr>';
                                    $("#updateAttendanceStudents").append(html);
                                }
                                $('#updateAttendanceBtn').prop('disabled',false);
                                $('#deleteAttendanceBtn').prop('disabled',false);
                                $('html, body').animate({
                                    scrollTop: $("#updateAttendanceSection").offset().top
                                }, 0);
                            }else{
                                $('#updateAttendanceBtn').prop('disabled',true);
                                $('#deleteAttendanceBtn').prop('disabled',true);
                            }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                });
            });
        </script>
        
        <script>
            $(document).on('click','#selectAllUpdated',function() {
                if (this.checked) {
                    // Iterate each checkbox
                    $('.updatedAttendanceStudents').each(function() {
                        this.checked = true;
                        $(this).closest('tr').find('.updatedAbsenceState option:first-child').prop('selected', false);
                        $(this).closest('tr').find('.updatedAbsenceState option:nth-child(2)').prop('selected', true);
                    });
                } else {
                    $('.updatedAttendanceStudents').each(function() {
                        this.checked = false;
                        $(this).closest('tr').find('.updatedAbsenceState option:nth-child(2)').prop('selected', false);
                        $(this).closest('tr').find('.updatedAbsenceState option:first-child').prop('selected', true);
                    });
                }
            });
            $(document).on('click','.updatedAttendanceStudents',function() {
                if (this.checked) {
                    // Iterate each checkbox
                    $(this).closest('tr').find('.updatedAbsenceState option:first-child').prop('selected', false);
                    $(this).closest('tr').find('.updatedAbsenceState option:nth-child(2)').prop('selected', true);
                } else {
                    $(this).closest('tr').find('.updatedAbsenceState option:nth-child(2)').prop('selected', false);
                    $(this).closest('tr').find('.updatedAbsenceState option:first-child').prop('selected', true);
                }
            });
        </script>


        {{-- Add Note --}}
        <script>
            $(document).on('click','.addNote',function(){

                let idElement = $(this).val();
                Swal.fire({
                    input: 'textarea',
                    inputLabel: 'Message',
                    inputPlaceholder: 'Type your message here...',
                    inputAttributes: {
                        'aria-label': 'Type your message here'
                    },
                    showCancelButton: true
                }).then(function(value) {
                    if(value.isConfirmed){
                        let note = value.value;
                        // AJAX request 
                        $.ajax({
                            type:'POST',
                            url:"{{ route('notes.add') }}",
                            data:{"note" : note, "idElement" : idElement, "_token" : "{{ csrf_token() }}"},
                            success: function(response) {
                                if(response == 'true')
                                    Swal.fire('Note Ajoutée!', '', 'success')
                                else
                                    Swal.fire('problème rencontré ! Réessayez !', '', 'warning')

                            },
                            error: function(request, status, error) {
                                console.log(request.responseText);
                            }
                        });
                    }
                });

            })
        </script>


        {{-- Group Emploi --}}
        <script>
            $(document).ready(function() {
                var maxField = 10; //Input fields increment limitation
                var addInput = $('.addInput'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML = '<div class="row">'; //New input field html 
                fieldHTML += '<div class="col-lg-4"> <div class="form-group"> <input id="jour" name="jour[]" class="form-control" type="text" required> </div> </div>';
                fieldHTML += '<div class="col-lg-3"> <div class="form-group"> <input id="debut" name="debut[]" class="form-control" type="time" required> </div> </div>';
                fieldHTML += '<div class="col-lg-3"> <div class="form-group"> <input id="fin" name="fin[]" class="form-control" type="time" required> </div> </div>';
                fieldHTML += '<div class="col-lg-2"> <button type="button" class="btn btn-danger removeInput"><i class="bi bi-trash"></i></button> </div>';
                fieldHTML += '</div>';
                var x = 1; //Initial field counter is 1
                //Once add button is clicked
                $(addInput).click(function() {
                    //Check maximum number of input fields
                    if (x < maxField) {
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); //Add field html
                    }
                });
            
                //Once remove button is clicked
                $(wrapper).on('click', '.removeInput', function(e) {
                    e.preventDefault();
                    $(this).parentsUntil('.field_wrapper').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });

            $('#updateEmploi').hide();
            $('#showEmploiButton').hide();
            $(document).on('click','#updateEmploiButton', function(e){
                e.preventDefault();
                $('#showEmploi').hide();
                $('#showEmploiButton').show();

                $('#updateEmploiButton').hide();
                $('#updateEmploi').show();
            });
            $(document).on('click','#showEmploiButton', function(e){
                e.preventDefault();
                $('#showEmploi').show();
                $('#showEmploiButton').hide();

                $('#updateEmploiButton').show();
                $('#updateEmploi').hide();
            });
        </script>

        {{-- Delete Group --}}
        <script>
            $(document).on('click','.deleteGroup',function(){
                let id = $(this).val();
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmez votre demande !',
                    text: 'Vous êtes sur le point de supprimer ce groupe.',
                    showCancelButton: true,
                    confirmButtonText: 'Oui',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/groupes/delete/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response){
                                if(response == true){
                                    window.location.href = "{{route('groups')}}";
                                }else{
                                    Swal.fire("Vous ne pouvez pas supprimer ce groupe", "Veuillez vérifier s'il y a des Paiements Impayés pour ce Group.", 'error')
                                }
                            },
                            error: function(request, status, error) {
                                console.log(request.responseText);
                            }
                            
                        });
                    }
                })
            });
        </script>
    @endsection