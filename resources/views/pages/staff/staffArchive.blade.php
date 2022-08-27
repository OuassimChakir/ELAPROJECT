@extends('layouts.layout')
@section('title')
   Archive des Staff
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
<h1>Archive des Staff</h1>
<p class="breadcrumbs"><span><a href="{{route('acceuil')}}">Acceuil</a></span>
<span><i class="mdi mdi-chevron-right"></i></span>Archive des Staff
</p>
</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="ec-vendor-list card card-default"> 
            <div class="card-body">
                <form action="{{route('staff.archive.multiple')}}" method="post">
                    @csrf
                    @method('post')
                    <table id="responsive-data-table" class="table">
                        <thead>
                            <tr>
                                @if ($staffs->count()!=0)
                                    <th><input type="checkbox" class="form-check-input" id="selectAllArchived"></th>
                                @endif
                                <th>Nom</th>
                                <th>CINE</th>
                                <th>Spécialité</th>
                                <th>Date d'engagement</th>
                                <th>Supprimé le</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($staffs as $staff)
                                <tr>
                                    <td><input type="checkbox" name="archivedStaff[]" value="{{$staff->idStaff}}" class="form-check-input archivedStudents"></td>
                                    <td>
                                        {{$staff->prenom}}
                                        {{$staff->nom}}
                                        @if ($staff->sexe == "M")
                                            <div class="badge badge-pill badge-info">M</div>
                                        @else
                                            <div class="badge badge-pill badge-purple">F</div>
                                        @endif
                                    </td>
                                    <td>{{$staff->cnie}}</td>
                                    <td>
                                        <div class="badge bg-dark">
                                            {{$staff->designation}}
                                        </div>
                                    </td>
                                    <td>{{$staff->dateEngagement}}</td>
                                    <td>{{$staff->DELETED_AT}}</td>
                                    <td>
                                        <div class="">
                                            <a href="{{route('staff.archive.profil',['idStaff' => $staff->idStaff])}}">
                                                <button type="button" name="show" class="btn btn-outline-info" value="{{$staff->idStaff}}">
                                                    <i class="bi bi-person-fill"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('staff.archive.restore',['idStaff' => $staff->idStaff])}}">
                                                <button type="button" name="show" class="btn btn-outline-success" value="{{$staff->idStaff}}" onclick="return confirm('Vous êtes sûr?');">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('staff.archive.delete',['idStaff'=>$staff->idStaff])}}">
                                                <button type="button" class="btn btn-outline-danger" name="delete" value="{{$staff->idStaff}}" onclick="return confirm('Voulez-vous supprimer définitivement ce Professeur?');">
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