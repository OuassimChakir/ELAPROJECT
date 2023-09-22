@extends('layouts.layout')
@section('title')
    Liste des Groupes
@endsection
@section('content')
  <!--errour du validation -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  <!-- end errour du validation -->
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Liste des Groupes</h1>
        <p class="breadcrumbs">
            <span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Groupes
        </p>
    </div>
    @staff
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#addUser"><i class="bi bi-plus-square"></i> Créer un Groupe
        </button>
    </div>
    @endstaff
</div>
<div class="row">
<div class="col-12">
<div class="ec-vendor-list card card-default">
<div class="card-body">
    @staff
    <form action="" method="POST">
        @method('delete')
        @csrf
        <table id="responsive-data-table" class="table">
            <thead>
                <tr>
                    @if ($groupes->count()!=0)
                        <th>
                            <input type="checkbox" class="form-check-input" id="selectAllArchived">
                        </th>
                    @endif
                    <td></td>
                    <th>Designation</th>
                    <th>Matière</th>
                    <th>Professeur</th>
                    <th>Prix/Etudiant</th>
                    <th>Date du Creation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($groupes))
                    @foreach ($groupes as $groupe)
                    <tr>
                        <td>
                            <input type="checkbox" name="groupes[]" value="{{$groupe->idGroup}}" class="form-check-input archivedStudents">
                        </td>
                        <td>
                            @if ($groupe->pendingPaiment == 0)
                                <span class="badge badge-success"><i class="bi bi-check-lg"></i></span>
                            @else
                                <span class="badge badge-danger">{{ $groupe->pendingPaiment }} <i class="bi bi-hourglass"></i></span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('groups.profil',['idGroup'=>$groupe->idGroup])}}">{{$groupe->designation}}</a>
                            @if ($groupe->nbElements == $groupe->capacity)
                                <div class="badge badge-pill badge-warning">{{$groupe->nbElements}}/{{$groupe->capacity}}</div><br>
                            @else
                                <div class="badge badge-pill badge-success">{{$groupe->nbElements}}/{{$groupe->capacity}}</div><br>
                            @endif
                            <small>{{$groupe->course}}</small>
                        </td>
                        <td><div class="badge bg-dark">{{$groupe->libelle}}</div></td>
                        <td><a href="{{route('teachers.profil',['idProfesseur' => $groupe->idProfesseur])}}">{{$groupe->prenom.' '.$groupe->nom}}</a></td>
                        <td><div class="badge bg-primary">{{$groupe->amount}} DH</div></td>
                        <td>{{$groupe->created_at}}</td>
                        @staff
                        <td>                           
                                <div class="btn-group">
                                    <a href="{{route('groups.profil',['idGroup'=>$groupe->idGroup])}}">
                                        <button type="button" name="edit" class="btn btn-outline-info">
                                            <i class="bi bi-collection"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('groups.delete',['idGroup'=>$groupe->idGroup])}}">
                                        <button type="button" class="btn btn-outline-danger" name="delete" onclick="return confirm('Vous êtes sûr?');">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </a>
                                </div>
                        </td>
                        @else
                        <td>                           
                            <a href="{{route('groups.profil',['idGroup'=>$groupe->idGroup])}}">
                                <button type="button" name="edit" class="btn btn-outline-info">
                                    <i class="bi bi-collection"></i>
                                </button>
                            </a>
                        </td>
                        @endstaff
                    </tr>
                    @endforeach
                @endif
                
            </tbody>
        </table>
        <div class="row">
            <div class="col btns">
                <button type="submit" name="deleteAll" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer définitivement ces Professeurs?');">
                    <i class="bi bi-trash-fill"></i> Supprimer la Sélection
                </button>
            </div>
        </div>    
    </form>
    @else
    <table id="responsive-data-table" class="table">
        <thead>
            <tr>
                <th>Designation</th>
                <th>Matière</th>
                <th>Professeur</th>
                <th>Prix/Etudiant</th>
                <th>Date du Creation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($groupes))
                @foreach ($groupes as $groupe)
                <tr>
                    <td>
                        <a href="{{route('groups.profil',['idGroup'=>$groupe->idGroup])}}">{{$groupe->designation}}</a>
                        @if ($groupe->nbElements == $groupe->capacity)
                            <div class="badge badge-pill badge-warning">{{$groupe->nbElements}}/{{$groupe->capacity}}</div><br>
                        @else
                            <div class="badge badge-pill badge-success">{{$groupe->nbElements}}/{{$groupe->capacity}}</div><br>
                        @endif
                        <small>{{$groupe->course}}</small>
                    </td>
                    <td><div class="badge bg-dark">{{$groupe->libelle}}</div></td>
                    <td><a href="{{route('teachers.profil',['idProfesseur' => $groupe->idProfesseur])}}">{{$groupe->prenom.' '.$groupe->nom}}</a></td>
                    <td><div class="badge bg-primary">{{$groupe->amount}} DH</div></td>
                    <td>{{$groupe->created_at}}</td>
                    @staff
                    <td>                           
                            <div class="btn-group">
                                <a href="{{route('groups.profil',['idGroup'=>$groupe->idGroup])}}">
                                    <button type="button" name="edit" class="btn btn-outline-info">
                                        <i class="bi bi-collection"></i>
                                    </button>
                                </a>
                                <a href="{{route('groups.delete',['idGroup'=>$groupe->idGroup])}}">
                                    <button type="button" class="btn btn-outline-danger" name="delete" onclick="return confirm('Vous êtes sûr?');">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </a>
                            </div>
                    </td>
                    @else
                    <td>                           
                        <a href="{{route('groups.profil',['idGroup'=>$groupe->idGroup])}}">
                            <button type="button" name="edit" class="btn btn-outline-info">
                                <i class="bi bi-collection"></i>
                            </button>
                        </a>
                    </td>
                    @endstaff
                </tr>
                @endforeach
            @endif
            
        </tbody>
    </table>
    @endstaff   
</div>
</div>
</div>
</div>

<!-- Ajouter un teacher -->
@include('pages.groupes.add_group')
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