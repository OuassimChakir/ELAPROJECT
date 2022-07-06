<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('staff.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New Staff</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="firstName">Prénom</label>
                                <input type="text" class="form-control" name="prenom" id="firstName" value="John" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lastName">Nom de Famille</label>
                                <input type="text" class="form-control" name="nom" id="lastName" value="Deo" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="johnexample@gmail.com" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="numTel">Numéro de Téléphone</label>
                                <input type="tel" class="form-control" name="numTel" id="numTel"
                                    value="06 12 34 56 78" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="form-label">Type de Staff</label>
                                <select name="idStaffType" id="id-stafftype" class="form-select">
                                    <option>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach( $stafft as $type)
                                    <option value="{{ $type->idStaffType }}" >
                                        {{ $type->designation }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="form-label">Subject</label>
                                <select name="idSubject" id="id-Subject" class="form-select">
                                    <option>{{ trans('global.pleaseSelect') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="userName">CNIE</label>
                                <input type="text" class="form-control" name="cnie" id="userName"
                                    value="U156" required>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="ajouterClient" class="btn btn-primary btn-pill">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>