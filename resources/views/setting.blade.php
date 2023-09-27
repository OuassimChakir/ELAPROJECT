@extends('layouts.layout')
@section('title')
    Paramètres
@endsection
@section('content')
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Paramètres</h1>
                    <p class="breadcrumbs">
                        <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Paramètres
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 text-center m-9">
                    <button type="submit" id="newYear" name="newYear" class="newYear btn btn-danger btn-lg"
                        data-bs-toggle="modal" data-bs-target="#addNewYear">
                        <i class="bi bi-arrow-clockwise"></i> Nouvel Année
                    </button>
                </div>
            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->

    <script src="{{ asset('JS/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#newYear").click(function() {
                Swal.fire({
                    icon: 'warning',
                    title: "Vous êtes sur le point de réinitialiser l'application!",
                    text: "Veuillez confirmer votre mot de passe:",
                    showDenyButton: true,
                    confirmButtonText: 'Réinitialiser',
                    denyButtonText: `Annuler`,
                    input: 'password',
                    inputLabel: 'Password',
                    inputPlaceholder: 'Entrer votre Mot de passe',
                    inputAttributes: {
                        maxlength: 20,
                        autocapitalize: 'off',
                        autocorrect: 'off'
                    }
                }).then((result) => {
                    let password = result.value;
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('settings.reset') }}",
                            data: {
                                "newYear": true,
                                "password": password,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response == true)
                                    Swal.fire("Remise à zéro de l'Application", '', 'success')
                                else
                                    Swal.fire('Mot de passe incorrect, Réessayer !', '', 'error')
                            },
                            error: function(request, status, error) {
                                console.log(request.responseText);
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Demande Annulée !', '', 'info')
                    }
                })
            });
        });
    </script>
@endsection
