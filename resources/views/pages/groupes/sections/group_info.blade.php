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
                    <div class="icon rounded-circle mr-3 bg-info">
                        <i class="bi bi-cash text-white"></i>
                    </div>

                    <div class="media-body align-self-center">
                        <h4 class="text-primary mb-2">{{ $group->amount*$group->nbElements }} DH</h4>
                        <p>Montant Total</p>
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