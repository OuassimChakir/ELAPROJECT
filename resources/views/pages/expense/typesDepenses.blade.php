@extends('layouts.layout')
@section('title')
       Type Dépenses
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Dépenses</h1>
        <p class="breadcrumbs">
            <span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Dépenses
        </p>
    </div>

        <div>
            <button type="button" class="btn btn-primary" id="showFormButton">
                <i class="bi bi-plus-square"></i> Ajouter une Dépenses
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
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body" id="formSection">
                    <div class="ec-cat-form">
                        <h4>Ajouter une Dépenses</h4>

                        <form action="{{route('typeDepenses.add')}}" method="post">
                            @csrf
                            @method('post')
                            <div class="row">
                            <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="text" class="form-label">Designation</label> 
                                <div class="col">
                                    <input id="libelle" name="designation" class="form-control" type="text" required>
                                </div>
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="text" class="form-label">Code</label> 
                                <div class="col">
                                    <input id="short" name="code" class="form-control" type="text">
                                    <small class="text-muted">Professeurs: <b>000</b> -- Staff: <b>111</b> </small>
                                </div>
                               
                            </div>
                            </div>
                            <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="parent-category" class="form-label">Description</label> 
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            </div>
                           </div>
                            <div class="row">
                                <div class="col-12">
                                    <button name="ajouterexpense" type="submit" class="btn btn-primary">Ajouter</button>
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
                        <table id="responsive-data-table"  class="table">
                            <thead>
                                <tr>
                                    <th>Designation</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($expenses))

                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td>{{$expense->designation}} </td>
                                            <td>{{$expense->description}}</td>
                                            <td>
                                                <div class="btn-group-spaced">
                                                    <a href="{{route('typeDepenses.update.page',['idExpense'=>$expense->idExpense])}}">
                                                        <button type="submit" name="edit" class="btn btn-outline-warning">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('typeDepenses.delete',['idExpense'=>$expense->idExpense])}}">
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