@extends('layouts.layout')
@section('title')
    {{ $group->designation }}
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ $group->designation }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span><a href="{{ route('groups') }}">Groupes</a>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ $group->designation }}
            </p>
        </div>
        @staff
        <div>
            <a href="{{route('group.incomes',['idGroup' => $group->idGroup, 'datePayment' => 'all'])}}" target="_blank">
                <button type="button" class="btn btn-primary">
                    Revenus
                </button>
            </a>
            <button type="button" class="deleteGroup btn btn-outline-danger" name="delete" value="{{$group->idGroup}}">
                <i class="bi bi-trash-fill"></i> Supprimer
            </button>
        </div>
        @endstaff
    </div>


    <div class="card bg-white profile-content">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="profile-content-right profile-right-spacing py-5">
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                        {{-- Informations --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile"
                                aria-selected="true">Informations</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="emploi-tab" data-bs-toggle="tab" data-bs-target="#emploi"
                                type="button" role="tab" aria-controls="emploi"
                                aria-selected="false">Emploi du Temps</button>
                        </li>
                        @staff
                        {{-- Paramètres --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings"
                                type="button" role="tab" aria-controls="settings"
                                aria-selected="false">Paramètres</button>
                        </li>
                        @endstaff
                        @teacher
                        {{-- Absence --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="markAttendance-tab" data-bs-toggle="tab"
                                data-bs-target="#markAttendance" type="button" role="tab" aria-controls="markAttendance"
                                aria-selected="false">Marquer l'Absence</button>
                        </li>
                        @endteacher
                        @staff
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance"
                                type="button" role="tab" aria-controls="attendance"
                                aria-selected="false">Paramètres d'Absence</button>
                        </li>
                        @endstaff
                        
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                        {{-- Informations --}}
                        @include('pages.groupes.sections.group_info')

                        @staff
                        {{-- Parametres --}}
                        @include('pages.groupes.sections.group_settings')

                        @endstaff
                        @teacher
                        {{-- Attendance --}}
                        @include('pages.groupes.sections.attendance')

                        @endteacher
                        @staff
                        {{-- Attendance Settings --}}
                        @include('pages.groupes.sections.attendance_settings')
                        @endstaff

                        {{-- Emploi du Temps --}}
                        @include('pages.groupes.sections.emploi')
                    </div>
                </div>
            </div>
        </div>

        @include('pages.students.add2Group')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('JS/sweetAlert.js') }}"></script>
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
                                    var grade = response['data'][i - 1].grade;
                                    html +=
                                        '<div> <td class="align-middle checkCol"> <input type="checkbox" class="form-check-input form-control" id="grade' +
                                        i + '" name="grades[]" value="' +
                                        id + '"> </td> <td class="infoCol"><label for="grade' + i +
                                        '">' + grade +
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
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                });
            });
        </script>

        <script type='text/javascript'>
            $(document).ready(function() {
                $('#cancelBtn').on('click',function() {
                    location.reload(true);
                });
            });
            $('#selectAllArchived').on('click',function(event) {
                if (this.checked) {
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
            $('#selectAll').on('click',function(event) {
                if (this.checked) {
                    // Iterate each checkbox
                    $('.students').each(function() {
                        this.checked = true;
                        $(this).closest('tr').find('.absenceState option:first-child').prop('selected', false);
                        $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected', true);
                    });
                } else {
                    $('.students').each(function() {
                        this.checked = false;
                        $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected', false);
                        $(this).closest('tr').find('.absenceState option:first-child').prop('selected', true);
                    });
                }
            });
            $(document).ready(function() {
                $('.students').on('click',function(event) {
                    if (this.checked) {
                        // Iterate each checkbox
                        $(this).closest('tr').find('.absenceState option:first-child').prop('selected', false);
                        $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected', true);
                    } else {
                        $(this).closest('tr').find('.absenceState option:nth-child(2)').prop('selected', false);
                        $(this).closest('tr').find('.absenceState option:first-child').prop('selected', true);
                    }
                });
            });
            $(".btns").hide();
            $(":checkbox").click(function() {
                if ($(this).is(":checked")) {
                    $(".btns").show();
                } else {
                    $(".btns").hide();
                }
            });
        </script>

        <script>
            function cancelAssignment(idElement){
                var id = idElement;
                Swal.fire({
                    title: "Voulez-vous retirer cet étudiant de ce groupe ?",
                    showCancelButton: true,
                    confirmButtonText: 'Oui',
                    cancelButtonText: `Annuler`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/classrooms/remove/"+id;
                    }
                })
            }

        </script>

        {{-- Script: Generation of Select with available date of attendance --}}
        <script>
            $(document).ready(function(){
                $('#absenceDateInput').on('change',function(){
                    var dateAbsence = $(this).val();
                    var idGroup = '{{$group->idGroup}}';
                    $('#attendanceSelect').empty();
                    $('#attendanceSelect').prop('disabled',false);
                     // AJAX request 
                    $.ajax({
                        url: '/attendance/' + idGroup + '/' + dateAbsence,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            var len = response.length;
                            if (len > 0) {
                                // Read data and create  html
                                var html = '';
                                for (var i = 0; i < len; i++) {
                                    html = '<option value=' + response[i].dateAbsence + '>' + response[i].dateAbsence + '</option>';
                                    $("#attendanceSelect").append(html);
                                }
                                $('#getAttendanceButton').prop('disabled',false);
                            }else{
                                $('#attendanceSelect').prop('disabled',true);
                                $('#getAttendanceButton').prop('disabled',true);
                            }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                });
            });
        </script>

        {{-- Script: Getting Attendance Data --}}
        <script>
            $(document).ready(function(){
                $('#getAttendanceButton').on('click',function(){
                    var dateAbsence = $('#attendanceSelect').val();
                    var idGroup = '{{$group->idGroup}}';
                    $('#updateAttendanceStudents').empty();
                     // AJAX request 
                    $.ajax({
                        url: '/attendance/update/' + idGroup + '/' + dateAbsence,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            var len = response.length;
                            if (len > 0) {
                                $('#updatedDateAbsence').val(dateAbsence);
                                $('#deletionDateAbsence').val(dateAbsence);
                                // Read data and create  html
                                var html = '';
                                for (var i = 0; i < len; i++) {
                                    html = '<tr>';
                                    html += '<td> <input type="checkbox" class="form-check-input updatedAttendanceStudents" '+((response[i].absence == 1) ? 'checked' : '') + '/> </td>'
                                    html += '<td> ' + response[i].matricule + '<input type="hidden" name="attendances[]" class="form-control" value="' + response[i].idAttendance + '" /> </td>';

                                    html += '<td> <a href="/student/'+response[i].idStudent+'" > '+response[i].prenom_fr+' '+response[i].nom_fr+' - '+response[i].prenom_ar+' '+response[i].nom_ar+'</a> '+((response[i].sexe == 'Homme') ? '<span class="badge badge-pill badge-info">M</span>' : '<span class="badge badge-pill badge-purple">F</span>')+' </td>';
                                    html += '<td> <select name="absence[]" id="id-Subject" class="updatedAbsenceState form-select form-control" required >';
                                    html += '<option value="0" '+((response[i].absence == 0) ? 'selected' : '')+'>Présent</option>';
                                    html += '<option value="1" '+((response[i].absence == 1) ? 'selected' : '')+'>Absent</option>';
                                    html += '<option value="2" '+((response[i].absence == 2) ? 'selected' : '')+'>Justifié</option></select></td></tr>';
                                    $("#updateAttendanceStudents").append(html);
                                }
                                $('#updateAttendanceBtn').prop('disabled',false);
                                $('#deleteAttendanceBtn').prop('disabled',false);
                                $('html, body').animate({
                                    scrollTop: $("#updateAttendanceSection").offset().top
                                }, 0);
                            }else{
                                $('#updateAttendanceBtn').prop('disabled',true);
                                $('#deleteAttendanceBtn').prop('disabled',true);
                            }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                });
            });
        </script>
        
        <script>
            $(document).on('click','#selectAllUpdated',function() {
                if (this.checked) {
                    // Iterate each checkbox
                    $('.updatedAttendanceStudents').each(function() {
                        this.checked = true;
                        $(this).closest('tr').find('.updatedAbsenceState option:first-child').prop('selected', false);
                        $(this).closest('tr').find('.updatedAbsenceState option:nth-child(2)').prop('selected', true);
                    });
                } else {
                    $('.updatedAttendanceStudents').each(function() {
                        this.checked = false;
                        $(this).closest('tr').find('.updatedAbsenceState option:nth-child(2)').prop('selected', false);
                        $(this).closest('tr').find('.updatedAbsenceState option:first-child').prop('selected', true);
                    });
                }
            });
            $(document).on('click','.updatedAttendanceStudents',function() {
                if (this.checked) {
                    // Iterate each checkbox
                    $(this).closest('tr').find('.updatedAbsenceState option:first-child').prop('selected', false);
                    $(this).closest('tr').find('.updatedAbsenceState option:nth-child(2)').prop('selected', true);
                } else {
                    $(this).closest('tr').find('.updatedAbsenceState option:nth-child(2)').prop('selected', false);
                    $(this).closest('tr').find('.updatedAbsenceState option:first-child').prop('selected', true);
                }
            });
        </script>


        {{-- Add Note --}}
        <script>
            $(document).on('click','.addNote',function(){

                let idElement = $(this).val();
                Swal.fire({
                    input: 'textarea',
                    inputLabel: 'Message',
                    inputPlaceholder: 'Type your message here...',
                    inputAttributes: {
                        'aria-label': 'Type your message here'
                    },
                    showCancelButton: true
                }).then(function(value) {
                    if(value.isConfirmed){
                        let note = value.value;
                        // AJAX request 
                        $.ajax({
                            type:'POST',
                            url:"{{ route('notes.add') }}",
                            data:{"note" : note, "idElement" : idElement, "_token" : "{{ csrf_token() }}"},
                            success: function(response) {
                                if(response == 'true')
                                    Swal.fire('Note Ajoutée!', '', 'success')
                                else
                                    Swal.fire('problème rencontré ! Réessayez !', '', 'warning')

                            },
                            error: function(request, status, error) {
                                console.log(request.responseText);
                            }
                        });
                    }
                });

            })
        </script>


        {{-- Group Emploi --}}
        <script>
            $(document).ready(function() {
                var maxField = 10; //Input fields increment limitation
                var addInput = $('.addInput'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML = '<div class="row">'; //New input field html 
                fieldHTML += '<div class="col-lg-4"> <div class="form-group"> <input id="jour" name="jour[]" class="form-control" type="text" required> </div> </div>';
                fieldHTML += '<div class="col-lg-3"> <div class="form-group"> <input id="debut" name="debut[]" class="form-control" type="time" required> </div> </div>';
                fieldHTML += '<div class="col-lg-3"> <div class="form-group"> <input id="fin" name="fin[]" class="form-control" type="time" required> </div> </div>';
                fieldHTML += '<div class="col-lg-2"> <button type="button" class="btn btn-danger removeInput"><i class="bi bi-trash"></i></button> </div>';
                fieldHTML += '</div>';
                var x = 1; //Initial field counter is 1
                //Once add button is clicked
                $(addInput).click(function() {
                    //Check maximum number of input fields
                    if (x < maxField) {
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); //Add field html
                    }
                });
            
                //Once remove button is clicked
                $(wrapper).on('click', '.removeInput', function(e) {
                    e.preventDefault();
                    $(this).parentsUntil('.field_wrapper').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });

            $('#updateEmploi').hide();
            $('#showEmploiButton').hide();
            $(document).on('click','#updateEmploiButton', function(e){
                e.preventDefault();
                $('#showEmploi').hide();
                $('#showEmploiButton').show();

                $('#updateEmploiButton').hide();
                $('#updateEmploi').show();
            });
            $(document).on('click','#showEmploiButton', function(e){
                e.preventDefault();
                $('#showEmploi').show();
                $('#showEmploiButton').hide();

                $('#updateEmploiButton').show();
                $('#updateEmploi').hide();
            });
        </script>

        {{-- Delete Group --}}
        <script>
            $(document).on('click','.deleteGroup',function(){
                let id = $(this).val();
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmez votre demande !',
                    text: 'Vous êtes sur le point de supprimer ce groupe.',
                    showCancelButton: true,
                    confirmButtonText: 'Oui',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/groupes/delete/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response){
                                if(response == true){
                                    window.location.href = "{{route('groups')}}";
                                }else{
                                    Swal.fire("Vous ne pouvez pas supprimer ce groupe", "Veuillez vérifier s'il y a des Paiements Impayés pour ce Group.", 'error')
                                }
                            },
                            error: function(request, status, error) {
                                console.log(request.responseText);
                            }
                            
                        });
                    }
                })
            });
        </script>

        {{-- Get Group Number --}}
        <script>
            let nbGroup = $('#nbGroup').val();
            $(document).ready(function() {
                $('#nbGroup').on('keyup', function() {
                    var nbGroupQuery = $('#nbGroup').val();
                    var idGradeCategory = $('#gradeCategory').val();
                    var idSubject = $('#id-Subject').val();
                    if(nbGroupQuery <= 0 && nbGroupQuery.length != 0){
                        $('#nbGroup').val(1);
                        nbGroupQuery = 1;
                    }
                    $.ajax({
                        url: "{{ route('search.nbGroup') }}",
                        type: "GET",
                        data: {
                            'nbGroupQuery': nbGroupQuery,
                            'idGradeCategory' : idGradeCategory,
                            'idSubject' : idSubject,
                        },
                        success: function(data) {
                            if (data == 0) {
                                if($('#nbGroup').val().length == 0){
                                    $('#updateGroupBtn').prop('disabled',true);
                                    $('#nbGroup').removeClass("is-valid");
                                    $('#nbGroup').addClass("is-invalid");
                                }else{
                                    $('#nbGroup').removeClass("is-invalid");
                                    $('#nbGroup').addClass("is-valid");
                                    $('#updateGroupBtn').prop('disabled',false);
                                }
                            } else {
                                if(nbGroupQuery == nbGroup){
                                    $('#nbGroup').removeClass("is-invalid");
                                    $('#nbGroup').addClass("is-valid");
                                    $('#updateGroupBtn').prop('disabled',false);
                                }else{
                                    $('#nbGroup').removeClass("is-valid");
                                    $('#nbGroup').addClass("is-invalid");
                                    $('#updateGroupBtn').prop('disabled',true);
                                }
                            }
                        }
                    });
                    
                });
            });
        </script>
    @endsection