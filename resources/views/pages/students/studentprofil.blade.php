@extends('layouts.layout')
@section('title')
    {{ $student->prenom_fr . ' ' . $student->nom_fr }}
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ $student->prenom_fr . ' ' . $student->nom_fr }}</h1>
            <p class="breadcrumbs"><span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span><a href="{{ route('student.liste') }}">Etudiants</a>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ $student->prenom_fr . ' ' . $student->nom_fr }}
            </p>
        </div>
    </div>

    <div class="card  mb-4 bg-white profile-content">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="profile-content-left profile-left-spacing">
                    <div class="text-center widget-profile px-0 border-0">
                        <div class="card-body">
                            <h4 class="py-2 text-dark">{{ $student->prenom_fr . ' ' . $student->nom_fr }}</h4>
                            <p>{{ $student->matricule }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between ">
                        <div class="text-center pb-4">
                            <h6 class="text-dark pb-2">10</h6>
                            <p>Absences</p>
                        </div>

                        <div class="text-center pb-4">
                            <h6 class="text-dark pb-2">1150</h6>
                            <p>Following</p>
                        </div>
                    </div>

                    <hr class="w-100">

                    <div class="contact-info pt-4">
                        <h5 class="text-dark">Information</h5>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Né(e) le:</p>
                        <p>{{ $student->dateNaissance }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Numéro de Téléphone</p>
                        <p>{{ $student->numTel }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Sexe</p>
                        <p>{{ ucfirst($student->sexe) }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Adresse</p>
                        <p>{{ $student->adresse }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Inscrie le:</p>
                        <p>{{ $student->created_at }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Modifié le:</p>
                        <p>{{ $student->created_at }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xl-9">
                <div class="profile-content-right profile-right-spacing py-5">
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="groups-tab" data-bs-toggle="tab" data-bs-target="#groups"
                                type="button" role="tab" aria-controls="groups" aria-selected="false">Groupes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="groups-tab" data-bs-toggle="tab" data-bs-target="#responsible"
                                type="button" role="tab" aria-controls="responsible"
                                aria-selected="false">Responsable</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings"
                                type="button" role="tab" aria-controls="settings"
                                aria-selected="false">Paramètres</button>
                        </li>
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                        {{-- Profile TAB --}}
                        @include('pages.students.profil.informations')

                        {{-- Responsible TAB --}}
                        @include('pages.students.profil.responsable')

                        {{-- GROUPS TAB --}}
                        @include('pages.students.profil.groupes')

                        {{-- SETTINGS OF THE ACCOUNT --}}
                        @include('pages.students.profil.settings')

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('pages.students.add2Group') --}}
    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#showFormButton").click(function() {
                $("#formSection").slideToggle();
            });
        });
        $(document).ready(function() {
            $("#addPayment").click(function() {
                $("#paymentForm").slideToggle();
            });
        });
    </script>
    <script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>
    <script>
        $('.add2GroupBtn').click(function() {
            $('#idStudent').val($(this).val());
            $('#gradesSelect').find('option').remove();
            $('#groupsResult').find('div').remove();
            $("#subjectSelect").prop('selectedIndex', 0);
        });
    </script>
@endsection
