@extends('layouts.layout')
@section('title')
    Types de Revenus
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Revenus</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Types de Revenus
            </p>
        </div>

        <div>
            <button type="button" class="btn btn-primary" id="showFormButton">
                <i class="bi bi-plus-square"></i> Ajouter un Revenu
            </button>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body" id="formSection">
                    <div class="ec-cat-form">
                        <h4>Ajouter un Revenu</h4>

                        <form action="{{ route('typeIncome.add') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group ">
                                        <label for="text" class="form-label">Designation</label>
                                        <div class="col">
                                            <input id="libelle" name="designation" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group ">
                                        <label for="parent-category" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 my-4">
                                    <div class="form-check">
                                        <input id="checkActivation" name="checkbox" class="form-check-input" type="checkbox">
                                        <label for="checkActivation" class="form-check-label">De la part de l'étudiant</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group ">
                                        <div class="form-group ">
                                            <label for="activationDate" class="form-label">Date d'activation</label>
                                            <select name="activationDate" id="activationDate" required disabled>
                                                <option value="01">Janvier</option>
                                                <option value="02">Février</option>
                                                <option value="03">Mars</option>
                                                <option value="04">Avril</option>
                                                <option value="05">Mai</option>
                                                <option value="06">Juin</option>
                                                <option value="07">Juillet</option>
                                                <option value="08">Août</option>
                                                <option value="09">Septembre</option>
                                                <option value="10">Octobre</option>
                                                <option value="11">Novembre</option>
                                                <option value="12">Décembre</option>
                                                <option value="00">Autre</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12" id="fixedAmountArea">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button name="ajouterIncome" type="submit" class="btn btn-primary">Ajouter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="responsive-data-table" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Designation</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($Incomes))
                                @php
                                    $i = 0;
                                @endphp
                                    @foreach ($Incomes as $income)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{ $income->designation }} </td>
                                            <td>
                                                {{ $income->description }} 
                                                @if (!is_null($income->fixedAmount))
                                                    <span class="badge badge-purple">{{$income->fixedAmount}} DH</span>
                                                @endif
                                            </td>
                                            @if (is_null($income->activationDate))
                                                <td><span class="badge badge-dark">Autre</span></td>
                                            @else
                                                <td><span class="badge badge-primary">{{ucfirst('étudiant')}}</span></td>
                                            @endif
                                            <td>
                                                <div class="btn-group-spaced">
                                                    <a
                                                        href="{{ route('typeIncome.update.page', ['idIncome' => $income->idIncome]) }}">
                                                        <button type="submit" name="edit" class="btn btn-outline-warning">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    </a>
                                                    <a
                                                        href="{{ route('typeIncome.delete', ['idIncome' => $income->idIncome]) }}">
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            name="deleteIncome" onclick="return confirm('Vous êtes sûr?');">
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
    </div>
    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            $("#showFormButton").click(function() {
                $("#formSection").slideToggle();
            });
            $('#checkActivation').click(function() {
                if($('#checkActivation').is(':checked'))
                    $('#activationDate').prop('disabled',false);
                else
                    $('#activationDate').prop('disabled',true);
            });

        });

        $(document).ready(function() {
            $('#activationDate').change(function() {
                if($('#activationDate').val() == '00'){
                    var html = '<div class="form-group"><label for="fixedAmount" class="form-label">Montant Fixe</label> <div class="col"> <input type="number" min="0" step=".1" id="fixedAmount" name="fixedAmount" class="form-control" required> </div> </div>';
                    $('#fixedAmountArea').append(html);
                }else
                    $('#fixedAmountArea').empty();
            });
        });
    </script>
@endsection
