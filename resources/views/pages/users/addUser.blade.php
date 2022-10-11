<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <form action="{{route('users.add')}}" class="form" method="post">
                @csrf
                @method('post')
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Creation d'un Compte</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Nom Complet</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="John Smith" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="login">Login</label>
                                <input type="login" class="form-control" name="login" id="login" placeholder="Login" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="password">Mot de Passe</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="confirmPass">Confirmation du Mot de Passe</label>
                                <input type="password" class="form-control" id="confirmPass" name="confirmPass" required>
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
                    <button type="submit" name="addUser" class="btn btn-primary btn-pill">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('JS/jquery.min.js')}}"></script>

<script>
    $(document).ready(function() {
      $("#confirmPass").on('keyup', function() {
        var password = $("#password").val();
        var confirmPassword = $("#confirmPass").val();
        if (password != confirmPassword)
          $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
        else
          $("#CheckPasswordMatch").html("Password match !").css("color", "green");
      });
    });
</script>