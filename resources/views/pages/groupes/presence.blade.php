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
            <h1>hhh</h1>
            <p class="breadcrumbs">
                <span><a href="{{route('acceuil')}}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span><a href="{{route('groups')}}">Groupes</a>
                <span><i class="mdi mdi-chevron-right"></i></span>hhhh
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
                                                <table id="responsive-data-table" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nom</th>
                                                            <th>Etat d'absence</th>
                                                            <th>dateAbsence</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($etudiants as $etudiant)
                                                            <tr>
                                                                <td>{{$etudiant->matricule}}</td>
                                                                <td>{{$etudiant->prenom_fr.' '.$etudiant->nom_fr}}</td>
                                                                <td>
                                                                @if ($etudiant->absence == 0)
                                                                    Present
                                                                @elseif($etudiant->absence == 1)
                                                                    Absent(e)
                                                                @else
                                                                    Justifiée
                                                                @endif
                                                                </td>
                                                                <td>{{$etudiant->dateAbsence}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
    <script src="{{asset('JS/sweetAlert.js')}}"></script>
    
    <script type='text/javascript'>
    
        $(document).ready(function(){
            $('#cancelBtn').click(function() {
                location.reload(true);
            });
        // Department Change
        $('#dateabsence').change(function(){
    
                // Department id
                var id = $(this).val();
    
                // Empty the dropdown
                $('#grade').find('option').not(':first').remove();
    
                // AJAX request 
                $.ajax({
                    url: '/absence/all/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }   
                        if(len > 0){
                            // Read data and create <table >
                            for(var i=0; i<len; i++){
                                var id = response['data'][i].idGrade;
                                var name = response['data'][i].grade;
            
                                var table = "<option value='"+id+"'>"+name+"</option>";
            
                                $("#grade").append(table); 
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
    </script>

    
@endsection