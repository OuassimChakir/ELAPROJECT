@extends('layouts.layout')
@section('title')
        Modifier le Type de Dépenses
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Types de Dépenses</h1>
        <p class="breadcrumbs">
            <span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span><a href="{{route('typeDepenses')}}">Types de Dépenses</a>
            <span><i class="mdi mdi-chevron-right"></i></span>Modification
        </p>
    </div>

        <div>
            <a href="{{route('typeDepenses')}}">
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
                    @if (isset($updatedExpense))
                    <form action="{{route('typeDepenses.update',['idExpense' => $updatedExpense->idExpense])}}" method="post">
                       @csrf  
                       @method('put')   
                        <div class="row">
                            <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="text" class="form-label">Designation</label> 
                                <div class="col">
                                    <input id="libelle" name="designation" value="{{$updatedExpense->designation}}" class="form-control" type="text" required>
                                </div>
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="text" class="form-label">Code</label> 
                                <div class="col">
                                    <input id="short" name="code" value="{{$updatedExpense->code}}" class="form-control" type="text">
                                    <small class="text-muted">Professeurs: <b>000</b> -- Staff: <b>111</b> </small>
                                </div>
                               
                            </div>
                            </div>

                           </div>
                        <div class="row">
                            <div class="col-12">
                                <button name="updateExpense" type="submit" class="btn btn-warning">Modifier</button>
                                    <button name="reset" type="reset" class="btn btn-secondary">Reset</button>
                                    <a href="{{route('typeDepenses')}}">
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
    <script src="{{asset('JS/jquery.min.js')}}"></script>
    <script src="{{asset('Bootstrap/js/bootstrap.min.js')}}"></script>
@endsection