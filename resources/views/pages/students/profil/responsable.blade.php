<div class="tab-pane fade" id="responsible" role="tabpanel" aria-labelledby="responsible-tab">
    <div class="tab-widget mt-5 p-5">
        <div class="row">
            <div class="ec-cat-form">
                <div class="row">
                    <div class="col-12 responsableButtons">
                        @if (!is_null($student->idResponsible))
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="javascript:void()">
                                        <button type="button"
                                            class="btn btn-warning form-control"
                                            id="showFormButton"><i class="bi bi-pencil"></i></button>
                                    </a>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a
                                        href="{{ route('responsible.delete', ['idStudent' => $student->idStudent, 'idResponsible' => $student->idResponsible]) }}">
                                        <button type="button" class="btn btn-outline-danger"
                                            onclick="return confirm('Vous êtes sûr?');"><i
                                                class="bi bi-trash"></i></button>
                                    </a>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
                @if (is_null($student->idResponsible))
                    <form action="{{ route('responsible.add') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un Responsable</h5>
                        </div>
                        <input type="hidden" name="idStudent" value="{{ $student->idStudent }}">
                        <div class="modal-body px-4">
                            <div class="row mb-2 g-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">Prénom</label>
                                        <input type="text" class="form-control" name="prenom"
                                            id="firstName" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="lastName">Nom</label>
                                        <input type="text" class="form-control" name="nom"
                                            id="lastName" required>
                                    </div>
                                </div>
                                <!-- numéro de carte d'identifion-->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="cnie">CNIE</label>
                                        <input type="text" class="form-control" name="cnie"
                                            id="cnie" required>
                                    </div>
                                </div>
                                <!-- sexe -->
                                <div class="col-lg-6">
                                    <div class="form-group mb-2">
                                        <label>Sexe</label>
                                        <div
                                            class="col-6 d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input" value="Homme"
                                                    type="radio" name="sexe" id="homme">
                                                <label class="form-check-label" for="homme">
                                                    Homme
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="Femme"
                                                    type="radio" name="sexe" id="femme">
                                                <label class="form-check-label" for="femme">
                                                    Femme
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Numéro de Téléphone-->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="numTel">Numéro de Téléphone</label>
                                        <input type="tel" class="form-control" name="numTel"
                                            id="numTel" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer px-4">
                            <button type="submit" name="addReponsible"
                                class="btn btn-primary btn-pill">Ajouter</button>
                            <button type="reset" name="reset"
                                class="btn btn-secondary btn-pill">Reset</button>
                        </div>
                    </form>
                @else
                    <div id="formSection">
                        <form action="{{ route('responsible.update', ['idResponsible' => $student->idResponsible]) }}"
                            method="post">
                            @csrf
                            @method('put')
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Modifier le
                                    Responsable</h5>
                            </div>
                            <div class="modal-body px-4">
                                <div class="row mb-2 g-3">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Prénom</label>
                                            <input type="text" class="form-control"
                                                name="prenom" id="firstName"
                                                value="{{ $student->responsiblePrenom }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Nom</label>
                                            <input type="text" class="form-control"
                                                name="nom" id="lastName"
                                                value="{{ $student->responsibleNom }}" required>
                                        </div>
                                    </div>
                                    <!-- numéro de carte d'identifion-->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cnie">CNIE</label>
                                            <input type="text" class="form-control"
                                                name="cnie" id="cnie"
                                                value="{{ $student->responsibleCnie }}" required>
                                        </div>
                                    </div>
                                    <!-- sexe -->
                                    <div class="col-lg-6">
                                        <div class="form-group mb-2">
                                            <label>Sexe</label>
                                            <div
                                                class="col-6 d-flex align-items-center justify-content-between">
                                                @if ($student->responsibleSexe == 'Homme')
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            value="Homme" type="radio"
                                                            name="sexe" id="homme" checked>
                                                        <label class="form-check-label"
                                                            for="homme">Homme</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            value="Femme" type="radio"
                                                            name="sexe" id="femme">
                                                        <label class="form-check-label"
                                                            for="femme">Femme</label>
                                                    </div>
                                                @else
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            value="Homme" type="radio"
                                                            name="sexe" id="homme">
                                                        <label class="form-check-label"
                                                            for="homme">Homme</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            value="Femme" type="radio"
                                                            name="sexe" id="femme" checked>
                                                        <label class="form-check-label"
                                                            for="femme">Femme</label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Numéro de Téléphone-->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="numTel">Numéro de Téléphone</label>
                                            <input type="tel" class="form-control"
                                                name="numTel" id="numTel"
                                                value="{{ $student->responsibleTel }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer px-4">
                                <button type="submit" name="updateResponsible"
                                    class="btn btn-warning btn-pill">Mettre à Jour</button>
                                <button type="reset" name="reset"
                                    class="btn btn-secondary btn-pill">Reset</button>
                            </div>
                        </form>
                    </div>
                @endif
                <hr>

                @if (!is_null($student->idResponsible))
                    <div class="row">
                        <div class="col-6">
                            <div class="contact-info pt-4">
                                <p class="text-dark font-weight-medium pt-24px mb-2">Nom Complet
                                </p>
                                <p>{{ $student->responsiblePrenom . ' ' . $student->responsibleNom }}
                                </p>
                                <p class="text-dark font-weight-medium pt-24px mb-2">CINE</p>
                                <p>{{ $student->responsibleCnie }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="contact-info pt-4">
                                <p class="text-dark font-weight-medium pt-24px mb-2">Numéro de
                                    Téléphone</p>
                                <p>{{ $student->responsibleTel }}</p>
                                <p class="text-dark font-weight-medium pt-24px mb-2">Sexe</p>
                                <p>{{ $student->responsibleSexe }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>