@extends('layouts.layout')
@section('title')
    Modifier le Type de Revenu
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Types de Revenus</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span><a href="{{ route('typeIncome') }}">Types de Revenus</a>
                <span><i class="mdi mdi-chevron-right"></i></span>Modification
            </p>
        </div>

        <div>
            <a href="{{ route('typeIncome') }}">
                <button type="button" class="btn btn-primary" id="showFormButton">
                    <i class="bi bi-arrow-left"></i> Retourner
                </button>
            </a>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                    @if (isset($updatedIncome))
                        <form action="{{ route('typeIncome.update', ['idIncome' => $updatedIncome->idIncome]) }}"
                            method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group ">
                                        <label for="text" class="form-label">Designation</label>
                                        <div class="col">
                                            <input id="libelle" name="designation" class="form-control" type="text"
                                                value="{{ $updatedIncome->designation }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group ">
                                        <label for="parent-category" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $updatedIncome->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 my-4">
                                    <div class="form-check">
                                        @if (is_null($updatedIncome->activationDate))
                                            <input id="checkActivation" name="checkbox" class="form-check-input"
                                                type="checkbox">
                                        @else
                                            <input id="checkActivation" name="checkbox" class="form-check-input"
                                                type="checkbox" checked>
                                        @endif
                                        <label for="checkActivation" class="form-check-label">De la part de
                                            l'étudiant</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group ">
                                        <div class="form-group ">
                                            <label for="activationDate" class="form-label">Date d'activation</label>
                                            @if (is_null($updatedIncome->activationDate))
                                                <select name="activationDate" class="form-control" id="activationDate"
                                                    required disabled>
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
                                            @else
                                                <select name="activationDate" class="form-control" id="activationDate"
                                                    required>
                                                    <option value="01"
                                                        {{ $updatedIncome->activationDate == '01' ? 'selected' : '' }}>
                                                        Janvier</option>
                                                    <option value="02"
                                                        {{ $updatedIncome->activationDate == '02' ? 'selected' : '' }}>
                                                        Février</option>
                                                    <option value="03"
                                                        {{ $updatedIncome->activationDate == '03' ? 'selected' : '' }}>
                                                        Mars</option>
                                                    <option value="04"
                                                        {{ $updatedIncome->activationDate == '04' ? 'selected' : '' }}>
                                                        Avril</option>
                                                    <option value="05"
                                                        {{ $updatedIncome->activationDate == '05' ? 'selected' : '' }}>
                                                        Mai</option>
                                                    <option value="06"
                                                        {{ $updatedIncome->activationDate == '06' ? 'selected' : '' }}>
                                                        Juin</option>
                                                    <option value="07"
                                                        {{ $updatedIncome->activationDate == '07' ? 'selected' : '' }}>
                                                        Juillet</option>
                                                    <option value="08"
                                                        {{ $updatedIncome->activationDate == '08' ? 'selected' : '' }}>
                                                        Août</option>
                                                    <option value="09"
                                                        {{ $updatedIncome->activationDate == '09' ? 'selected' : '' }}>
                                                        Septembre</option>
                                                    <option value="10"
                                                        {{ $updatedIncome->activationDate == '10' ? 'selected' : '' }}>
                                                        Octobre</option>
                                                    <option value="11"
                                                        {{ $updatedIncome->activationDate == '11' ? 'selected' : '' }}>
                                                        Novembre</option>
                                                    <option value="12"
                                                        {{ $updatedIncome->activationDate == '12' ? 'selected' : '' }}>
                                                        Décembre</option>
                                                    <option value="00"
                                                        {{ $updatedIncome->activationDate == '00' ? 'selected' : '' }}>
                                                        Autre</option>
                                                </select>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12" id="fixedAmountArea">
                                    @if (!is_null($updatedIncome->fixedAmount))
                                        <div class="form-group">
                                            <label for="fixedAmount" class="form-label">Montant Fixe</label>
                                            <input type="number" min="0" step=".1" id="fixedAmount" name="fixedAmount" class="form-control" value={{$updatedIncome->fixedAmount}} required>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button name="updateIncome" type="submit" class="btn btn-warning">Modifier</button>
                                    <button name="reset" type="reset" class="btn btn-secondary">Reset</button>
                                    <a href="{{ route('typeIncome') }}">
                                        <button type="button" class="btn btn-secondary">
                                            Annuler
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#checkActivation').click(function() {
                if ($('#checkActivation').is(':checked'))
                    $('#activationDate').prop('disabled', false);
                else
                    $('#activationDate').prop('disabled', true);
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
