<div class="modal fade modal-add-contact" id="transferStudents" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h5 class="modal-title" id="exampleModalCenterTitle">Assigner à un Groupe</h5>
            </div>

            <div class="modal-body px-4">
                <div class="row mb-2 g-3">
                    {{-- Matières --}}
                    <div class="col-lg-5">
                        <div class="form-group mb-4">
                            <label for="form-label">Matières</label>
                            <select name="idSubject" id="subjectSelect" class="form-select" required>
                                @foreach ($courseTypes as $courseType)
                                    <optgroup label="{{ $courseType->course }}">
                                        @foreach ($groupSubjects as $subject)
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

                    {{-- Grade Categories --}}
                    <div class="col-lg-5">
                        <div class="form-group mb-4">
                            <label for="form-label">Catégories des Niveaux</label>
                            <select name="gradeCategory" id="gradeCategory" class="form-select" required>
                                @foreach ($gradesCategories as $categorie)
                                    <option value="{{ $categorie->idGradeCategory }}">
                                        {{ $categorie->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-primary mt-4" id="getTransferGrpsButton">
                            <span class="mdi mdi-magnify"></span>
                        </button>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12" id="groupsResult">

                    </div>
                </div>
            </div>
            <div class="modal-footer px-4">
                <button type="submit" formaction="{{route('classroom.transfer')}}" name="transferStudents" class="btn btn-primary btn-pill"
                        data-bs-dismiss="modal">Terminer
                </button>
                <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


{{-- GETTING GROUPS QUERY --}}
<script>
    $("#groupsResult").hide();
    $(document).ready(function () {
        $(".add2GroupBtn").on('click', function () {
            $('#idStudent').val($(this).val());
        });
        // Department Change
        $('#getTransferGrpsButton').click(function () {
            // Department id
            var idSubject = $('#subjectSelect').val();
            var idGradeCategory = $("#gradeCategory").val();
            // Empty the dropdown
            $('#groupsResult').empty();
            $('#groupAlert').remove();
            // AJAX request
            $.ajax({
                url: '/classroom/getGroups/' + idSubject + '/' + idGradeCategory,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    var len = 0;
                    if (response != null) {
                        len = response.length;
                    }

                    if (len > 0) {
                        var htmlOut = '<label for="form-label">Liste des groupes</label><select name="idGroup" class="form-select">';
                        for (var i = 0; i < len; i++) {
                            var idGroup = response[i].idGroup;
                            console.log(response[i]);
                            var designation = response[i].designation;
                            var capacity = response[i].capacity;
                            var nbElement = response[i].nbElements;
                            htmlOut += '<option value="' + idGroup + '">'+ designation + ' ( ' + nbElement + '/' + capacity + ' )</option>';
                        }
                        htmlOut += '</select>';
                        $("#groupsResult").append(htmlOut);
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
    <swal-param name="allowEscapeKey" value="true"/>
    <swal-param name="customClass" value='{ "popup": "my-popup" }'/>
    <swal-function-param name="didOpen" value="popup => console.log(popup)"/>
</template>

<template id="null-assign">
    <swal-title>
        La durée du groupe n'est pas définie
    </swal-title>
    <swal-icon type="warning" color="red"></swal-icon>
    <swal-button type="confirm">
        Okay
    </swal-button>
    <swal-param name="allowEscapeKey" value="true"/>
    <swal-param name="customClass" value='{ "popup": "my-popup" }'/>
    <swal-function-param name="didOpen" value="popup => console.log(popup)"/>
</template>

{{-- ASSIGNING A STUDENT INTO A GROUP --}}
<script>
    $(document).ready(function () {
        // Department Change
        $('#groupsResult').on('click', '.addStudentGroup', function () {
            Swal.fire({
                icon: 'question',
                title: 'Confirmer votre Operation',
                text: 'Voulez-vous affecter cet élève à ce groupe ?',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annuler',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var currentBtn = $(this);
                    var idGroup = $(this).val();
                    var idStudent = $('#idStudent').val();
                    // AJAX request
                    $.ajax({
                        url: '/groupes/' + idGroup + '/classroom/' + idStudent,
                        type: 'get',
                        dataType: 'json',
                        success: function (response) {
                            if (response == 'true') {
                                currentBtn.find('i').remove();
                                currentBtn.removeClass('btn-outline-primary');
                                currentBtn.addClass('btn-success');
                                var newIcon = '<i class="bi bi-check-lg"></i>';
                                currentBtn.append(newIcon);
                                currentBtn.prop('disabled', true);
                            } else if (response == 'null') {
                                Swal.fire({
                                    template: "#null-assign"
                                })
                            } else {
                                Swal.fire({
                                    template: "#fail-assign"
                                })
                            }

                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                    });
                    Swal.fire('Saved!', '', 'success')
                }
            })
            // Department id
        });
    });
</script>


{{-- Reload Page when you finish assigning --}}
<script>
    $(document).ready(function () {
        // Department Change
        $('.modal-footer').on('click', '#reloardBtn', function () {
            location.reload(true);
        });
    });
</script>
