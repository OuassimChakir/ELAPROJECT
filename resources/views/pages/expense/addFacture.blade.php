<div class="modal fade modal-add-contact" id="addFacture" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajoute un Facture</h5>
                </div>

            <form action="">
                <div class="modal-body px-4">
                    
                        <div class="row mb-2 g-3">  
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="form-label">Facture</label>
                                    <select name="idExpense" id="typeExpensesSelect" class="form-select" required>
                                        <option disabled selected>-- Choisir type de dépenses --</option>
                                            @foreach ($expenses as $expense)
                                                <option value="{{ $expense->idExpense.'|'.$expense->code}}">
                                                    {{ $expense->description }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="staffSelect form-group mb-4">
                                    <label for="form-label" id="staffLabel">Staff</label>
                                    <select name="idStaff" id="staffSelect" class="form-select" required>
                                        <option disabled selected>-- Choisir un Staff --</option>
                                        @foreach ($staffs as $staff)
                                        <option value="{{ $staff->idStaff}}">
                                            {{ $staff->nom.' '. $staff->prenom}}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="ProfSelect form-group mb-4">
                                    <label for="form-label" id="ProfLabel">Professeurs</label>
                                    <select name="idProfesseur" id="ProfSelect" class="form-select" required>
                                        <option disabled selected>-- Choisir un Professeurs--</option>
                                        @foreach ($Professeurs as $Professeur)
                                        <option value="{{$Professeur->idProfesseur}}">
                                            {{ $Professeur->nom.' '. $Professeur->prenom }}
                                        </option>
                                    @endforeach
                                    </select>
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
                                    <label for="form-label">Montant en Dh</label>
                                    <input type="number" name="amount" class="form-control" id="amount"> 
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2 g-3">  
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Annuler</button>
                    <button type="reset" class="btn btn-secondary btn-pill">Reset</button>
                    <button type="submit" name="addFacture" class="btn btn-primary btn-pill">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('JS/jquery.min.js')}}"></script>
<script src="{{asset('Bootstrap/js/bootstrap.min.js')}}"></script>

<script>
    
    $('.staffSelect').hide();
    $('.ProfSelect').hide();
    $(document).ready(function(){
        $('#typeExpensesSelect').change(function(){
            var array = $(this).val().split('|');
            var code = array[1];
            var idExpense = array[0];
            if (code == '0' || code == '1') {
                if(code === '0'){
                    $('.staffSelect').show();
                    $('.ProfSelect').hide();
                    $('#staffSelect').prop('disabled',false);
                    $('#ProfSelect').prop('disabled',true);

                }else{
                    $('.ProfSelect').show();
                    $('.staffSelect').hide();
                    $('#ProfSelect').prop('disabled',false);
                    $('#staffSelect').prop('disabled',true);
                }         
                       
            } else{
                $('.staffSelect').hide();
                $('.ProfSelect').hide();
                $('#staffSelect').prop('disabled',true);
                $('#ProfSelect').prop('disabled',true);
            }
            }); 
        
    });
</script>
