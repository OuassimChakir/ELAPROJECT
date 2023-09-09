@extends('layouts.layout')
@section('title')
Reçus de Payment
@endsection
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

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                        <table id="responsive-data-table"  class="table">
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Etudiants</th>
                                    <th>Designation</th>
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
                                            <td>ELA-R.{{str_pad((string) $Payment->idPayment, 4, 0, STR_PAD_LEFT)}}</td>
                                            <td><span class="badge badge-warning">{{$Payment->matricule}}</span></td>
                                            <td><span class="badge badge-primary">{{$Payment->designation}}</span></td>
                                            <td>{{$Payment->paymentMode}}</td>
                                            <td><span class="badge badge-dark">{{$Payment->amount}} DH</span></td>
                                            <td>{{$Payment->datePayment}}</td>
                                            <td>
                                                <div class="btn-group-spaced">
                                                    <a href="" target="_blank">
                                                        <button type="submit" class="btn btn-outline-success" name="print">
                                                            <i class="bi bi-printer-fill"></i></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('incomePayment.delete',['idPayment'=>$Payment->idPayment])}}">
                                                        <button type="submit" class="btn btn-outline-danger" name="deletePayment" onclick="return confirm('Vous êtes sûr?');">
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
<!-- add the Income Payment -->
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