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
                                <input type="number" max="50" min="1" class="form-control" name="capacity" id="capacity" required>
                            </div>
                        </div>

                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="capacity">Prix Individuel</label>
                                <input type="number" min="1" class="form-control" name="amount" id="amount" value="0">
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
                                    <option disabled selected>-- Choisir une Catégorie -- </option>
                                    @foreach ($gradesCategories as $categorie)
                                        <option value="{{ $categorie->idGradeCategory }}">
                                            {{ $categorie->category }}
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

                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="CreateGroup" class="btn btn-primary btn-pill">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('JS/jquery.min.js') }}"></script>
<script type='text/javascript'>
    $("#gradesGenerationTable").hide();
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

                }
            });
        });
    });
</script>