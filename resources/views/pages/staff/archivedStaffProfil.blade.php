@extends('layouts.layout')
@section('title')
    {{ $staff->prenom . ' ' . $staff->nom }}
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ $staff->prenom . ' ' . $staff->nom }}</h1>
            <p class="breadcrumbs"><span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span><a href="{{ route('staff.archive') }}">Archive de Staff</a>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ $staff->prenom . ' ' . $staff->nom }}
            </p>
        </div>
        <div>
            <a href="{{route('staff.archive.restore',['idStaff' => $staff->idStaff])}}">
                <button type="button" class="btn btn-success" onclick="return confirm('Vous êtes sûr?');">
                    <i class="bi bi-arrow-repeat"></i> Réstaurer
                </button>
            </a>
        </div>
    </div>


    <div class="card bg-white profile-content">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="profile-content-left profile-left-spacing">
                    <div class="text-center widget-profile px-0 border-0">
                        <div class="card-body">
                            <h4 class="py-2 text-dark">{{ ucfirst($staff->prenom) . ' ' . strtoupper($staff->nom) }}</h4>
                            @if ($staff->sexe == 'M')
                                <p>
                                <div class="badge badge-pill badge-info">Male</div>
                                </p>
                            @else
                                <p>
                                <div class="badge badge-pill badge-purple">Female</div>
                                </p>
                            @endif
                            <p>{{ $staff->cnie }}</p>
                        </div>
                    </div>


                    <hr class="w-100">

                    <div class="contact-info pt-4">
                        <h5 class="text-dark">Information</h5>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Spécialité</p>
                        <p>{{ $staff->designation }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Numéro de Téléphone</p>
                        <p>{{ $staff->numTel }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Inscrie le:</p>
                        <p>{{ $staff->created_at }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Modifié le:</p>
                        <p>{{ $staff->updated_at }}</p>
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
                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings"
                                type="button" role="tab" aria-controls="settings"
                                aria-selected="false">Paramètres</button>
                        </li>
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">

                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="tab-widget mt-5">

                                <div class="row">
                                    <div class="col-xl-12">

                                        <!-- Notification Table -->
                                        <div class="card card-default">
                                            <div class="card-header justify-content-between mb-1">
                                                <h2>Les factures</h2>
                                            </div>
                                            <div class="card-body compact-notifications" data-simplebar
                                                style="height: 434px;">
                                                <div class="table-responsive">
                                                    <table id="responsive-data-table" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Numéro</th>
                                                                <th>Type de Dépense</th>
                                                                <th>Description</th>
                                                                <th>Prix</th>
                                                                <th>Date de Facture</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @if (isset($factures))
                                                                @foreach ($factures as $facture)
                                                                    <tr>
                                                                        <td>BMA-F.{{ str_pad((string) $facture->idExpensePayment, 4, 0, STR_PAD_LEFT) }}
                                                                        </td>
                                                                        <td><span
                                                                                class="badge badge-primary">{{ $facture->designation }}</span>
                                                                        </td>
                                                                        <td>{{ $facture->description }}</td>
                                                                        <td><span
                                                                                class="badge badge-dark">{{ $facture->amount }}
                                                                                DH</span></td>
                                                                        <td>{{ $facture->datePayment }}</td>
                                                                        <td>
                                                                            <div class="btn-group-spaced">
                                                                                <a href="{{ route('pdf.generate', ['idExpensePayment' => $facture->idExpensePayment]) }}"
                                                                                    target="_blank">
                                                                                    <button type="submit"
                                                                                        class="btn btn-outline-success"
                                                                                        name="print">
                                                                                        <i class="bi bi-printer-fill"></i></i>
                                                                                    </button>
                                                                                </a>
                                                                                <a
                                                                                    href="{{ route('factureDepenses.delete', ['idExpensePayment' => $facture->idExpensePayment]) }}">
                                                                                    <button type="submit"
                                                                                        class="btn btn-outline-danger"
                                                                                        name="deleteExpense"
                                                                                        onclick="return confirm('Vous êtes sûr?');">
                                                                                        <i class="bi bi-trash-fill"></i>
                                                                                    </button>
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- SETTINGS OF THE ACCOUNT --}}
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                            <div class="tab-pane-content mt-5">
                                <form action="{{ route('staff.update', ['idStaff' => $staff->idStaff]) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body px-4">
                                        <div class="row mb-2 g-3">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">Prénom</label>
                                                    <input type="text" class="form-control" name="prenom" id="firstName"
                                                        value="{{ $staff->prenom }}" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="lastName">Nom</label>
                                                    <input type="text" class="form-control" name="nom"
                                                        id="lastName" value="{{ $staff->nom }}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <label>Sexe</label>
                                                    <div class="col-6 d-flex align-items-center justify-content-between">
                                                        @if ($staff->sexe == 'M')
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="M"
                                                                    type="radio" name="sexe" id="homme" checked>
                                                                <label class="form-check-label"
                                                                    for="homme">Homme</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="F"
                                                                    type="radio" name="sexe" id="femme">
                                                                <label class="form-check-label"
                                                                    for="femme">Femme</label>
                                                            </div>
                                                        @else
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="M"
                                                                    type="radio" name="sexe" id="homme">
                                                                <label class="form-check-label"
                                                                    for="homme">Homme</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="F"
                                                                    type="radio" name="sexe" id="femme" checked>
                                                                <label class="form-check-label"
                                                                    for="femme">Femme</label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label for="numTel">Numéro de Téléphone</label>
                                                    <input type="tel" class="form-control" name="numTel"
                                                        id="numTel" value="{{ $staff->numTel }}" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label for="form-label">Spécialité</label>
                                                    <select name="idStaffType" id="id-stafftype" class="form-select"
                                                        required>
                                                        @foreach ($staffTypes as $type)
                                                            @if ($type->designation != ucfirst('Professeurs'))
                                                                @if ($type->idStaffType == $staff->idStaffType)
                                                                    <option value="{{ $type->idStaffType }}" selected>
                                                                        {{ $type->designation }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $type->idStaffType }}">
                                                                        {{ $type->designation }}
                                                                    </option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label for="cine">CINE</label>
                                                    <input type="text" class="form-control" name="cine"
                                                        id="cine"value="{{ $staff->cnie }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer px-4">
                                        <a href="{{ route('staff.delete', ['idStaff' => $staff->idStaff]) }}">
                                            <button type="button" class="btn btn-outline-danger btn-pill"
                                                onclick="return confirm('Vous êtes sûr?');">Supprimer le Compte</button>
                                        </a>
                                        <button type="submit" name="updateStaff" class="btn btn-warning btn-pill">Mettre
                                            à jour</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#showFormButton").click(function() {
                $("#formSection").slideToggle();
            });
        });
    </script>
    <script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>

@endsection
