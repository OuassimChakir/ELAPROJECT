@extends('layouts.layout')
@section('title')
   liste des Etudiants
@endsection
@section('content')

<link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
  <!--message success -->
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
  @endif
  <!-- end errour du validation -->
<div class="breadcrumb-wrapper breadcrumb-contacts">
<div>
<h1>Etudiants</h1>
<p class="breadcrumbs"><span><a href="{{route('acceuil')}}">Acceuil</a></span>
<span><i class="mdi mdi-chevron-right"></i></span>Etudiants
</p>
</div>
<div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser"> <i class="bi bi-plus-square"></i> Ajouter un Etudiant
</button>
</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="ec-vendor-list card card-default">
            <div class="card-body">
                <form action="{{route('student.delete.multiple')}}" method="post">
                    @csrf
                    @method('delete')
                    <table id="responsive-data-table" class="table">
                        <thead>
                            @if ($students->count()!=0)
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAllArchived">
                                </th>
                            @endif
                            <th>#</th>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>Inscrie</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="students[]" value="{{$student->matricule}}" class="form-check-input archivedStudents">
                                    </td>
                                    <td>{{$student->matricule}}</td>
                                    <td>
                                        {{$student->prenom_fr}}
                                        {{$student->nom_fr}}
                                        @if ($student->sexe == "Homme")
                                            <span class="badge badge-pill badge-info">M</span>
                                        @else
                                            <span class="badge badge-pill badge-purple">F</span>
                                        @endif
                                    </td>
                                    <td>{{$student->numTel}}</td>
                                    <td>{{$student->CREATED_AT}}</td>                        
                                    <td>
                                        <div class="btn-group-spaced">
                                            <button type="button" class="add2GroupBtn btn btn-outline-success" value="{{$student->matricule}}" data-bs-toggle="modal" data-bs-target="#add2Group" data-toggle="tooltip" data-placement="right" title="Ajouter au Groupe">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>

                                            <a href="{{route('student.profil',['matricule' => $student->matricule])}}">
                                                <button type="button" name="show" class="btn btn-outline-info" value="{{$student->matricule}}">
                                                    <i class="bi bi-person-fill"></i>
                                                </button>
                                            </a>
                                            <button type="button" name="delete" class="deleteButton btn btn-outline-danger" data-url="{{route('student.delete',['matricule'=>$student->matricule])}}" data-confirm="Veuillez confirmer votre opération" data-title="Êtes-vous sûr?" data-type="error">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col btns">
                            <button type="submit" name="deleteAll" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer définitivement ces Etudiants?');">
                                <i class="bi bi-trash-fill"></i> Supprimer Tous
                            </button>
                        </div>
                    </div>    
                </form> 
            </div>
        </div>
    </div>
</div>
<!-- Ajouter un student -->
@include('pages.students.add_student')
{{-- Ajouter au Groupe --}}
@include('pages.students.add2Group')
<script src="{{asset('JS/jquery.min.js')}}"></script>
<script src="{{asset('JS/sweetAlert.js')}}"></script>
<script>
    // Listen for click on toggle checkbox
    $('#selectAllArchived').click(function(event) {   
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;                        
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;                       
            });
        }
    });

    $(".btns").hide();
    $(":checkbox").click(function() {
        if($(this).is(":checked")) {
            $(".btns").show();
        } else {
            $(".btns").hide();
        }
    });
</script>
<script>
    $('.add2GroupBtn').click(function() {
        $('#idStudent').val($(this).val());
        $('#gradesSelect').find('option').remove();
        $('#groupsResult').find('div').remove();
        $("#subjectSelect").prop('selectedIndex',0);
    });
</script>

@endsection