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
                                            <input type="checkbox" class="form-check-input students" id="{{ $student->matricule }}">
                                        </td>
                                        <td>
                                            <label for="{{ $student->matricule }}">
                                            {{ $student->matricule }}
                                            </label>
                                            <input type="hidden" name="students[]" class="form-control" value="{{ $student->idStudent }}">
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