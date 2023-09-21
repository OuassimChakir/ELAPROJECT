<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('users.add') }}" class="form" method="post">
                @csrf
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Creation d'un Compte</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="form-label">Role</label>
                                <select name="idRole" id="role" class="form-control" required>
                                    @foreach($roles as $role)
                                        @if ($role->codeRole == '00')
                                            <option value="{{$role->idRole}}" selected>{{$role->role}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required autofocus autocomplete="name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required autofocus required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" class="block mt-1 w-full" type="email" name="email" required>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="password">Mot de Passe</label>
                                <input type="text" class="form-control col-sm-10" name="password" autocomplete="new-password" id="password" required>
                                <button type="button" onclick="generatePassword()" class="btn btn-primary mt-2 form-control">Générer un mot de passe</button>
                            </div>
                        </div>                    
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addUser" class="btn btn-primary btn-pill">{{ __('Ajouter') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- <script src="{{asset('JS/jquery.min.js')}}"></script> --}}