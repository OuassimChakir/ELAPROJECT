<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('absence.update',['idAttendance' => $etudiants->idAttendance])}}" method="put">
                @csrf
                @method('put')
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un Staff</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                                <div class="form-group">
                                <label for="form-label">Date</label>
                                    <input type="date" name="dateAbsence" id="dateabsence" class="form-select" value="{{date('Y-m-d')}}"> 
                                </div>
                            </div>
                        <!-- Etat d'absence -->
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label>Etat d'absence</label>
                                <div class="col-6 d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="absence" id="absence1" checked>
                                    <label class="form-check-label" for="absence1">
                                        Présent
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="absence" id="absence2" >
                                    <label class="form-check-label" for="absence2">
                                        Absent
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="2" type="radio" name="absence" id="absence2" >
                                    <label class="form-check-label" for="absence2">
                                        Justifié
                                    </label>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- hidden -->



                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="modifierAbsence" class="btn btn-primary btn-pill">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>