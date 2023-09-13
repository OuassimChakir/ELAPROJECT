@extends('layouts.layout')
@section('title')
   {{$group->designation}}
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{$group->designation}}</h1>
            <p class="breadcrumbs">
                <span><a href="{{route('acceuil')}}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span><a href="{{route('groups')}}">Groupes</a>
                <span><i class="mdi mdi-chevron-right"></i></span>{{$group->designation}}
            </p>
        </div>
        <div>
            <a>
                <button type="button" class="deleteButton btn btn-outline-danger" data-url="/groupes/{{$group->idGroup}}" data-confirm="Une fois supprimé, vous ne pourrez plus récupérer ce groupe !" data-title="Êtes-vous sûr?" data-type="error">
                    <i class="bi bi-trash-fill"></i> Supprimer 
                </button>
            </a>
        </div>
    </div>


    <div class="card bg-white profile-content">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="profile-content-right profile-right-spacing py-5">
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                        {{--Informations--}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile" type="button" role="tab"
                                aria-controls="profile" aria-selected="true">Informations</button>
                        </li>
                        {{--Paramètres--}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab"
                                data-bs-target="#settings" type="button" role="tab"
                                aria-controls="settings" aria-selected="false">Paramètres</button>
                        </li>
                        {{--Absence--}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="absence-tab" data-bs-toggle="tab"
                                data-bs-target="#absence" type="button" role="tab"
                                aria-controls="absence" aria-selected="false">Absence</button>
                        </li>
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">

                        <div class="tab-pane fade show active" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class="tab-widget mt-5">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="media widget-media p-3 bg-white border">
                                            <div class="icon rounded-circle mr-3 bg-primary">
                                                <i class="bi bi-collection-fill text-white"></i>
                                            </div>

                                            <div class="media-body align-self-center">
                                                <h4 class="text-primary mb-2">{{$group->designation}}</h4>
                                                <p>Designation</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="media widget-media p-3 bg-white border">
                                            <div class="icon rounded-circle bg-warning mr-3">
                                                <i class="bi bi-person-video3 text-white"></i>
                                            </div>

                                            <div class="media-body align-self-center">
                                                <h4 class="text-primary mb-2">
                                                    <a href="{{route('teachers.profil',['idProfesseur'=>$group->idProfesseur])}}">
                                                        {{$group->prenom.' '.$group->nom}}
                                                    </a>
                                                </h4>
                                                <p>Encadrant</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="media widget-media p-3 bg-white border">
                                            <div class="icon rounded-circle mr-3 bg-success">
                                                <i class="bi bi-people-fill text-white"></i>
                                            </div>

                                            <div class="media-body align-self-center">
                                                <h4 class="text-primary mb-2">{{$group->nbElements}}/{{$group->capacity}}</h4>
                                                <p>Capacité</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="media widget-media p-3 bg-white border">
                                            <div class="icon rounded-circle mr-3 text-white bg-dark">
                                                <i class="bi bi-book-fill text-white"></i>
                                            </div>

                                            <div class="media-body align-self-center">
                                                <h4 class="text-primary mb-2">{{$group->short}}</h4>
                                                <p>Matière</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xl-6">
                                        <div class="media widget-media p-3 bg-white border">
                                            <div class="icon rounded-circle mr-3 bg-success">
                                                <i class="bi bi-calendar-date text-white"></i>
                                            </div>

                                            <div class="media-body align-self-center">
                                                <h4 class="text-primary mb-2">{{$group->created_at}}</h4>
                                                <p>Année de Creation</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="media widget-media p-3 bg-white border">
                                        <div class="icon rounded-circle bg-purple mr-3">
                                            <i class="bi bi-list-ol text-white"></i>
                                        </div>

                                        <div class="media-body align-self-center">
                                            <h4 class="text-primary mb-2">Niveaux</h4>
                                            <p>
                                                @foreach ($groupGrades as $grade)
                                                    <span class="badge badge-primary">{{$grade->grade}}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="tab-pane-content mt-5">
                                            <form action="{{route('classroom.multipleCancel')}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <table id="responsive-data-table" class="table">
                                                    <thead>
                                                        <tr>
                                                            @if ($students->count()!=0)
                                                                <th>
                                                                    <input type="checkbox" class="form-check-input" id="selectAllArchived">
                                                                </th>
                                                            @endif
                                                            <th>#</th>
                                                            <th>Nom</th>
                                                            <th>Téléphone</th>
                                                            <th>Rejoint le</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                    
                                                    <tbody>
                                                        @foreach ($students as $student)
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" name="students[]" value="{{$student->id}}" class="form-check-input archivedStudents">
                                                                </td>
                                                                <td>
                                                                    {{$student->matricule}}
                                                                </td>
                                                                <td>
                                                                    <a href="{{route('student.profil',['idStudent'=>$student->idStudent])}}">
                                                                        {{$student->prenom_fr}}
                                                                        {{$student->nom_fr}}
                                                                    </a>
                                                                    @if ($student->sexe == "Homme")
                                                                        <span class="badge badge-pill badge-info">M</span>
                                                                    @else
                                                                        <span class="badge badge-pill badge-purple">F</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{$student->numTel}}</td>
                                                                <td>{{$student->dateAjout}}</td>                        
                                                                <td>
                                                                    <div class="btn-group-spaced">
                                                                        <a href="{{route('classroom.cancelAssignment',['idElement'=>$student->idElement])}}">
                                                                            <button type="button" class="btn btn-outline-danger" name="delete" onclick="return confirm('Confirmer votre opération');">
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
                                                        <button type="submit" name="deleteAll" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer définitivement ces Professeurs?');" value="{{$group->idGroup}}">
                                                            <i class="bi bi-trash-fill"></i> Supprimer la Sélection
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab"> 
                            <div class="tab-pane-content mt-5">
                                <form action="{{route('groups.update',['idGroup'=>$group->idGroup])}}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="modal-header px-4">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Créer un Groupe</h5>
                                    </div>
                    
                                    <div class="modal-body px-4">
                                        <div class="row mb-2">
                    
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="capacity">Capacité du Groupe</label>
                                                    <input type="number" max="50" min="1" class="form-control" name="capacity" value="{{$group->capacity}}" id="capacity" required>
                                                </div>
                                            </div>
                    
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="capacity">Prix Individuel</label>
                                                    <input type="number" min="1" class="form-control" name="amount" id="amount" value="{{$group->amount}}" readonly>
                                                </div>
                                            </div>
                                            
                                            {{-- Staff --}}
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label for="form-label">Professeur Assigné</label>
                                                    <select name="idProfesseur" id="idProfesseur" class="form-select" required>
                                                        <option disabled selected>-- Choisir un Professeur --</option>
                                                        @foreach ($professeurs as $professeur)
                                                            @if ($group->idProfesseur == $professeur->idProfesseur)
                                                            <option value="{{ $professeur->idProfesseur }}" selected>
                                                            @else
                                                            <option value="{{ $professeur->idProfesseur }}">
                                                            @endif
                                                                {{ $professeur->prenom . ' ' . $professeur->nom }} | {{ $professeur->libelle }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                    
                                            {{-- Matières --}}
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label for="form-label">Matières</label>
                                                    <select name="idSubject" id="id-Subject" class="form-select" required>
                                                        <option disabled selected>-- Choisir une Matière --</option>
                                                        @foreach ($courseTypes as $courseType)
                                                            <optgroup label="{{ $courseType->course }}">
                                                                @foreach ($subjects as $subject)
                                                                    @if ($courseType->idCourseType == $subject->idCourseType)
                                                                        @if ($group->idSubject == $subject->idSubject)
                                                                        <option value="{{ $subject->idSubject }}" selected>
                                                                        @else
                                                                        <option value="{{ $subject->idSubject }}">
                                                                        @endif
                                                                            {{ $subject->libelle }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                    
                                            {{-- Grade Category --}}
                                            <div class="col-lg-12">
                                                <div class="form-group mb-4">
                                                    <label for="form-label">Catégories des Niveaux</label>
                                                    <select name="gradeCategory" id="gradeCategory" class="form-select" required>
                                                        <option disabled selected>-- Choisir une Catégorie -- </option>
                                                        @php
                                                            if(isset($groupGrades[0]))
                                                                $idGradeCategory = $groupGrades[0]->idGradeCategory;
                                                        @endphp
                                                        @foreach ($gradesCategories as $categorie)
                                                            @if (isset($idGradeCategory) && $categorie->idGradeCategory == $idGradeCategory)
                                                            <option value="{{ $categorie->idGradeCategory }}" selected>
                                                            @else
                                                            <option value="{{ $categorie->idGradeCategory }}">
                                                            @endif
                                                                {{$categorie->category}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                    
                                            <div class="col-lg-12">
                                                <div class="card p-2 mt-2">
                                                    <div class="card-title pl-3 pt-3">
                                                        <h5>Niveaux</h5>
                                                    </div>
                                                    <div class="card-body">
                                                            <table class="table table-bordered" id="gradesGenerationTable">
                                                                <tbody id="grades">
                                                                    @if (isset($groupGrades[0]))
                                                                    <tr>
                                                                        @for ($i = 1; $i <= count($grades); $i++)
                                                                        <div> 
                                                                            <td class="align-middle checkCol">
                                                                                @php
                                                                                foreach ($groupGrades as $item)
                                                                                    if ($item->idGrade == $grades[$i-1]->idGrade){
                                                                                        $flag = true;
                                                                                        break;
                                                                                    }
                                                                                    else
                                                                                        $flag = false
                                                                                
                                                                                @endphp
                                                                                @if ($flag)
                                                                                <input type="checkbox" class="form-check-input form-control" id="grade{{$i}}" name="grades[]" value="{{$grades[$i-1]->idGrade}}" checked> 
                                                                                @else
                                                                                <input type="checkbox" class="form-check-input form-control" id="grade{{$i}}" name="grades[]" value="{{$grades[$i-1]->idGrade}}"> 
                                                                                @endif
                                                                            </td> 
                                                                            <td class="infoCol">
                                                                                <label for="grade{{$i}}">
                                                                                    {{$grades[$i-1]->grade}}
                                                                                </label>
                                                                            </td>
                                                                        </div>
                                                                    @if ($i == count($grades))
                                                                    </tr>
                                                                    @elseif($i%3 == 0)
                                                                    </tr>
                                                                    <tr>   
                                                                    @endif
                                                                        @endfor
                                                                        
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                    </div>
                                                </div>
                                            </div>
                    
                    
                                        </div>
                                    </div>
                                    <div class="modal-footer px-4">
                                        <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="updateGroup" class="btn btn-warning btn-pill">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{--Absence--}}
                        <div class="tab-pane fade" id="absence" role="tabpanel" aria-labelledby="absence-tab">
                            <div class="tab-pane-content mt-5">
                            <table id="responsive-data-table" class="table">
                             <div class="col-3 input-group-date">
                            <form method="POST" action="{{url('/absence/ajout/{idGroup}')}}">
                                @csrf
                                @method('post')
                             <input type="date" name="dateAbsence" class="form-control" value="{{date('Y-m-d')}}"> 
                             <input type="hidden" name="idGroup" class="form-control" value="{{$group->idGroup}}">  
                             </div>
                                    <thead>
                                        <tr>
                                            @if ($students->count()!=0)
                                                <th>
                                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                                </th>
                                            @endif
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input students">
                                                </td>
                                                <td>
                                                    {{$student->matricule}}
                                                    <input type="hidden" name="matricule[]" class="form-control" value="{{$student->matricule}}">  
                                                </td>
                                                <td>
                                                    <a href="{{route('student.profil',['idStudent'=>$student->idStudent])}}">
                                                        {{$student->prenom_fr}}
                                                        {{$student->nom_fr}}
                                                    </a>
                                                    @if ($student->sexe == "Homme")
                                                        <span class="badge badge-pill badge-info">M</span>
                                                    @else
                                                        <span class="badge badge-pill badge-purple">F</span>
                                                    @endif
                                                </td>                     
                                                <td>
                                                    <select name="absence[]" id="id-Subject" class="absenceState form-select form-control" required>
                                                        <option value="0">
                                                            Présent
                                                        </option>
                                                        <option value="1">
                                                               Absent 
                                                        </option>
                                                        <option value="2">
                                                           Justifié
                                                        </option>                                                           
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" name="addabssence" class="btn btn-primary btn-pill">Marquée L'absence</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.students.add2Group')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('JS/sweetAlert.js')}}"></script>
    @if (!isset($groupGrades[0]))
        <script>
            $("#gradesGenerationTable").hide();
        </script>
    @endif
    <script type='text/javascript'>
        $(document).ready(function() {
    
            // Department Change
            $('#gradeCategory').change(function() {
    
                // Department id
                var id = $(this).val();
                // Empty the dropdown
                $('#grades').empty();
    
                // AJAX request 
                $.ajax({
                    url: '/groupes/get/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create  html
                            var html = '<tr>';
                            for (var i = 1; i <= len; i++) {
                                var id = response['data'][i - 1].idGrade;
                                var grade = response['data'][i - 1]. grade;
                                html += '<div> <td class="align-middle checkCol"> <input type="checkbox" class="form-check-input form-control" id="grade'+i+'" name="grades[]" value="' +
                                    id + '"> </td> <td class="infoCol"><label for="grade'+i+'">' + grade +
                                    '</label></td> </div>';
                                if (i == len)
                                    html += '</tr>';
                                else if (i % 3 == 0)
                                    html += '</tr><tr>';
                            }
                            $("#grades").append(html);
                        }
                        $("#gradesGenerationTable").show();
    
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                });
            });
        });
    </script>
    {{-- <script type='text/javascript'>
    
        $(document).ready(function(){
            $('#cancelBtn').click(function() {
                location.reload(true);
            });
        // Department Change
        $('#gradeCategory').change(function(){
    
                // Department id
                var id = $(this).val();
    
                // Empty the dropdown
                $('#grade').find('option').not(':first').remove();
    
                // AJAX request 
                $.ajax({
                    url: '/groupes/get/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }   
                        if(len > 0){
                            // Read data and create <option >
                            for(var i=0; i<len; i++){
                                var id = response['data'][i].idGrade;
                                var name = response['data'][i].grade;
            
                                var option = "<option value='"+id+"'>"+name+"</option>";
            
                                $("#grade").append(option); 
                            }
                        }              
                    },
                });
            });
        });
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
        $('#selectAll').click(function(event) {   
            if(this.checked) {
                // Iterate each checkbox
                $('.students').each(function() {
                    this.checked = true; 
                    $(this).closest('tr').find('.absenceState option:first-child').prop('selected',false);
                    $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected',true);                 
                });
            } else {
                $('.students').each(function() {
                    this.checked = false;
                    $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected',false);
                    $(this).closest('tr').find('.absenceState option:first-child').prop('selected',true);                     
                });
            }
        });
        $(document).ready(function(){
            $('.students').click(function(event) {   
                if(this.checked) {
                    // Iterate each checkbox
                    $(this).closest('tr').find('.absenceState option:first-child').prop('selected',false);
                    $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected',true);
                } else {
                    $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected',false);
                    $(this).closest('tr').find('.absenceState option:first-child').prop('selected',true);
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
    </script> --}}

    
@endsection