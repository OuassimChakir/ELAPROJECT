<div class="modal fade modal-add-contact" id="invoicePaiment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ajoute Reçus de Payment</h5>
            </div>
            <form action="" method="post" id="invoicePaimentForm">
                @csrf
                @method('post')
                <div class="modal-body px-4">
                    <div class="alert alert-warning" id="paimentNote">
                    </div>
                    <div class="row mb-2 g-3">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="form-label">Designationt</label>
                                <input type="text" id="paimentDesignation" class="form-control" value="" id="designation" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="paimentIdStudent" id="staffLabel">Etudiant</label>
                                <input type="text" name="idStudent" class="form-control" value="" id="paimentIdStudent" readonly required>
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
                            <div class="form-group mb-3">
                                <label for="paimentAmount">Montant à Payer</label>
                                <input type="number" class="form-control" name="amount" id="paimentAmount" value="" required>
                                <small class="text-muted">Le montant à payer en Dirham</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="paimentAmountPaid">Montant Payé</label>
                                <input type="number" class="form-control" name="amountPaid" id="paimentAmountPaid" max="" min="0" required>
                                <small class="text-muted">Le montant payer par le client en Dirham</small>
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
                </div>

                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Annuler</button>
                    <button type="reset" class="btn btn-secondary btn-pill">Reset</button>
                    <button type="submit" name="validatePaiment" class="btn btn-primary btn-pill">Payer</button>
                </div>
            </form>
        </div>
    </div>
</div>
