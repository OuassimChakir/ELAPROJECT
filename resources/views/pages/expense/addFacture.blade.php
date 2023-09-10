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
                                                <option value="{{ $expense->idExpense}}">
                                                    {{ $expense->description}}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="staffSelect form-group mb-4">
                                    <label for="form-label" id="staffLabel">Staff</label>
                                    <select name="idStaff" id="staffSelect" class="form-select" required>
                                        
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
                                    <label for="form-label">Montant en DH</label>
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
    $(document).ready(function(){
        $('#typeExpensesSelect').change(function(){
            $('#staffLabel').empty();
            $('#staffSelect').find('option').remove();
            var array = $(this).val().split('|');
            var code = array[1];
            var idExpense = array[0];
            if (code == '000' || code == '111') {
                $('#staffSelect').prop('disabled',false);
                if(code === '000')
                    $('#staffLabel').append('Professeurs');
                else
                    $('#staffLabel').append('Staffs');
                // AJAX request 
                $.ajax({
                    url: '/factureDepenses/'+idExpense,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }   
                        if(len > 0){
                            // Read data and create <option >
                            for(var i=0; i<len; i++){
                                var id = response['data'][i].idStaff;
                                var name = response['data'][i].prenom+" "+response['data'][i].nom;
            
                                var option = "<option value='"+id+"'>"+name+"</option>";
            
                                $("#staffSelect").append(option); 
                            }
                        }
                        $('.staffSelect').show();          
                    },
                });
            } else {
                $('.staffSelect').hide();
                $('#staffSelect').prop('disabled',true);
            }
            
        });
    });
</script>