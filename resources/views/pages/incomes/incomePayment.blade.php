@extends('layouts.layout')
@section('title')
Reçus de Payment
@section('content')
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Reçus de Payment</h1>
        <p class="breadcrumbs">
            <span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Reçus de Payment
        </p>
    </div>

        <div>
            <button type="button" class="btn btn-info" id="showFormButton" data-bs-toggle="modal"
            data-bs-target="#addFacture">
                <i class="bi bi-plus-square"></i> Ajouter une Paiement 
            </button>
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
                        <table id="responsive-data-table"  class="table">
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Description</th>
                                    <th>Type de Paiement</th>
                                    <th>Prix</th>
                                    <th>Date de Facture</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($incomePayment))

                                    @foreach ($incomePayment as $Pyment)
                                        <tr>
                                            <td>ELA-F.{{str_pad((string) $Pyment->idPayment, 4, 0, STR_PAD_LEFT)}}</td>
                                            <td>{{$Pyment->designation}}</td>
                                            <td>{{$Pyment->paymentMode}}</td>
                                            <td>{{$Pyment->amout}} DH</td>
                                            <td>{{$Pyment->datePayment}}</td>
                                            <td>
                                                <div class="btn-group-spaced">
                                                    <a href="" target="_blank">
                                                        <button type="submit" class="btn btn-outline-success" name="print">
                                                            <i class="bi bi-printer-fill"></i></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('incomePayment.delete',['idPayment' => $Pyment->idPayment])}}">
                                                        <button type="submit" class="btn btn-outline-danger" name="deletePyment" onclick="return confirm('Vous êtes sûr?');">
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
                </div>
            </div>
        </div>
    </div>
<!-- add the Income pyment -->
@include('pages.incomes.addReçusPayment');
    <script src="{{asset('JS/jquery.min.js')}}"></script>
    <script src="{{asset('Bootstrap/js/bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#showFormButton").click(function(){
                $("#formSection").slideToggle();
            });
        });
    </script>

@endsection