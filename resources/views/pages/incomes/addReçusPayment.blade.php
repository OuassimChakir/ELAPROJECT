<div class="modal fade modal-add-contact" id="addFacture" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ajoute Reçus de Payment</h5>
            </div>
            <form action="{{ route('incomePayment.add') }}" method="post"  id="invoicePaimentForm">
                @csrf
                @method('post')
                <div class="modal-body px-4">
                    <div class="row mb-2 g-3"> 
                        <div class="row mb-2 g-3">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="idIncome" id="IncomeLabel">type des incomes</label>
                                    <select name="idIncome" id="idIncome" class="form-select " required>
                                        <option disabled selected value="">-- Choisir une invoice --</option>
                                        <optgroup label="les mois">
                                            @foreach ($incomes as $income)
                                                @if ($income->activationDate != 00 && $income->activationDate != null)
                                                    <option
                                                        value="{{ $income->idIncome . '|' . $income->activationDate . '|' . $income->designation }}">
                                                        {{ $income->designation }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="les Frais">
                                            @foreach ($incomes as $income)
                                                @if ($income->activationDate == 00 && $income->activationDate != null)
                                                    <option
                                                        value="{{ $income->idIncome . '|' . $income->activationDate . '|' . $income->designation }}">
                                                        {{ $income->designation }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                        @foreach ($incomes as $income)
                                            @if ($income->activationDate == null)
                                                <optgroup label="Les événements">
                                                    <option
                                                        value="{{ $income->idIncome . '|' . $income->activationDate . '|' . $income->designation }}">
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
                                <div class="form-group mb-4 d-flex justify-content-center" id="search-autocomplete">
                                    <input type="text" name="search" id="search" placeholder="Search Etudiant Data" class="form-control" value="" required>
                                    <button type="button" class="btn btn-primary" id="searchBtn">
                                        <span class="mdi mdi-magnify"></span>
                                    </button>
                                </div>
                                <div id="userList" style="display: block;"></div>
                            </div>
                        </div>
                        <div class="row mb-2 g-3">
                            <div class="">
                                <div class="form-group mb-4" id="groupSelect">
                                    <label for="idGroup" id="groupLabel">les group</label>
                                    <select name="idGroup" id="idGroup" class="form-select  " required>
                                        <option disabled selected>-- Choisir un groupe --</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2 g-3">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="numeroRecu">N° Reçu</label>
                                    <input type="text" name="numeroRecu" class="form-control" id="numeroRecu"
                                        >
                                    <small class="text-muted">Le numéro du Reçu donnée au Client</small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4 was-validated">
                                    <label for="datePayment">Date du Payement</label>
                                    <input type="date" name="datePayment" class="form-control " id="datePayment"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="hidden">
                        </div>
                        <div class="row mb-2 g-3">
                            <div class="col-lg-6">
                                <div class="form-group mb-3 was-validated">
                                    <label for="paimentAmount">Montant à Payer</label>
                                    <input type="number" class="form-control" name="amount" id="paimentAmount" required>
                                    <small class="text-muted">Le montant à payer en Dirham</small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3 was-validated">
                                    <label for="paimentAmountPaid">Montant Payé</label>
                                    <input type="number" class="form-control " name="amountPaid" id="paimentAmountPaid"
                                        max="{{-- $paiment->amount --}}" min="0" required>
                                    <small class="text-muted">Le montant payer par le client en Dirham</small>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2 g-3">
                            <div class="col-lg-6">
                                <label>Type de Paiement</label>
                                <div class="col was-validated">
                                    <div class="form-check">
                                        <input class="form-check-input" value="Espece" type="radio"
                                            name="paymentMode" id="typePyament1" checked>
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
    $('#groupSelect').hide();
    $('.hidden').hide();
    $(document).ready(function() {
        $('#idIncome').change(function() {
            var array = $(this).val().split('|');
            var activationDate = array[1];
            var idincome = array[0];
            if(activationDate == ''){
                $('#search').prop('disabled',true);
            }else{
                $('#search').prop('disabled',false);
            }
            $('#search').on('keyup', function() {
                $('#userList').show();
                $('#idGroup').empty();
                $('#idGroup').prop('disabled', true);
                $('#groupSelect').hide();
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('search.etudiant') }}",
                    type: "GET",
                    data: {
                        'query': query
                    },
                    success: function(data) {
                        $('#userList').html(data);
                    }
                })

            });
            $('body').on('click', '#searchBtn', function() {
                var value = $('#search').val();
                $('#search').removeClass("is-invalid");
                $('#search').addClass("is-valid");
                // Make the second AJAX request
                $.ajax({
                    url: "{{ route('search.group') }}",
                    type: "GET",
                    data: {
                        'matricule': value
                    },
                    success: function(data) {
                        if (data.length > 0) {
                            let html = '';
                            for (let i = 0; i < data.length; i++) {
                                html += "<option value=" + data[i].idGroup + ">" +
                                    data[i].designation + "</option>";
                            }
                            $('#idGroup').empty();
                            $('#idGroup').append(html);
                            $('#idGroup').prop('disabled', false);
                            $('#groupSelect').show();
                        } else {
                            $('#idGroup').prop('disabled', true);
                            $('#groupSelect').hide();
                        }
                    }
                });
            });
            $('#search').removeClass("is-valid"); 
            $('#search').addClass("is-invalid");
        });

    });
    $('#numeroRecu').on('keyup', function() {
        var numRecuQuery = $('#numeroRecu').val();

        $.ajax({
            url: "{{ route('search.numRecu') }}",
            type: "GET",
            data: {
                'numRecuQuery': numRecuQuery
            },
            success: function(data) {
                if (data == 0) {
                    $('#numeroRecu').removeClass("is-invalid");
                    $('#numeroRecu').addClass("is-valid");
                } else {
                    $('#numeroRecu').removeClass("is-valid");
                    $('#numeroRecu').addClass("is-invalid");
                }
            }
        });
    });
    $(document).ready(function() {
        $("select").click(function() {
            var idincome = $('#idIncome').val();
            if (idincome !=null ) {
                    $('#idIncome').removeClass("is-invalid");
                    $('#idIncome').addClass("is-valid");
                } else {
                    $('#idIncome').removeClass("is-valid");
                    $('#idIncome').addClass("is-invalid");
                }

        });
    });
</script>

<script>
    $(document).on('click', '.userListElement', function() {
        let value = $(this).attr('value');
        $('#search').val(value);
        $('#userList').hide();
    });
</script>
<style>
    .userListElement {
        cursor: pointer;
    }

    #userList {
        display: none;
        position: absolute;
        top: 90px;
        overflow-y: hidden;
        width: 43%;
        z-index: 999999;
        background-color: white;
    }
</style>
