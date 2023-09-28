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