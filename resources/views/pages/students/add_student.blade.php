@extends('layouts.layout')
@section('title')
Ajouter un Etudiant
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Nouveau Etudiant(e)</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Ajouter un Etudiant
            </p>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="ec-cat-form p-4">
                    <h4>Nouveau Etudiant(e)</h4>

                    <form action="{{ route('student.add') }}" method="post">
                        @csrf
                        @method('post')

                        <div class="modal-body px-4">
                            <div class="row mb-2 g-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">Prénom</label>
                                        <input type="text" class="form-control" name="prenom_fr"
                                            id="firstName" required>
                                    </div>
                                </div>
                                <div class="col-lg-6" dir="rtl">
                                    <div class="form-group">
                                        <label for="firstName_ar" lang="ar">الإسم الشخصي</label>
                                        <input type="text" class="form-control keyboardInput" lang="ar"
                                            name="prenom_ar" id="firstName_ar" dir="rtl">
                                    </div>
                                </div>
                                <!-- les nom arabe et françe-->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="lastName">Nom</label>
                                        <input type="text" class="form-control" name="nom_fr" id="lastName"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6" dir="rtl">
                                    <div class="form-group">
                                        <label for="lastName_ar" lang="ar">الإسم العائلي</label>
                                        <input type="text" class="form-control keyboardInput" lang="ar"
                                            name="nom_ar" id="lastName_ar" dir="rtl">
                                    </div>
                                </div>
                                <!-- Numéro de Téléphone-->
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="numTel">Numéro de Téléphone</label>
                                        <input type="tel" class="form-control" name="numTel" id="numTel"
                                            required>
                                    </div>
                                </div>
                                <!-- date Naissance-->
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="date">date Naissance</label>
                                        <input type="date" class="form-control" name="dateNaissance"
                                            id="date">
                                    </div>
                                </div>
                                <!-- numéro de carte d'identifion-->
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="cnie">CNIE</label>
                                        <input type="text" class="form-control" name="cnie" id="cnie">
                                    </div>
                                </div>
                                <!-- adresse-->
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="adresse">Adresse</label>
                                        <input type="text" class="form-control" name="adresse"
                                            id="adresse">
                                    </div>
                                </div>
                                <!-- sexe -->
                                <div class="col-lg-6">
                                    <div class="form-group mb-2">
                                        <label>Sexe</label>
                                        <div class="col-6 d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input" value="Homme" type="radio"
                                                    name="sexe" id="sexe1" checked>
                                                <label class="form-check-label" for="sexe1">
                                                    Homme
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="Femme" type="radio"
                                                    name="sexe" id="sexe2">
                                                <label class="form-check-label" for="sexe2">
                                                    Femme
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-secondary btn-pill"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="addStudent"
                                class="btn btn-primary btn-pill">Ajouter</button>
                        </div>
                    </form>
                    <script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>

                </div>
            </div>
        </div>
    </div>

@endsection
