{{-- Emploi du Temps --}}
<div class="tab-pane fade" id="emploi" role="tabpanel" aria-labelledby="emploi-tab">
    <div class="tab-pane-content mt-5">
        <div class="card p-4" id="newEmploiSection">
            @if ($emploi->count() == 0)
            @staff
            <div class="row">
                <div class="col-sm-10">
                    <h3 class="card-title">Ajouter un Emploi du Temps</h3>
                </div>
            </div>
            @endstaff
            <div class="card-body">
                @staff
                <form action="{{ route('emploi.add', ['idGroup' => $group->idGroup]) }}" method="post">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="jour">Jour</label>
                                    <input id="jour" name="jour[]" class="form-control" type="text" placeholder="الإثنين" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="debut">Debut de séance</label>
                                    <input id="debut" name="debut[]" class="form-control" type="time" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="fin">Fin du séance</label>
                                    <input id="fin" name="fin[]" class="form-control" type="time" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="addInput btn btn-info mt-4">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                            </div>
                        </div>

                        <div class="field_wrapper">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button name="addEmploi" type="submit" class="btn btn-primary">Ajouter</button>
                                <button name="Reset" type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                </form>
                @else
                <div class="alert alert-warning">
                    Aucun horaire n'a encore été fixé pour ce groupe !
                </div>
                @endstaff
            </div>
            @else
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="card-title">Emploi du Temps</h3>
                    </div>
                    @staff
                    <div class="col-sm-2 text-right">
                        <form action="{{route('emploi.delete')}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-outline-warning" id="updateEmploiButton">
                                <span class="mdi mdi-pencil"></span>
                            </button>
                            <button type="button" class="btn btn-outline-info" id="showEmploiButton">
                                <span class="mdi mdi-arrow-left"></span>
                            </button>
                            <button type="submit" name="deleteEmploi" class="btn btn-outline-danger" value="{{$group->idGroup}}" onclick="return confirm('Are You Sure?');">
                                <span class="mdi mdi-delete"></span>
                            </button>
                        </form>
                    </div>
                    @endstaff
                </div>
                <div class="card-body">
                    <div id="showEmploi">
                        <table class="table">
                            @foreach ($emploi as $item)
                                <tr>
                                    <th>{{$item->jour}}</th>
                                    <td>{{$item->debut}}</td>
                                    <td>{{$item->fin}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    @staff
                    <div id="updateEmploi">
                        <form action="{{ route('emploi.update') }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="idGroup" value="{{$group->idGroup}}">
                            @for ($i = 0; $i < $emploi->count(); $i++)
                                @if ($i == 0)
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="jour">Jour</label>
                                                <input id="jour" name="jour[]" class="form-control" type="text" value="{{$emploi[$i]->jour}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="debut">Debut de séance</label>
                                                <input id="debut" name="debut[]" class="form-control" type="time" value="{{$emploi[$i]->debut}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="fin">Fin du séance</label>
                                                <input id="fin" name="fin[]" class="form-control" type="time" value="{{$emploi[$i]->fin}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="addInput btn btn-info mt-4">
                                                <i class="bi bi-plus-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="field_wrapper">
                                @elseif($i == $emploi->count()-1)
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input id="jour" name="jour[]" class="form-control" type="text" value="{{$emploi[$i]->jour}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input id="debut" name="debut[]" class="form-control" type="time" value="{{$emploi[$i]->debut}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input id="fin" name="fin[]" class="form-control" type="time" value="{{$emploi[$i]->fin}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-danger removeInput"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input id="jour" name="jour[]" class="form-control" type="text" value="{{$emploi[$i]->jour}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input id="debut" name="debut[]" class="form-control" type="time" value="{{$emploi[$i]->debut}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input id="fin" name="fin[]" class="form-control" type="time" value="{{$emploi[$i]->fin}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-danger removeInput"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                            <div class="row">
                                <div class="col-12">
                                    <button name="updateEmploi" type="submit" class="btn btn-warning">Mettre à jour</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endstaff
                </div>
            @endif
        </div>
    </div>
</div>
