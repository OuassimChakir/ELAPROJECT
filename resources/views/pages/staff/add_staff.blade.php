<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('staff.add')}}" method="post">
                @csrf
                @method('post')
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un Staff</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="firstName">Prénom</label>
                                <input type="text" class="form-control" name="prenom" id="firstName" value="John" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lastName">Nom</label>
                                <input type="text" class="form-control" name="nom" id="lastName" value="Deo" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="numTel">Numéro de Téléphone</label>
                                <input type="tel" class="form-control" name="numTel" id="numTel" value="0612345678" required>
                            </div>
                        </div>

                        <!-- sexe -->
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label>Sexe</label>
                                <div class="col-6 d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" value="Homme" type="radio" name="sexe" id="sexe1" checked>
                                    <label class="form-check-label" for="sexe1">
                                    Homme
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="Femme" type="radio" name="sexe" id="sexe2" >
                                    <label class="form-check-label" for="sexe2">
                                    Femme
                                    </label>
                                </div></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="cine">CINE</label>
                                <input type="text" class="form-control" name="cine" id="cine"value="U156" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="form-label">Spécialité</label>
                                <select name="idStaffType" id="id-stafftype" class="form-select" required>
                                    <option disabled selected>-- Choisir une Spécialité</option>
                                    @foreach( $staffTypes as $type)
                                    
                                        @if ($type->designation != ucfirst("Professeurs"))
                                            <option value="{{ $type->idStaffType }}" >
                                                {{ $type->designation }}
                                            </option>
                                        @endif
                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addStaff" class="btn btn-primary btn-pill">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>