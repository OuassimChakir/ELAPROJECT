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
                <span><i class="mdi mdi-chevron-right"></i></span>BMA Paiment
            </p>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                    <div class="ec-cat-form p-4">
                        <h4>BMA Paiment</h4>

                        <form action="{{ route('paiment.validate',['idPayment' => $paiment->idPayment]) }}" method="post">
                            @csrf
                            @method('post')
                            <div class="row mb-2 g-3">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="form-label">Reçus de Payment</label>
                                        <input type="text" class="form-control" value="{{$paiment->designation}}" id="matricule" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="matricule" id="staffLabel">Etudiants</label>
                                        <input type="text" name="matricule" class="form-control" value="{{$paiment->matricule}}" id="matricule" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 g-3">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="numeroRecu">N° Reçu</label>
                                        <input type="text" name="numeroRecu" class="form-control" id="numeroRecu" required>
                                        <small class="text-muted">Le numéro du Reçu donnée au Client</small>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="datePayment">Date du Payement</label>
                                        <input type="date" name="datePayment" class="form-control" id="datePayment" value="{{date('Y-m-d')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 g-3">
                                <div class="col-lg-6">
                                    <div class="input-group mb-3">
                                        <label for="amount">Montant à Payer</label>
                                        <input type="number" class="form-control" name="amount" id="amount" aria-label="Montant à Payer" aria-describedby="basic-addon2" value="{{$paiment->amount}}" required>
                                        <span class="input-group-text" id="basic-addon2">DH</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group mb-3">
                                        <label for="amountPaid">Montant Payé</label>
                                        <input type="number" class="form-control" name="amountPaid" id="amountPaid" aria-label="Montant à Payer" aria-describedby="basic-addon2" max="{{$paiment->amount}}" min="0" required>
                                        <span class="input-group-text" id="basic-addon2">DH</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 g-3">
                                <div class="col-lg-6">
                                    <label>Type de Paiement</label>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" value="Espece" type="radio" name="paymentMode" id="typePyament1" checked>
                                            <label class="form-check-label" for="typePyament1" checked>
                                                Espèce
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Virement" type="radio" name="paymentMode" id="typePyament2">
                                            <label class="form-check-label" for="typePyament2">
                                                Virement Bancaire
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="validatePaiment" class="btn btn-primary btn-pill">Payer</button>
                                <button type="reset" class="btn btn-secondary btn-pill">Reset</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection
