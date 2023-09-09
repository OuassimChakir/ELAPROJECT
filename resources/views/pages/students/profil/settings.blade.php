<div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
    <div class="tab-pane-content mt-5">
        <form action="{{ route('student.update', ['idStudent' => $student->idStudent]) }}" method="post">
            <input type="hidden" value="{{ $student->matricule }}" name="matricule">
            @csrf
            @method('put')
            <div class="modal-body px-4">
                <div class="row mb-2 g-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="firstName">Prénom</label>
                            <input type="text" class="form-control" name="prenom_fr" id="firstName"
                                value="{{ $student->prenom_fr }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6" dir="rtl">
                        <div class="form-group">
                            <label for="firstName_ar" lang="ar">الإسم الشخصي</label>
                            <input type="text" class="form-control keyboardInput" lang="ar" name="prenom_ar"
                                id="firstName_ar" value="{{ $student->prenom_ar }}" dir="rtl" required>
                        </div>
                    </div>
                    <!-- les nom arabe et françe-->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="lastName">Nom</label>
                            <input type="text" class="form-control" name="nom_fr" id="lastName"
                                value="{{ $student->nom_fr }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6" dir="rtl">
                        <div class="form-group">
                            <label for="lastName_ar" lang="ar">الإسم العائلي</label>
                            <input type="text" class="form-control keyboardInput" lang="ar" name="nom_ar"
                                id="lastName_ar" dir="rtl" value="{{ $student->nom_ar }}" required>
                        </div>
                    </div>
                    <!-- Numéro de Téléphone-->
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="numTel">Numéro de Téléphone</label>
                            <input type="tel" class="form-control" name="numTel" id="numTel"
                                value="{{ $student->numTel }}" required>
                        </div>
                    </div>
                    <!-- date Naissance-->
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="date">date Naissance</label>
                            <input type="date" class="form-control" name="dateNaissance" id="date"
                                value="{{ $student->dateNaissance }}">
                        </div>
                    </div>
                    <!-- numéro de carte d'identifion-->
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="cnie">CNIE</label>
                            <input type="text" class="form-control" name="cnie" id="cnie"
                                value="{{ $student->cnie }}" required>
                        </div>
                    </div>
                    <!-- adresse-->
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" name="adresse" id="adresse"
                                value="{{ $student->adresse }}">
                        </div>
                    </div>
                    <!-- sexe -->
                    <div class="col-lg-12">
                        <div class="form-group mb-2">
                            <label>Sexe</label>
                            <div class="col-6 d-flex align-items-center justify-content-between">
                                @if ($student->sexe == 'Homme')
                                    <div class="form-check">
                                        <input class="form-check-input" value="Homme" type="radio" name="sexe"
                                            id="sexe1" checked>
                                        <label class="form-check-label" for="sexe1">Homme</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="Femme" type="radio" name="sexe"
                                            id="sexe2">
                                        <label class="form-check-label" for="sexe2">Femme</label>
                                    </div>
                                @else
                                    <div class="form-check">
                                        <input class="form-check-input" value="Homme" type="radio" name="sexe"
                                            id="sexe1">
                                        <label class="form-check-label" for="sexe1">Homme</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="Femme" type="radio" name="sexe"
                                            id="sexe2" checked>
                                        <label class="form-check-label" for="sexe2">Femme</label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4">
                <a href="{{ route('student.delete', ['idStudent' => $student->idStudent]) }}">
                    <button type="button" class="btn btn-outline-danger btn-pill"
                        onclick="return confirm('Vous êtes sûr?');">Supprimer le Compte</button>
                </a>
                <button type="submit" name="updateStudent" class="btn btn-warning btn-pill">Mise à jour</button>
            </div>
        </form>
    </div>
</div>