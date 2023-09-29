<link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('groups.add') }}" method="post">
                @csrf
                @method('post')
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Créer un Groupe</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="capacity">Capacité du Groupe</label>
                                <input type="number" max="50" min="1" class="form-control" name="capacity"
                                    id="capacity" required>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="capacity">Prix Individuel</label>
                                <input type="number" min="1" class="form-control" name="amount" id="amount"
                                    value="0">
                            </div>
                        </div>
                        {{-- Staff --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="form-label">Professeur Assigné</label>
                                <select name="idProfesseur" id="idProfesseur" class="form-select" required>
                                    <option disabled selected>-- Choisir un Professeur --</option>
                                    @foreach ($professeurs as $professeur)
                                        <option value="{{ $professeur->idProfesseur }}">
                                            {{ $professeur->prenom . ' ' . $professeur->nom }} |
                                            {{ $professeur->libelle }}
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
                        {{-- Grade Category --}}
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="form-label">Catégories des Niveaux</label>
                                <select name="gradeCategory" id="gradeCategory" class="form-select" required>
                                    <option disabled selected value="0">-- Choisir une Catégorie -- </option>
                                    @foreach ($gradesCategories as $categorie)
                                        <option value="{{ $categorie->idGradeCategory }}">
                                            {{ $categorie->category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12" id="gradeSection">
                            <div class="card p-2 mt-2 mb-4">
                                <div class="card-title pl-3 pt-3">
                                    <h5>Niveaux</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tbody id="grades">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <div class="form-group">
                                <label for="nbGroup">Nombre du Group</label>
                                <input type="number"" min="1" class="form-control" name="nbGroup" id="nbGroup" required>
                                <div class="invalid-feedback">
                                    Ce numéro de groupe existe déjà !
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="CreateGroup" class="btn btn-primary btn-pill" id="createGroupBtn" disabled>Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('JS/jquery.min.js') }}"></script>
<script type='text/javascript'>
    $('#gradeSection').hide();
    $('#nbGroup').hide();
    let gradeCategories = [];
    $(document).ready(function() {

        // Department Change
        $('#gradeCategory').change(function() {
            $('#nbGroup').val('');
            $('#createGroupBtn').prop('disabled',true);
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
                        gradeCategories = response['data'];
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
                        $('#gradeSection').show();
                    }else{
                        $('#gradeSection').hide();
                    }
                    $("#nbGroup").show();
                }
            });
        });

        $('#id-Subject').change(function() {
            $('#nbGroup').val('');
            $('#createGroupBtn').prop('disabled',true);
        });

        $('#grades').on('click',function(){
            $('#nbGroup').val('');
            $('#createGroupBtn').prop('disabled',true);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#nbGroup').on('keyup', function() {
            var nbGroupQuery = $('#nbGroup').val();
            var idGradeCategory = $('#gradeCategory').val();
            var idSubject = $('#id-Subject').val();
            var grades = [];
            $('#grades :checkbox:checked').each(function(i){
                grades[i] = $(this).val();
            });
            
            if(grades.length == 0 && gradeCategories.length > 0){
                $('#nbGroup').val('');
                $('#createGroupBtn').prop('disabled',true);
                Swal.fire(
                    'Alert!',
                    "Vous devez d'abord choisir un niveau !",
                    'warning'
                )
            }else{
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
                        'grades' : grades,
                    },
                    success: function(data) {
                        if (data == 0) {
                            if($('#nbGroup').val().length == 0){
                                $('#createGroupBtn').prop('disabled',true);
                                $('#nbGroup').removeClass("is-valid");
                                $('#nbGroup').addClass("is-invalid");
                            }else{
                                $('#nbGroup').removeClass("is-invalid");
                                $('#nbGroup').addClass("is-valid");
                                $('#createGroupBtn').prop('disabled',false);
                            }
                        } else {
                            $('#nbGroup').removeClass("is-valid");
                            $('#nbGroup').addClass("is-invalid");
                            $('#createGroupBtn').prop('disabled',true);
                        }
                    }
                });
            }
        });
    });
</script>
