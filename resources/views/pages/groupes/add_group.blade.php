<link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css"> 
<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('groups.add')}}" method="post">
                @csrf
                @method('post')
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Créer un Groupe</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" id="description" maxlength="6">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="capacity">Capacité du Groupe</label>
                                <input type="number" max="50" min="1" class="form-control" name="capacity" id="capacity" required>
                            </div>
                        </div>
                        {{-- Staff --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="form-label">Professeur Assigné</label>
                                <select name="idStaff" id="idProfesseur" class="form-select" required>
                                    <option disabled selected>-- Choisir un Professeur --</option>
                                    @foreach ($professeurs as $professeur)  
                                        <option value="{{ $professeur->idStaff }}">
                                            {{ $professeur->prenom.' '.$professeur->nom }} | {{$professeur->libelle}}
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
                                        <optgroup label="{{$courseType->course}}">
                                            @foreach ($subjects as $subject)
                                                @if ($courseType->idCourseType == $subject->idCourseType)
                                                    <option value="{{ $subject->idSubject }}">
                                                        {{ $subject->libelle  }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Grade Category --}}
                        <div class="col-lg-6">
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

                        {{-- Niveau --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-4" id="gradesSelect">
                                <label for="form-label">Niveaux</label>
                                <select name="idGrade" id="grade" class="form-select" required>
                                    <option disabled selected>-- Choisir le Niveau -- </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="CreateGroup" class="btn btn-primary btn-pill">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type='text/javascript'>
    $("#gradesSelect").hide();
    $(document).ready(function(){
 
       // Department Change
       $('#gradeCategory').change(function(){
 
          // Department id
          var id = $(this).val();
 
          // Empty the dropdown
          $('#grade').find('option').not(':first').remove();
 
          // AJAX request 
          $.ajax({
            url: 'groupes/get/'+id,
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
              $("#gradesSelect").show();
              
            }
          });
       });
    });
    </script>