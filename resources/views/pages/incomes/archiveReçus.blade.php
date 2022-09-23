@extends('layouts.layout')
@section('title')
Archive Reçus de Payment
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Reçus de Payment</h1>
        <p class="breadcrumbs">
            <span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Archive Reçus de Payment
        </p>
    </div>
</div>
@if (session()->has('successMessage'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session()->get('successMessage')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session()->has('deleteMessage'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session()->get('deleteMessage')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session()->has('updateMessage'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{session()->get('updateMessage')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">

                <div class="card-body">
                    <form action="{{route('incomePayment.archive.multiple')}}" method="post">
                        @csrf
                        @method('post')
                        <table id="responsive-data-table"  class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="form-check-input" id="selectAllArchived"></th>
                                    <th>Numéro</th>
                                    <th>Description</th>
                                    <th>Type de Paiement</th>
                                    <th>Prix</th>
                                    <th>Date de Reçus</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($incomePayment))

                                    @foreach ($incomePayment as $Payment)
                                        <tr>
                                            <td><input type="checkbox" name="archivedPayment[]" value="{{$Payment->idPayment}}" class="form-check-input archivedPayment"></td>
                                            <td>ELA-R.{{str_pad((string) $Payment->idPayment, 4, 0, STR_PAD_LEFT)}}</td>
                                            <td><span class="badge badge-primary">{{$Payment->designation}}</span></td>
                                            <td>{{$Payment->paymentMode}}</td>
                                            <td><span class="badge badge-dark">{{$Payment->amout}} DH</span></td>
                                            <td>{{$Payment->datePayment}}</td>
                                            <td>
                                                <div class="btn-group-spaced">
                                                    <a href="{{route('incomePayment.archive.restore',['idPayment' => $Payment->idPayment])}}">
                                                        <button type="button" name="show" class="btn btn-outline-success" value="{{$Payment->idPayment}}" onclick="return confirm('Vous êtes sûr?');">
                                                            <i class="bi bi-arrow-repeat"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('incomePayment.archive.delete',['idPayment'=>$Payment->idPayment])}}">
                                                        <button type="button" class="btn btn-outline-danger" name="delete" value="{{$Payment->idPayment}}" onclick="return confirm('Voulez-vous supprimer définitivement cet reçus?');">
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
                                <button type="submit" name="deleteAll" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer définitivement ces Reçus?');">
                                    <i class="bi bi-trash-fill"></i> Supprimer la Sélection
                                </button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
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