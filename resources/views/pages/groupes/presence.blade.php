@extends('layouts.layout')
@section('title')
   Absence
@endsection
@section('content')


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
                                                                    @if (isset($etudiants))
                                                                        @if ($etudiants[0]->idGroup == $allGroup->idGroup)
                                                                            <option value="{{ $allGroup->idGroup }}" selected>
                                                                                {{ $allGroup->designation}}
                                                                            </option>   
                                                                        @else
                                                                            <option value="{{ $allGroup->idGroup }}">
                                                                                {{ $allGroup->designation}}
                                                                            </option>  
                                                                        @endif
                                                                    @else
                                                                        <option value="{{ $allGroup->idGroup }}" selected>
                                                                            {{ $allGroup->designation}}
                                                                        </option>  
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                        <label for="form-label">Date</label>
                                                            @if (isset($etudiants))
                                                                <input type="date" name="dateAbsence" id="dateabsence" class="form-select" value="{{$etudiants[0]->dateAbsence}}"> 
                                                            @else
                                                                <input type="date" name="dateAbsence" id="dateabsence" class="form-select" value="{{date('Y-m-d')}}"> 
                                                            @endif
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
                                                                <div class="absenceStatue">
                                                                @if ($etudiant->absence == 0)
                                                                    <span class="badge badge-pill badge-success">Present</span
                                                                @elseif($etudiant->absence == 1)
                                                                        <span class="badge badge-pill badge-danger">Absent(e)</span>
                                                                @else
                                                                    <span class="badge badge-pill badge-warning">Justifiée</span>
                                                                @endif
                                                                </div>
                                                            </td>
                                                            <td>{{$etudiant->dateAbsence}}</td>
                                                            <input type="hidden" name="idGroup" data-bs-target="#idGroup" id="idGroup" value="{{$etudiant->idGroup}}">
                                                            <td>                                                    
                                                                <button type="button" name="editAbsence" class="editAbsence btn btn-outline-warning" value="{{$etudiant->idAttendance}}|{{$etudiant->absence}}">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn btn-outline-success" id="saveButton" onclick="window.location.reload();">
                                                <i class="bi bi-save-fill"></i> Enregistrer les Modifications
                                             </button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
   
    </script>
    <script>
        $('.add2GroupBtn').click(function() {
            $('#idStudent').val($(this).val());
            $('#idGroup').val($(this).val());
        });
        $('#saveButton').hide();
    $(document).ready(function(){
        
        $('.editAbsence').click(function(){
            var absence = $(this).val().split('|')[1];
            $(this).closest('tr').find('.absenceStatue').empty();
            var htmlOut = '<select name="absence" class="absenceState form-select form-control">';
                
            var option1 = option2 = option3 = '';
            if (absence == 0)
                option1 = 'selected';
            if(absence == 1)
                option2 = 'selected';
            if(absence == 2)
                option3 = 'selected';
            
            htmlOut += '<option value="0" '+option1+'>Présent</option>';
            htmlOut += '<option value="1" '+option2+'>Absent(e)</option>';
            htmlOut += '<option value="2" '+option3+'>Justifiée</option>';
            htmlOut += '</select>';
            $(this).closest('tr').find('.absenceStatue').append(htmlOut);
            $(this).prop('disabled',true);
            $(document).ready(function(){
                $('.absenceState').change(function(){
                    $('#saveButton').show();
                    var editButton = $(this).closest('tr').find('.editAbsence');
                    editButton.removeClass();
                    editButton.attr('class','cancelEditAbsence btn btn-warning');
                    editButton.empty();
                    editButton.append('<i class="bi bi-arrow-clockwise"></i>'); 
                    var etatAbsence = $(this).val();
                    var idAttendance = $(this).closest('tr').find('.btn').val().split('|')[0];
                    // AJAX request 
                    $.ajax({
                        url: '/absence/update/'+idAttendance+'-'+etatAbsence,
                        type: 'get',
                        dataType: 'json',
                        success: function(response){
                            editButton.removeClass();
                            editButton.attr('class','cancelEditAbsence btn btn-success');
                            editButton.empty();
                            editButton.append('<i class="bi bi-check-lg"></i>');    
                        },
                        fail: function (msg){
                            alert('fail');
                        },
                    });
                });  
            });
             
        });
        
        

        $('.cancelEditAbsence').click(function(){
            
        });
        
    });
    </script>
    
    
@endsection