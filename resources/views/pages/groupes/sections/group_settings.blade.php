<div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
    <div class="tab-pane-content mt-5">
        <form action="{{ route('groups.update', ['idGroup' => $group->idGroup]) }}" method="post">
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
                            <input type="number" max="50" min="1"
                                class="form-control" name="capacity"
                                value="{{ $group->capacity }}" id="capacity" required>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="capacity">Prix Individuel</label>
                            <input type="number" min="1" class="form-control"
                                name="amount" id="amount" value="{{ $group->amount }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="debutFormation">Début de formation</label>
                            <input type="date" class="form-control" name="debutFormation" id="debutFormation" value='{{$group->debutFormation}}' required>
                        </div>
                    </div>

                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="finFormation">Fin de formation</label>
                            <input type="date" class="form-control" name="finFormation" id="finFormation" value="{{$group->finFormation}}" required>
                        </div>
                    </div>

                    {{-- Staff --}}
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="form-label">Professeur Assigné</label>
                            <select name="idProfesseur" id="idProfesseur" class="form-select"
                                required>
                                <option disabled selected>-- Choisir un Professeur --</option>
                                @foreach ($professeurs as $professeur)
                                    @if ($group->idProfesseur == $professeur->idProfesseur)
                                        <option value="{{ $professeur->idProfesseur }}" selected>
                                        @else
                                        <option value="{{ $professeur->idProfesseur }}">
                                    @endif
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
                            <select name="idSubject" id="id-Subject" class="form-select"
                                required>
                                @foreach ($courseTypes as $courseType)
                                    <optgroup label="{{ $courseType->course }}">
                                        @foreach ($subjects as $subject)
                                            @if ($courseType->idCourseType == $subject->idCourseType)
                                                @if ($group->idSubject == $subject->idSubject)
                                                    <option value="{{ $subject->idSubject }}"
                                                        selected>
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
                            <select name="gradeCategory" id="gradeCategory" class="form-select"
                                required>
                                <option disabled selected>-- Choisir une Catégorie -- </option>
                                @php
                                    if (isset($groupGrades[0])) {
                                        $idGradeCategory = $groupGrades[0]->idGradeCategory;
                                    }
                                @endphp
                                @foreach ($gradesCategories as $categorie)
                                    @if (isset($idGradeCategory) && $categorie->idGradeCategory == $idGradeCategory)
                                        <option value="{{ $categorie->idGradeCategory }}"
                                            selected>
                                        @else
                                        <option value="{{ $categorie->idGradeCategory }}">
                                    @endif
                                    {{ $categorie->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nbGroup">Nombre du Group</label>
                            @php
                                $designation = explode('-',$group->designation);
                                if(count($designation) == 3)
                                    $nbGroup = $designation[2];
                                elseif(count($designation) == 4)
                                    $nbGroup = $designation[2];
                            @endphp
                            <input type="number" class="form-control" name="nbGroup" id="nbGroup" value="{{substr($nbGroup,1)}}" required>
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
                                                                foreach ($groupGrades as $item) {
                                                                    if ($item->idGrade == $grades[$i - 1]->idGrade) {
                                                                        $flag = true;
                                                                        break;
                                                                    } else {
                                                                        $flag = false;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if ($flag)
                                                                <input type="checkbox"
                                                                    class="form-check-input form-control"
                                                                    id="grade{{ $i }}"
                                                                    name="grades[]"
                                                                    value="{{ $grades[$i - 1]->idGrade }}"
                                                                    checked>
                                                            @else
                                                                <input type="checkbox"
                                                                    class="form-check-input form-control"
                                                                    id="grade{{ $i }}"
                                                                    name="grades[]"
                                                                    value="{{ $grades[$i - 1]->idGrade }}">
                                                            @endif
                                                        </td>
                                                        <td class="infoCol">
                                                            <label for="grade{{ $i }}">
                                                                {{ $grades[$i - 1]->grade }}
                                                            </label>
                                                        </td>
                                                    </div>
                                                    @if ($i == count($grades))
                                            </tr>
                                        @elseif($i % 3 == 0)
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
                <button type="button" class="btn btn-secondary btn-pill"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="updateGroup" id="updateGroupBtn" class="btn btn-warning btn-pill">Modifier</button>
            </div>
        </form>
    </div>
</div>