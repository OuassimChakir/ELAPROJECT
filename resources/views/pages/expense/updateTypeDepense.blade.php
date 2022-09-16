@extends('layouts.layout')
@section('title')
        Modifier le Type de Dépense
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
                            <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="parent-category" class="form-label">Description</label> 
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">
                                        {{$updatedExpense->description}}
                                    </textarea>
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