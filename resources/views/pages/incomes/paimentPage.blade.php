@extends('layouts.layout')
@section('title')
    BMA Paiment
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Revenus</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Types de Revenus
            </p>
        </div>

        <div>
            <button type="button" class="btn btn-primary" id="showFormButton">
                <i class="bi bi-plus-square"></i> Ajouter un Revenu
            </button>
        </div>

    </div>


    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                    <div class="ec-cat-form">
                        <h4>Ajouter un Revenu</h4>

                        <form action="{{ route('incomePayment.add') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="row mb-2 g-3">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="form-label">Reçus de Payment</label>
                                        <select name="idIncome" class="form-select" required>
                                            <option disabled selected>-- Choisir type de Revenus --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="staffSelect form-group mb-4">
                                        <label for="form-label" id="staffLabel">Etudiants</label>
                                        <input type="text" name="matricule" class="form-control" value="{{$paiment->matricule}}" id="matricule" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 g-3">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="datePayment">Date du Payement</label>
                                        <input type="date" name="datePayment" class="form-control" id="datePayment">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="form-label">Montant</label>
                                        <input type="number" name="amount" class="form-control" id="amount"><small
                                            class="text-muted">HD</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 g-3">
                                <div class="col-lg-6">
                                    <label>Type de Paiement</label>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" value="Espece" type="radio" name="paymentMode"
                                                id="typePyament1" checked>
                                            <label class="form-check-label" for="typePyament1" checked>
                                                Espèce
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Virement" type="radio"
                                                name="paymentMode" id="typePyament2">
                                            <label class="form-check-label" for="typePyament2">
                                                Virement Bancaire
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary btn-pill"
                                data-bs-dismiss="modal">Annuler</button>
                            <button type="reset" class="btn btn-secondary btn-pill">Reset</button>
                            <button type="submit" name="addPayment" class="btn btn-primary btn-pill">Ajouter</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection
