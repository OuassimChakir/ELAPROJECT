<div class="modal fade modal-add-contact" id="addFacture" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajoute à un Facture</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2 g-3">  
                        {{-- factures --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="form-label">Facture</label>
                                <select name="idExpense" id="typeExpensesSelect" class="form-select" required>
                                    <option disabled selected>-- Choisir type de dépenses --</option>
                                            @foreach ($expenses as $expense)
                                                    <option value="{{ $expense->idExpense }}">
                                                        {{ $expense->designation  }}
                                                    </option>
                                            @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" id="reloardBtn" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Ajouter</button>
                </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('JS/jquery.min.js')}}"></script>
<script src="{{asset('Bootstrap/js/bootstrap.min.js')}}"></script>
