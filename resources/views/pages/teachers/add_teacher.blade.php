<link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css"> 
<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('teachers.add')}}" method="post">
                @csrf
                @method('post')
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un Professeur</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="firstName">Prénom</label>
                                <input type="text" class="form-control" name="prenom" id="firstName" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lastName">Nom</label>
                                <input type="text" class="form-control" name="nom" id="lastName" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="numTel">Numéro de Téléphone</label>
                                <input type="tel" class="form-control" name="numTel" id="numTel" required>
                            </div>
                        </div>
                        <!-- sexe -->
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label>Sexe</label>
                                <div class="col-6 d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" value="M" type="radio" name="sexe" id="sexe1">
                                    <label class="form-check-label" for="sexe1">
                                      Homme
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" value="F" type="radio" name="sexe" id="sexe2" >
                                    <label class="form-check-label" for="sexe2">
                                      Femme
                                    </label>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="cine">CINE</label>
                                <input type="text" class="form-control" name="cine" id="cine" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="form-label">Matières</label>
                                <select name="idSubject" id="id-Subject" class="form-select" required>
                                    <option disabled selected>-- Choisir une Matière</option>
                                    @foreach ($courseTypes as $courseType)  
                                        <optgroup label="{{$courseType->course}}">
                                            @foreach ($subjects as $subject)
                                                @if ($courseType->idCourseType == $subject->idCourseType)
                                                    <option value="{{ $subject->idSubject }}">
                                                        {{ $subject->libelle  }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addTeacher" class="btn btn-primary btn-pill">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script> 
