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
            <form action="" method="get">
                <div class="row justify-content-center">
                    <div class="col-12 text-center m-9">
                        <button type="submit" id="newYear" name="newYear" class="newYear btn btn-danger btn-lg" data-bs-toggle="modal"
                            data-bs-target="#addNewYear" onclick="return confirm('Vous êtes sûr?');"><i
                            class="bi bi-arrow-clockwise"></i> Nouvel Année</button>
                    </div>
                </div>
        </div> <!-- End Content -->
        </form>
    </div> <!-- End Content Wrapper -->

    <script src="{{ asset('JS/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("button#newYear").click(function() {
                alert("confirme la nouvelle Année.");
                swal({
                        title: "Confirmation",
                        text: "Pour Confirmer votre demande d'avoir une nouvelle année entrer votre Mot de Passe",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        content: "input",
                    })
                    .then((value) => {
                        swal(`You typed: ${value}`);
                    });
            });
        });
    </script>
@endsection
