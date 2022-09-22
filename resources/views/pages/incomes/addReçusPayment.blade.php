<div class="modal fade modal-add-contact" id="addFacture" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajoute Reçus de Payment</h5>
                </div>

            <form action="{{route('incomePayment.add')}}" method="post"> 
                @csrf
                @method('post')
                <div class="modal-body px-4">
                        <div class="row mb-2 g-3">  
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="form-label">Reçus de Payment</label>
                                    <select name="idIncome"  class="form-select" required>
                                        <option disabled selected>-- Choisir type de Revenus --</option>
                                            @foreach ($incomes as $income)
                                                <option value="{{$income->idIncome}}">
                                                    {{$income->designation }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="staffSelect form-group mb-4">
                                    <label for="form-label" id="staffLabel">Etudiants</label>
                                    <input type="text" name="matricule" class="form-control" value="ELA" id="matricule" required>
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
                                    <input type="number" name="amout" class="form-control" id="amount"><small class="text-muted">HD</small>
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
                                    <input class="form-check-input"  value="Virement" type="radio" name="paymentMode" id="typePyament2" >
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

                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Annuler</button>
                    <button type="reset" class="btn btn-secondary btn-pill">Reset</button>
                    <button type="submit" name="addPayment" class="btn btn-primary btn-pill">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('JS/jquery.min.js')}}"></script>
<script src="{{asset('Bootstrap/js/bootstrap.min.js')}}"></script>

