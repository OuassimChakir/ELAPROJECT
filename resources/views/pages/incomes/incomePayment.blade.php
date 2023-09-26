@extends('layouts.layout')
@section('title')
    Reçus de Payment
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Reçus de Payment</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Reçus de Payment
            </p>
        </div>

        <div>
            <button type="button" class="btn btn-info" id="showFormButton" data-bs-toggle="modal" data-bs-target="#addFacture">
                <i class="bi bi-plus-square"></i> Ajouter une Paiement
            </button>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                    <table id="responsive-data-table" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Numéro</th>
                                <th>Detail</th>
                                <th>Etudiant</th>
                                <th>Prix</th>
                                <th>Etat</th>
                                <th>Date de Reçus</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($incomePayment))
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($incomePayment as $Payment)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        @if (is_null($Payment->numeroRecu))
                                            <td>BMA-N°-</td>
                                        @else
                                            <td>BMA-N°{{$Payment->numeroRecu}}</td>
                                        @endif
                                        <td>
                                            <p>{{ $Payment->note }}</p>
                                        </td>
                                        <td>
                                            @if (!is_null($Payment->idStudent))
                                            <a href="{{route('student.profil',['idStudent' => $Payment->idStudent])}}">
                                                {{$Payment->prenom_ar}} {{$Payment->nom_ar}}
                                            </a>    
                                            @else
                                                -
                                            @endif
                                            
                                        </td>
                                        <td><span class="badge badge-dark">{{ $Payment->amount }} DH</span></td>
                                        <td>
                                            @if ($Payment->etat == 0)
                                                <span class="badge badge-warning">Impayée</span>
                                            @elseif($Payment->etat == 1)
                                                <span class="badge badge-success">Réglée</span>
                                            @endif
                                        </td>
                                        <td>{{ $Payment->datePayment }}</td>
                                        <td>
                                            <div class="btn-group-spaced">
                                                <a href="" target="_blank">
                                                    <button type="submit" class="btn btn-outline-success" name="print">
                                                        <i class="bi bi-printer-fill"></i></i>
                                                    </button>
                                                </a>
                                                <a
                                                    href="{{ route('incomePayment.delete', ['idPayment' => $Payment->idPayment]) }}">
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        name="deletePayment" onclick="return confirm('Vous êtes sûr?');">
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
    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#showFormButton").click(function() {
                $("#formSection").slideToggle();
            });
        });
    </script>

@endsection
