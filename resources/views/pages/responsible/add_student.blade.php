<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{url('/student/add')}}" method="post">
                @csrf
                @method('post')
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un Etudiant</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <!-- matricule -->
                        @php
                        $yers=date("Y");
                         $nombre=$lastid + 1;
                         $matricule='ILA'.$nombre.'/'.$yers;    
                         echo"$matricule"; 
                        @endphp
                        <input type="hidden" class="form-control" value={{$matricule}} name="matricule">
                        <!-- les prenom arabe et françe-->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="firstName">Prénom</label>
                                <input type="text" class="form-control" name="prenom_fr" id="firstName" value="John" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lastName" lang="ar">الإسم الشخصي</label>
                                <input type="text" class="form-control" lang="ar" name="nom_ar" id="lastName" value="Deo" required>
                            </div>
                        </div>
                        <!-- les nom arabe et françe-->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lastName">Nom</label>
                                <input type="text" class="form-control" name="nom_fr" id="lastName" value="Deo" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lastName" lang="ar">الإسم العائلي</label>
                                <input type="text" class="form-control" lang="ar" name="prenom_ar" id="lastName" value="Deo" required>
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
                                    value="06 12 34 56 78" required>
                            </div>
                        </div>
                         <!-- date Naissance-->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="userName">date Naissance</label>
                                <input type="date" class="form-control" name="dateNaissance" id="userName">
                            </div>
                        </div>
                         <!-- numéro de carte d'identifion-->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="userName">CNIE</label>
                                <input type="text" class="form-control" name="cnie" id="userName"
                                    value="U156" required>
                            </div>
                        </div>
                        <!-- sexe -->
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label for="userName">Sexe</label>
                                <div class="col-6 d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" value="homme" type="radio" name="sexe" id="sexe1" checked>
                                    <label class="form-check-label" for="sexe1">
                                      Homme
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" value="famme" type="radio" name="sexe" id="sexe2" >
                                    <label class="form-check-label" for="sexe2">
                                      Famme
                                    </label>
                                  </div></div>
                            </div>
                        </div>
                        <!-- adresse-->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="userName">Adresse</label>
                                <input type="text" class="form-control" name="adresse" id="userName">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addstudent" class="btn btn-primary btn-pill">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>