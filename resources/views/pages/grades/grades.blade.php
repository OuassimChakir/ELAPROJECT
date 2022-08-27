@extends('layouts.layout')
@section('title')
    Niveaux
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Niveaux</h1>
        <p class="breadcrumbs">
            <span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Niveaux
        </p>
    </div>
    <div>
        <button type="button" class="btn btn-primary" id="showFormButton">
            <i class="bi bi-plus-square"></i> Ajouter un Niveau
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
@elseif(session()->has('updateGrade'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{session()->get('updateGrade')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            <div class="card-body" id="formSection">
                <div class="ec-cat-form">
                    @if (isset($updatedGrade))
                        <h4>Modifier un niveau</h4>
                        <form action="{{route('grades.update',['idGrade' => $updatedGrade->idGrade])}}" method="put">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="parent-category" class="col-12 col-form-label">Catégories</label> 
                                <div class="col-12">
                                    <select id="gradeCategory" name="gradeCategory" class="custom-select" required>
                                        <option selected disabled>-- Choisir la Categorie du Niveau --</option>
                                        @foreach ($gradeCategories as $gradeCategory)
                                            @if ($gradeCategory->idGradeCategory == $updatedGrade->idGradeCategory)
                                                <option value="{{$gradeCategory->idGradeCategory}}" selected>
                                                    {{$gradeCategory->category}}
                                                </option>
                                            @else
                                                <option value="{{$gradeCategory->idGradeCategory}}">
                                                    {{$gradeCategory->category}}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Niveau</label> 
                                <div class="col-12">
                                    <input id="text" name="grade" class="form-control" type="text" value="{{$updatedGrade->grade}}">
                                </div>
                            </div>
                            <input type="hidden" name="idGrade" value="{{$updatedGrade->idGrade}}">
                            <div class="row">
                                <div class="col-12">
                                    <button name="update" type="submit" class="btn btn-warning">Modifier</button>
                                        <button name="reset" type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="{{route('grades')}}">
                                            <button type="button" class="btn btn-secondary">
                                                Annuler
                                            </button>
                                        </a>
                                </div>
                            </div>
                        </form>
                    @else
                            <h4 id="sectionTitle">Ajouter un niveau</h4>
                            <form action="{{route('grades.add')}}" method="post">
                                @csrf
                                @method('post')
                                <div class="form-group row">
                                    <label for="parent-category" class="col-12 col-form-label">Catégories</label> 
                                    <div class="col-12">
                                        <select id="gradeCategory" name="gradeCategory" class="custom-select" required>
                                            <option selected disabled>-- Choisir la Categorie du Niveau --</option>
                                            @foreach ($gradeCategories as $gradeCategory)
                                                <option value="{{$gradeCategory->idGradeCategory}}">{{$gradeCategory->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Niveau</label> 
                                    <div class="col-10">
                                        <input id="text" name="grade[]" class="form-control" type="text">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="addInput btn btn-info">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="field_wrapper">
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button name="addGrade" type="submit" class="btn btn-primary">Ajouter</button>
                                        <button name="Reset" type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@if (!isset($updatedGrade))
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default">
            <div class="card-body">
                <small>Choisir par Catégorie du niveau</small>
                <div class="ec-cat-form">
                        <form>
                            <div class="form-group row">
                                <div class="col-8">
                                    <select id="gradeCategory" name="gradeCategory" class="custom-select" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" required>
                                        <option selected disabled>-- Choisir la Categorie du Niveau --</option>
                                        @foreach ($gradeCategories as $gradeCategory)
                                            <option value="{{route('grades',['idGradeCategory' => $gradeCategory->idGradeCategory])}}">{{$gradeCategory->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($flag == 1)
                                    <div class="col-4">
                                        <a href="{{route('grades')}}">
                                            <button class="btn btn-secondary">Retourner</button>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </form>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Niveau</th>
                                <th>Categorie</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($grades))
                                @foreach ($grades as $grade)
                                    <tr>
                                        <td>{{$grade->idGrade}}</td>
                                        <td>{{$grade->grade}}</td>
                                        <td><div class="badge bg-dark">{{$grade->category}}</div></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{url('/niveau/update/'.$grade->idGrade)}}">
                                                    <button type="submit" name="edit" class="btn btn-outline-warning" value="{{$grade->idGrade}}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </a>
                                                <a href="{{url('/niveau/delete/'.$grade->idGrade)}}">
                                                    <button type="submit" class="btn btn-outline-danger" name="delete" value="{{$grade->idGrade}}" onclick="return confirm('Vous êtes sûr?');">
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
                    {{ $grades->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif



<script src="{{asset('JS/jquery.min.js')}}"></script>
<script src="{{asset('Bootstrap/js/bootstrap.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#showFormButton").click(function(){
            $("#formSection").slideToggle();
        });
    });

    $(document).ready(function(){
        
        var maxField = 10; //Input fields increment limitation
        var addInput = $('.addInput'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="form-group row">'; //New input field html 
            fieldHTML += '<div class="col-10"><input id="text" name="grade[]" class="form-control" type="text"></div>';
            fieldHTML += '<div class="col-2"><button type="button" class="btn btn-danger removeInput"><i class="bi bi-trash"></i></button></div>';
            fieldHTML += '</div>';
        var x = 1; //Initial field counter is 1
        //Once add button is clicked
        $(addInput).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.removeInput', function(e){
            e.preventDefault();
            $(this).parentsUntil('.field_wrapper').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
@endsection

