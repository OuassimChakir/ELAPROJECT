<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('staff.add') }}" method="post" class="needs-validation" novalidate>
                @csrf
                @method('post')
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un Staff</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="firstName">Prénom</label>
                                <input type="text" class="form-control" name="prenom" id="firstName"
                                    placeholder="John" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lastName">Nom</label>
                                <input type="text" class="form-control" name="nom" id="lastName"
                                    placeholder="Deo" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="numTel">Numéro de Téléphone</label>
                                <input type="tel" class="form-control" name="numTel" id="numTel" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="cine">CINE</label>
                            <div class="input-group mb-3">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="checkbox" id="Checkbox" value="true"
                                        aria-label="Checkbox for following text input">
                                </div>
                                <input type="text" class="form-control" id="cine" name="cine"
                                    aria-label="Text input with checkbox" disabled>
                            </div>
                        </div>

                        <!-- sexe -->
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label>Sexe</label>
                                <div class="col-6 d-flex align-items-center justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" value="M" type="radio" name="sexe"
                                            id="sexe1" checked>
                                        <label class="form-check-label" for="sexe1">
                                            Homme
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="F" type="radio" name="sexe"
                                            id="sexe2">
                                        <label class="form-check-label" for="sexe2">
                                            Femme
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="form-label">Spécialité</label>
                                <select name="idStaffType" id="id-stafftype" class="form-select" required>
                                    <option disabled selected value="">-- Choisir une Spécialité</option>
                                    @foreach ($staffTypes as $type)
                                        <option value="{{ $type->idStaffType }}">
                                            {{ $type->designation }}
                                            {{ !is_null($type->is_moderator) ? '(Moderateur)' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addStaff" class="btn btn-primary btn-pill">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('JS/jquery.min.js') }}"></script>
<script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>
<script>
    $(document).on('click', '#Checkbox', function() {
        var checkbox = $(this);
        if (checkbox.is(':checked')) {
            $('#cine').prop('disabled', false);
        }
        if (checkbox.is(':checked') == false) {
            $('#cine').prop('disabled', true);
            $('#cine').prop('value', "");
        }
    });
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
