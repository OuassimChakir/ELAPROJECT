@extends('layouts.layout')
@section('title')
    liste des Utilisateurs
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Liste des Utilisateurs</h1>
            <p class="breadcrumbs"><span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Utilisateurs
            </p>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser"><i
                    class="bi bi-plus-square"></i> Créer un Compte
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <table id="responsive-data-table" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Créé à</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        @if (!is_null($user->idRole))
                                            <div class="badge" style="color: white;background-color: {{ $user->color }}">
                                                {{ $user->role }}
                                            </div>
                                        @else
                                            <div class="badge badge-dark">Utilisateur</div>
                                        @endif
                                    </td>
                                    <td><i class="bi bi-clock"></i> {{ $user->created_at }}</td>
                                    <td>
                                        <button type="button" class="resetPassword btn btn-outline-warning" value="{{ $user->id }}">
                                            <i class="mdi mdi-reload"></i>
                                        </button>
                                        @if ($user->codeRole == '00' || $user->codeRole == '11')
                                        <a href="{{route('user.delete', ['id' => $user->id])}}">
                                            <button type="button" class="btn btn-outline-danger" name="delete" onclick="return confirm('Voulez-vous supprimer cet utilisateur ?');">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </a>
                                        @endif
                                        @if (!is_null($user->idStudent))
                                            <a href="{{route('student.profil', ['idStudent' => $user->idStudent])}}">
                                                <button type="button" class="btn btn-outline-info">
                                                    <i class="mdi mdi-account"></i>
                                                </button>
                                            </a>
                                            @elseif(!is_null($user->idProfesseur))
                                            <a href="{{route('teachers.profil', ['idProfesseur' => $user->idProfesseur])}}">
                                                <button type="button" class="btn btn-outline-info">
                                                    <i class="mdi mdi-account"></i>
                                                </button>
                                            </a>
                                            @elseif(!is_null($user->idStaff))
                                            <a href="{{route('staff.profil', ['idStaff' => $user->idStaff])}}">
                                                <button type="button" class="btn btn-outline-info">
                                                    <i class="mdi mdi-account"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Ajouter un staff -->
    @include('pages.users.addUser')
    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    {{-- Generate Password Function --}}
    <script>
        // function generatePassword(){
        //    var password = Math.random().toString(36).slice(-8);
        // }
        function generatePassword(flag = 0) {
            const characterPool  = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@';
            const passwordLength = 8;
            const randomNumber   = new Uint8Array( 1 );
            let password         = '';
    
            // JS doesn't provide a way to generate a cryptographically secure random number within a range, so instead
            // we just throw out values that don't correspond to a character. This is a little bit slower than using a
            // modulo operation, but it avoids introducing bias in the distribution. Realistically, it's easily performant
            // in this context.
            // @link https://dimitri.xyz/random-ints-from-random-bits/
            for ( let i = 0; i < passwordLength; i++ ) {
                do {
                    crypto.getRandomValues( randomNumber );
                } while ( randomNumber[0] >= characterPool.length );
    
                password += characterPool[ randomNumber[0] ];
            }
    
            // return password;
            if(flag == 0)
                document.getElementById("password").value = password;
            else
                return password;
        }
    </script>
    
    {{-- Reset password Query --}}
    <script>
        $(document).on('click','.resetPassword',function(){
            let id = $(this).val();
            let newPassword = generatePassword(1);
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous êtes sur le point de réinitialiser le mot de passe de cet utilisateur!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Réinitialiser'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type:'POST',
                        url:"{{ route('resetPassword') }}",
                        data:{"id" : id, "newPassword" : newPassword, "_token" : "{{ csrf_token() }}"},
                        success:function(data){
                            let html = "<table class='table'><tr><td>Username</td><th>"+data.username+"</th></tr>";
                                html += "<tr><td>Password</td><th><b>"+data.newPassword+"<b></th></tr></table>";
                                    Swal.fire(
                                        'Voici votre nouveau mot de passe!',
                                        html,
                                        'success'
                                    )
                        }
                    });
                }
            })
        });
    </script>

    {{-- Message with Password --}}
    @if (session()->has('newUser'))
    <template id="new-user">
        <swal-title>
            L'utilisateur a été ajouté avec succès
        </swal-title>
        <swal-html>
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td>{{ucfirst(session()->get('newUser')['name'])}}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{session()->get('newUser')['username']}}</td>
                </tr>
                <tr>
                    <th>Mot de Passe</th>
                    <td>{{session()->get('newUser')['password']}}</td>
                </tr>
            </table>
        </swal-html>
        <swal-icon type="success"></swal-icon>
        <swal-button type="confirm">
            Terminer
        </swal-button>
        <swal-param name="allowEscapeKey" value="false" />
        <swal-param name="customClass" value='{ "popup": "my-popup" }' />
        <swal-function-param name="didOpen" value="popup => console.log(popup)" />
    </template>
    
    <script>
        Swal.fire({
            template: '#new-user',
        });
    </script>
    @endif
@endsection
