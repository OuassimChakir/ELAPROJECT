@extends('layouts.layout')
@section('title')
    Les Facture
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Les Facture</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Les Facture
            </p>
        </div>
        <div class="col-sm-6">
            <form action="{{ route('teachers.factures.query', ['idProfesseur' => $Professeur->idProfesseur]) }}"
                method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-10">
                        <input type="month" name="datePayment" class="form-control mt-4" value="{{ $datePayment }}"
                            required>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary mt-4"><span class="mdi mdi-magnify"></span></button>
                    </div>
                </div>
            </form>
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
                                <th>Type de Dépense</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Date de Facture</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                            $i = 0;
                        @endphp
                        <tbody>
                            @if (isset($FacturePayment))
                                @foreach ($FacturePayment as $facture)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>ELA-F.{{ str_pad((string) $facture->idExpensePayment, 4, 0, STR_PAD_LEFT) }}
                                        </td>
                                        <td><span class="badge badge-primary">{{ $facture->designation }}</span></td>
                                        <td>{{ $facture->description }}</td>
                                        <td><span class="badge badge-dark">{{ $facture->amount }} DH</span></td>
                                        <td>{{ $facture->datePayment }}</td>
                                        <td>
                                            <div class="btn-group-spaced">
                                                <a href="{{ route('teachers.pdf', ['idExpensePayment' => $facture->idExpensePayment]) }}"
                                                    target="_blank">
                                                    <button type="submit" class="btn btn-outline-success" name="print">
                                                        <i class="bi bi-printer-fill"></i></i>
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

    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>

@endsection
