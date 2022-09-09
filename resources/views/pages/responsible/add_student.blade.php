<link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css"> 
<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('student.add')}}" method="post">
                @csrf
                @method('post')
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un Etudiant</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2 g-3">                     
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="firstName">Prénom</label>
                                <input type="text" class="form-control" name="prenom_fr" id="firstName" value="Ouassim" required>
                            </div>
                        </div>
                        <div class="col-lg-6" dir="rtl">
                            <div class="form-group">
                                <label for="firstName_ar" lang="ar">الإسم الشخصي</label>
                                <input type="text" class="form-control keyboardInput" lang="ar" name="prenom_ar" id="firstName_ar" value="وسيم" dir="rtl" required>
                            </div>
                        </div>
                        <!-- les nom arabe et françe-->
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lastName">Nom</label>
                                <input type="text" class="form-control" name="nom_fr" id="lastName" value="Chakir" required>
                            </div>
                        </div>
                        <div class="col-lg-6" dir="rtl">
                            <div class="form-group">
                                <label for="lastName_ar" lang="ar">الإسم العائلي</label>
                                <input type="text" class="form-control keyboardInput" lang="ar" name="nom_ar" id="lastName_ar" dir="rtl" value="شاكير" required>
                            </div>
                        </div>
                        <!-- Email-->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="johnexample@gmail.com" required>
                            </div>
                        </div>
                         <!-- Numéro de Téléphone-->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="numTel">Numéro de Téléphone</label>
                                <input type="tel" class="form-control" name="numTel" id="numTel"
                                    value="0612345678" required>
                            </div>
                        </div>
                         <!-- date Naissance-->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="date">date Naissance</label>
                                <input type="date" class="form-control" name="dateNaissance" id="date">
                            </div>
                        </div>
                         <!-- numéro de carte d'identifion-->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="cnie">CNIE</label>
                                <input type="text" class="form-control" name="cnie" id="cnie"
                                    value="U207066" required>
                            </div>
                        </div>
                        <!-- sexe -->h
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
                        <!-- adresse-->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="adresse">Adresse</label>
                                <input type="text" class="form-control" name="adresse" id="adresse" value="N241 LOT RIAD ERRACHIDIA">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addStudent" class="btn btn-primary btn-pill">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script> 
