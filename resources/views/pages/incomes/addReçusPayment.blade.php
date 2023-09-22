<div class="modal fade modal-add-contact" id="addFacture" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ajoute Reçus de Payment</h5>
            </div>
            <form action="{{ route('incomePayment.add') }}" method="post" id="invoicePaimentForm" class="was-validated">
                @csrf
                @method('post')
                <div class="modal-body px-4">
                    <div class="row mb-2 g-3">
                        <div class="row mb-2 g-3">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="idIncome" id="IncomeLabel">type des incomes</label>
                                    <select name="idIncome" id="idIncome" class="form-select " required>
                                        <option disabled selected>-- Choisir une invoice --</option>
                                        <optgroup label="les mois">
                                            @foreach ($incomes as $income)
                                                @if ($income->activationDate != 00 && $income->activationDate != null)
                                                    <option value="{{ $income->idIncome }}">
                                                        {{ $income->designation }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="les Frais">
                                            @foreach ($incomes as $income)
                                                @if ($income->activationDate == 00 && $income->activationDate != null )
                                                    <option value="{{ $income->idIncome }}">
                                                        {{ $income->designation }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                        @foreach ($incomes as $income)
                                            @if ($income->activationDate == null)
                                                <optgroup label="Les événements">
                                                    <option value="{{ $income->idIncome }}">
                                                        {{ $income->designation }}
                                                    </option>
                                            @endif
                                        @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="search" id="EtudiantLabel">Etudiant</label>
                                <div class="form-group mb-4 d-flex justify-content-center " id="search-autocomplete">
                                    <input type="text" name="search" id="search"  placeholder="Search Etudiant Data"
                                     class="form-control" value="" required>
                                    
                                     <button class="btn btn-outline-secondary" id="idSearch" type="button"><i class="bi bi-search"></i></button>
                                </div> 
                                <div id="userList" style="display: block;"></div>
                            </div>
                        </div>
                        <div class="row mb-2 g-3">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="numeroRecu">N° Reçu</label>
                                    <input type="text" name="numeroRecu" class="form-control" id="numeroRecu"
                                        required>
                                    <small class="text-muted">Le numéro du Reçu donnée au Client</small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="datePayment">Date du Payement</label>
                                    <input type="date" name="datePayment" class="form-control" id="datePayment"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2 g-3">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="paimentAmount">Montant à Payer</label>
                                    <input type="number" class="form-control" name="amount" id="paimentAmount"
                                        value="{{-- $paiment->amount --}}" required>
                                    <small class="text-muted">Le montant à payer en Dirham</small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="paimentAmountPaid">Montant Payé</label>
                                    <input type="number" class="form-control" name="amountPaid" id="paimentAmountPaid"
                                        max="{{-- $paiment->amount --}}" min="0" required>
                                    <small class="text-muted">Le montant payer par le client en Dirham</small>
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
                        </div>
                    </div>

                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-secondary btn-pill"
                            data-bs-dismiss="modal">Annuler</button>
                        <button type="reset" class="btn btn-secondary btn-pill">Reset</button>
                        <button type="submit" name="validatePaiment" class="btn btn-primary btn-pill">Payer</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('JS/jquery.min.js') }}"></script>
<script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>
<script>

    $('#search').on('keyup',function() {
        var query = $(this).val(); 
        $.ajax({
            url:"{{ route('search.etudiant') }}",
            type:"GET",
            data:{'query':query},
            success:function (data) {
                $('#userList').html(data);
            }
        })  
    });
    $('body').on('click', 'idSearch', function(){
        var value = $(this).text();
        //do what ever you want
    });
    validationStatus = true; 
    if ($('#idIncome').val().length == 0) {
        if (validationStatus) { $('#idIncome').focus() };
        validationStatus = false;       
    }

    </script>
    <style>
     #userList{
    display: none;
    position: absolute;
    top: 90px;
    overflow-y: hidden;
    width: 43%;
    z-index: 999999;
    background-color: white;
     }  
    </style>
