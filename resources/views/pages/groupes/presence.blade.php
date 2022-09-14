@extends('layouts.layout')
@section('title')
   Absence
@endsection
@section('content')
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
    @elseif(session()->has('successMessage'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session()->get('successMessage')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Presence</h1>
            <p class="breadcrumbs">
                <span><a href="{{route('acceuil')}}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span><a href="{{route('groups')}}">Groupes</a>
            </p>
        </div>
    </div>


    <div class="card bg-white profile-content">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="profile-content-right profile-right-spacing py-5">
                                     <div class="tab-content px-3 px-xl-5" id="myTabContent">
                                        <div class="modal-body px-4">
                                            <form action="{{route('absence.add')}}" method="post">
                                                @csrf
                                                @method('post')
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <div class="form-group ">
                                                            <label for="form-label">Groupes</label>
                                                            <select name="idGroup" id="id-Group" class="form-select" required>
                                                            <option disabled selected>-- Choisir un Groupe --</option>
                                                                @foreach($allGroups as $allGroup)
                                                                <option value="{{ $allGroup->idGroup }}">
                                                                    {{ $allGroup->designation}}
                                                                </option>    
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                        <label for="form-label">Date</label>
                                                            <input type="date" name="dateAbsence" id="dateabsence" class="form-select" value="{{date('Y-m-d')}}"> 
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mt-5">
                                                        <button type="submit" name="getAbsence" class="btn btn-secondary btn-pill">Recherche</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                            </div>
                                @if (isset($etudiants))
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="tab-pane-content m-5">
                                         <form action="" method="PUT">
                                            @csrf
                                            @method('put')
                                            <table id="responsive-data-table" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nom</th>
                                                        <th>Etat d'absence</th>
                                                        <th>Date Absence</th>
                                                        <th>Actoin</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($etudiants as $etudiant)
                                                        <tr>
                                                            <td>{{$etudiant->matricule}}</td>
                                                            <td>{{$etudiant->prenom_fr.' '.$etudiant->nom_fr}}
                                                                @if ($etudiant->sexe == "Homme")
                                                            <span class="badge badge-pill badge-info">M</span>                                                
                                                            @else
                                                                <span class="badge badge-pill badge-purple">F</span>
                                                            @endif
                                                            </td>
                                                            <td>
                                                            @if ($etudiant->absence == 0)
                                                            <span class="badge badge-pill badge-success">Present</span
                                                            @elseif($etudiant->absence == 1)
                                                                <span class="badge badge-pill badge-danger">Absent(e)</span>
                                                            @else
                                                            <span class="badge badge-pill badge-warning">Justifiée</span>
                                                            @endif
                                                            </td>
                                                            <td>{{$etudiant->dateAbsence}}</td>
                                                            <input type="hidden" name="idGroup" data-bs-target="#idGroup" id="idGroup" value="{{$etudiant->idGroup}}">
                                                            <td>                                                    <a href="{{url('/absence/update/'.$etudiant->idAttendance)}}">
                                                                <button type="submit" name="edit" class="btn btn-outline-warning" value="{{$etudiant->idAttendance}}">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                    
                                                                </button>
                                                            </a></td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                         </form>

                                        </div>
                                    </div>
                                </div>
                                @endif
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- Modifier l'absence --}}
@include('pages.groupes.modifierAbsence')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('JS/sweetAlert.js')}}"></script>
    
   
    </script>
    <script>
        $('.add2GroupBtn').click(function() {
            $('#idStudent').val($(this).val());
            $('#idGroup').val($(this).val());
           
        });
    </script>
    
    
@endsection