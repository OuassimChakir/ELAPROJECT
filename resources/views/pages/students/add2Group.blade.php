<div class="modal fade modal-add-contact" id="add2Group" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h5 class="modal-title" id="exampleModalCenterTitle">Assigner à un Groupe</h5>
            </div>

            <div class="modal-body px-4">
                <div class="row mb-2 g-3">
                    {{-- Matières --}}
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label for="form-label">Matières</label>
                            <select name="idSubject" id="subjectSelect" class="form-select" required>
                                <option disabled selected>-- Choisir une Matière --</option>
                                @foreach ($courseTypes as $courseType)
                                    <optgroup label="{{ $courseType->course }}">
                                        @foreach ($subjects as $subject)
                                            @if ($courseType->idCourseType == $subject->idCourseType)
                                                <option value="{{ $subject->idSubject }}">
                                                    {{ $subject->libelle }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="groupsResult">

                    </div>
                </div>
            </div>
            <input type="hidden" name="matricule" id="idStudent" value="hello">
            <div class="modal-footer px-4">
                <button type="button" id="reloardBtn" class="btn btn-primary btn-pill"
                    data-bs-dismiss="modal">Terminer</button>
                <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


{{-- GETTING GROUPS QUERY --}}
<script>
    $("#groupsResult").hide();
    $(document).ready(function() {
        $(".add2GroupBtn").on('click', function() {
            $('#idStudent').val() = $(this).val();
        });
        // Department Change
        $('#subjectSelect').change(function() {
            // Department id
            var idStudent = $('#idStudent').val();
            var idSubject = $('#subjectSelect').val();

            // Empty the dropdown
            $('#groupsResult').find('.card').remove();
            $('#groupAlert').remove();
            // AJAX request 
            $.ajax({
                url: '/students/getGroups/' + idSubject + '/' + idStudent,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var idGroup = response['data'][i].idGroup;
                            console.log(response['data'][i]);
                            var designation = response['data'][i].designation;
                            var capacity = response['data'][i].capacity;
                            var nbElement = response['data'][i].nbElements;
                            var name = response['data'][i].prenom + " " + response['data'][i].nom;
                            var htmlOut = "<div class='card'><div class='card-body'>";
                            htmlOut += "<div class='row'><div class='col-11'>";
                            htmlOut += '<h5 class="card-title">' + designation;
                            if (capacity == nbElement)
                                htmlOut += '<span class="badge badge-pill badge-dark">';
                            else
                                htmlOut += '<span class="badge badge-pill badge-info">';

                            htmlOut += nbElement + '/' + capacity +
                                '</span></h5><p class="card-text">' + name +
                                '</p></div><div class="col-1">';

                            if (capacity == nbElement)
                                htmlOut +=
                                '<button class="addStudentGroup btn btn-danger" value="' +
                                idGroup +
                                '" disabled=""><i class="bi bi-x-lg"></i></button>';
                            else
                                htmlOut +=
                                '<button class="addStudentGroup btn btn-outline-primary" value="' +
                                idGroup + '"><i class="bi bi-plus-lg"></i></button>';
                            htmlOut += '</div></div></div></div>';
                            $("#groupsResult").append(htmlOut);
                        }
                    } else {
                        var htmlOut =
                            "<div id='groupAlert' class='alert alert-warning' role='alert'>l'étudiant choisi n'est <b>déjà dans ce groupe</b> ou <b>les groupes demandés n'existent pas</b></div>";
                        $("#groupsResult").append(htmlOut);
                    }
                    $("#groupsResult").show();

                }
            });
        });
    });
</script>

<template id="fail-assign">
    <swal-title>
        Veuillez régler les paiements des groupes précédents de cet étudiant
    </swal-title>
    <swal-icon type="warning" color="red"></swal-icon>
    <swal-button type="confirm">
        Okay
    </swal-button>
    <swal-param name="allowEscapeKey" value="true" />
    <swal-param name="customClass" value='{ "popup": "my-popup" }' />
    <swal-function-param name="didOpen" value="popup => console.log(popup)" />
</template>
{{-- ASSIGNING A STUDENT INTO A GROUP --}}
<script>
    $(document).ready(function() {
        // Department Change
        $('#groupsResult').on('click', '.addStudentGroup', function() {

            // Department id
            if (confirm("Confirmer votre Affectation")) {
                var currentBtn = $(this);
                var idGroup = $(this).val();
                var idStudent = $('#idStudent').val();
                // AJAX request 
                $.ajax({
                    url: '/groupes/' + idGroup + '/classroom/' + idStudent,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        if (response == 'true') {
                            currentBtn.find('i').remove();
                            currentBtn.removeClass('btn-outline-primary');
                            currentBtn.addClass('btn-success');
                            var newIcon = '<i class="bi bi-check-lg"></i>';
                            currentBtn.append(newIcon);
                            currentBtn.prop('disabled', true);
                        }else{
                            Swal.fire({
                                template: '#fail-assign'
                            })
                        }

                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            }
        });
    });
</script>


{{-- Reload Page when you finish assigning --}}
<script>
    $(document).ready(function() {
        // Department Change
        $('.modal-footer').on('click', '#reloardBtn', function() {
            location.reload(true);
        });
    });
</script>
