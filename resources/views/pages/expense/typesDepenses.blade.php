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
                                <label for="parent-category" class="form-label">Designation</label> 
                                    <textarea class="form-control" name="designation" id="exampleFormControlTextarea1" rows="1"></textarea>
                            </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="code">code</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                      <input class="form-check-input mt-0" type="checkbox" id="Checkbox" value="true" aria-label="Checkbox for following text input">
                                    </div>
                                    <input type="text" class="form-control" id="code" name="code" aria-label="Text input with checkbox" disabled>
                                  </div>
                                  <small><b>0</b>: Staff <b>1</b>: Professeur</small>
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
                                    <th>#</th>
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($expenses))

                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td>{{$expense->idExpense}}</td>
                                            <td>{{$expense->designation}}</td>
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

        $(document).on('click','#Checkbox', function() {
                var checkbox = $(this);
                if(checkbox.is(':checked')){
                    $('#code').prop('disabled',false);
                    $('#code').prop('value','0');
                }
                if(checkbox.is(':checked') == false){
                    $('#code').prop('disabled',true);
                    $('#code').prop('value',"Nulle");
                }
            });
    </script>
    
@endsection