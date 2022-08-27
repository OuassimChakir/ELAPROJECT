@extends('layouts.layout')
@section('title')
   Archive des Etudiants
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
  <!--message success -->
  @if (session()->has('restoreMessage'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{session()->get('restoreMessage')}}
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
  <!-- end errour du validation -->
<div class="breadcrumb-wrapper breadcrumb-contacts">
<div>
<h1>Archive des Etudiants</h1>
<p class="breadcrumbs"><span><a href="{{route('acceuil')}}">Acceuil</a></span>
<span><i class="mdi mdi-chevron-right"></i></span>Archive des Etudiants
</p>
</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="ec-vendor-list card card-default"> 
            <div class="card-body">
                <form action="{{route('student.archive.multiple')}}" method="post">
                    @csrf
                    @method('post')
                    <table id="responsive-data-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="form-check-input" id="selectAllArchived"></th>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Téléphone</th>
                                <th>Inscrie le</th>
                                <th>Supprimé le</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td><input type="checkbox" name="archivedStudents[]" value="{{$student->matricule}}" class="form-check-input archivedStudents"></td>
                                    <td>{{$student->matricule}}</td>
                                    <td>{{$student->nom_fr}}</td>
                                    <td>{{$student->prenom_fr}}</td>
                                    <td>{{$student->numTel}}</td>
                                    <td>{{$student->CREATED_AT}}</td>
                                    <td>{{$student->deleted_at}}</td>
                                    <td>
                                        <div class="">
                                            <a href="{{route('student.archive.profil',['matricule' => $student->matricule])}}">
                                                <button type="button" name="show" class="btn btn-outline-info" value="{{$student->matricule}}">
                                                    <i class="bi bi-person-fill"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('student.archive.restore',['matricule' => $student->matricule])}}">
                                                <button type="button" name="show" class="btn btn-outline-success" value="{{$student->matricule}}" onclick="return confirm('Vous êtes sûr?');">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('student.archive.delete',['matricule'=>$student->matricule])}}">
                                                <button type="button" class="btn btn-outline-danger" name="delete" value="{{$student->matricule}}" onclick="return confirm('Voulez-vous supprimer définitivement cet étudiant?');">
                                                        <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col btns">
                            <button type="submit" name="restoreAll" class="btn btn-outline-success" onclick="return confirm('Vous êtes sûr?');">
                                <i class="bi bi-arrow-repeat"></i> Restaurer la Sélection
                            </button>
                            <button type="submit" name="deleteAll" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer définitivement ces étudiants?');">
                                <i class="bi bi-trash-fill"></i> Supprimer la Sélection
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('JS/jquery.min.js')}}"></script>
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
    $(document).ready(function() {
        $('#responsive-data-table tr').click(function(event) {
            if (event.target.type !== 'checkbox') {
                $(':checkbox', this).trigger('click');
            }
        });
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

@endsection