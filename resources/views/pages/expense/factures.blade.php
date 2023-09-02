@extends('layouts.layout')
@section('title')
Facture de Dépenses
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Facture de Dépenses</h1>
        <p class="breadcrumbs">
            <span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Facture de Dépenses
        </p>
    </div>

        <div>
            <button type="button" class="btn btn-info" id="showFormButton" data-bs-toggle="modal"
            data-bs-target="#addFacture">
                <i class="bi bi-plus-square"></i> Ajouter une Facture 
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
                                            <td>ELA-F.{{str_pad((string) $facture->idExpensePayment, 4, 0, STR_PAD_LEFT)}}</td>
                                            <td><span class="badge badge-primary">{{$facture->designation}}</span></td>
                                            <td>{{$facture->description}}</td>
                                            <td><span class="badge badge-dark">{{$facture->amount}} DH</span></td>
                                            <td>{{$facture->datePayment}}</td>
                                            <td>
                                                <div class="btn-group-spaced">
                                                    <a href="{{route('pdf.generate',['idExpensePayment'=>$facture->idExpensePayment])}}" target="_blank">
                                                        <button type="submit" class="btn btn-outline-success" name="print">
                                                            <i class="bi bi-printer-fill"></i></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('factureDepenses.delete',['idExpensePayment' => $facture->idExpensePayment])}}">
                                                        <button type="submit" class="btn btn-outline-danger" name="deleteExpense" onclick="return confirm('Vous êtes sûr?');">
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
<!-- Ajouter un facture de dépenses -->
@include('pages.expense.addFacture')
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