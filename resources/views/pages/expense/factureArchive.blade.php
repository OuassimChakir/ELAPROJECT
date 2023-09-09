@extends('layouts.layout')
@section('title')
Archive Facture de Dépenses
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Archive Facture de Dépenses</h1>
        <p class="breadcrumbs">
            <span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Archive Facture de Dépenses
        </p>
    </div>

</div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                    <form action="{{route('factureDepenses.archive.multiple')}}" method="post">
                        @csrf
                        @method('post')
                        <table id="responsive-data-table"  class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="form-check-input" id="selectAllArchived"></th>
                                    <th>Numéro</th>
                                    <th>Type de Dépense</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th>Date de Facture</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($factureDepenses))

                                    @foreach ($factureDepenses as $facture)
                                        <tr>
                                            <td><input type="checkbox" name="archivedFacture[]" value="{{$facture->idExpensePayment}}" class="form-check-input archivedFacture"></td>
                                            <td>ELA-R.{{str_pad((string) $facture->idExpensePayment, 4, 0, STR_PAD_LEFT)}}</td>
                                            <td><span class="badge badge-primary">{{$facture->designation}}</span></td>
                                            <td>{{$facture->description}}</td>
                                            <td><span class="badge badge-dark">{{$facture->amount}} DH</span></td>
                                            <td>{{$facture->datePayment}}</td>
                                            <td>
                                                <div class="btn-group-spaced">
                                                    <a href="{{route('factureDepenses.archive.restore',['idExpensePayment' => $facture->idExpensePayment])}}">
                                                        <button type="button" name="show" class="btn btn-outline-success" value="{{$facture->idExpensePayment}}" onclick="return confirm('Vous êtes sûr?');">
                                                            <i class="bi bi-arrow-repeat"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('factureDepenses.archive.delete',['idExpensePayment'=>$facture->idExpensePayment])}}">
                                                        <button type="button" class="btn btn-outline-danger" name="delete" value="{{$facture->idExpensePayment}}" onclick="return confirm('Voulez-vous supprimer définitivement cet facture?');">
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
                        <div class="row">
                            <div class="col btns">
                                <button type="submit" name="restoreAll" class="btn btn-outline-success" onclick="return confirm('Vous êtes sûr?');">
                                    <i class="bi bi-arrow-repeat"></i> Restaurer la Sélection
                                </button>
                                <button type="submit" name="deleteAll" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer définitivement ces Facture?');">
                                    <i class="bi bi-trash-fill"></i> Supprimer la Sélection
                                </button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Ajouter un facture de dépenses -->
    <script src="{{asset('JS/jquery.min.js')}}"></script>
    <script src="{{asset('Bootstrap/js/bootstrap.min.js')}}"></script>
    <script>
        // Listen for click on toggle checkbox
        $('#selectAllArchived').click(function(event) {   
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
            }
        });
        $(document).ready(function() {
            $('#responsive-data-table tr').click(function(event) {
                if (event.target.type !== 'checkbox') {
                    $(':checkbox', this).trigger('click');
                }
            });
        });
    
        $(".btns").hide();
        $(":checkbox").click(function() {
            if($(this).is(":checked")) {
                $(".btns").show();
            } else {
                $(".btns").hide();
            }
        });
    </script>
@endsection