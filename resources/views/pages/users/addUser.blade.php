<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('register') }}" class="form" method="post">
                @csrf
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Creation d'un Compte</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="name" :value="old('name')" required autofocus autocomplete="name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="email">{{ __('Email') }}</label>
                                <input class="form-control" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="password">Mot de Passe</label>
                                <input type="password" class="form-control" name="password" required autocomplete="new-password" id="password" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="password_confirmation">Confirmation du Mot de Passe</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password" required>
                                <div id="CheckPasswordMatch"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="form-label">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option disabled selected>-- Choisir un Role -- </option>
                                    <option value="0">Utilisateur</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->idRole}}">{{$role->role}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-pill">{{ __('Register') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <script src="{{asset('JS/jquery.min.js')}}"></script> --}}