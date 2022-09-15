@extends('layouts.layout')
@section('title')
        Dépenses
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

{{-- UPDATING SECTION --}}
@if (isset($updatedSubject))
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            <div class="card-body">
                <div class="ec-cat-form">
                        <h4>Modifier une Matière</h4>
{{--                        <form action="{{route('subjects.update',['idSubject' => $updatedSubject->idSubject])}}" method="put">
                            @method('put')
                            @csrf
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Libelle</label> 
                                <div class="col-12">
                                    <input id="libelle" name="libelle" class="form-control" type="text" value="{{$updatedSubject->libelle}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Abréviation</label> 
                                <div class="col-12">
                                    <input id="short" name="short" class="form-control" type="text" value="{{$updatedSubject->short}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="parent-category" class="col-12 col-form-label">Type de Formation</label> 
                                <div class="col-12">
                                    <select id="courseType" name="courseType" class="custom-select" required>
                                        <option disabled>-- Choisir le Type de Formation du Matière --</option>
                                        @foreach ($courses as $course)
                                            @if ($course->idCourseType == $updatedSubject->idSubject)
                                                <option value="{{$course->idCourseType}}" selected>{{$course->course}}</option>
                                            @else
                                                <option value="{{$course->idCourseType}}">{{$course->course}}</option>
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if (isset($updatedSubject))
                                <input type="hidden" name="idSubject" value="{{$updatedSubject->idSubject}}">
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    <button name="update" type="submit" class="btn btn-warning">Modifier</button>
                                        <button name="reset" type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="{{route('subjects')}}">
                                            <button type="button" class="btn btn-secondary">
                                                Annuler
                                            </button>
                                        </a>
                                </div>
                            </div>
                        </form>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body" id="formSection">
                    <div class="ec-cat-form">
                        <h4>Ajouter une Dépenses</h4>

                        <form action="{{route('expenses.add')}}" method="post">
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
                                    <input id="short" name="code" class="form-control" type="text" required>
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
                          {{--  @if (isset($updatedSubject))
                                <input type="hidden" name="idSubject" value="{{$updatedSubject->idSubject}}">
                            @endif--}}
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
                    <div class="table-responsive">
                        <table id="responsive-data-table"  class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Designation</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($expenses))

                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td>{{$expense->idExpense}}</td>
                                            <td>{{$expense->designation}} <div class="badge badge-pill badge-primary">{{strtoupper($expense->short)}}</div></td>
                                            <td>{{$expense->description}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{url('/expenses/update/'.$expense->idExpense)}}">
                                                        <button type="submit" name="edit" class="btn btn-outline-warning" value="{{$expense->idExpense}}">
                                                            <i class="bi bi-pencil-square"></i>
                                                            
                                                        </button>
                                                    </a>
                                                    <a href="{{url('/expenses/delete/'.$expense->idExpense)}}">
                                                        <button type="submit" class="btn btn-outline-danger" name="deleteExpense" value="{{$expense->idExpense}}" onclick="return confirm('Vous êtes sûr?');">
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
    <script src="{{asset('JS/jquery.min.js')}}"></script>
    <script src="{{asset('Bootstrap/js/bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#showFormButton").click(function(){
                $("#formSection").slideToggle();
            });
        });
    </script>
@endif
@endsection