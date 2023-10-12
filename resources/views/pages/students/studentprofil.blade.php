@extends('layouts.layout')
@section('title')
    {{ $student->prenom_ar . ' ' . $student->nom_ar }}
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ $student->prenom_ar . ' ' . $student->nom_ar }}</h1>
            <p class="breadcrumbs"><span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span><a href="{{ route('student.liste') }}">Etudiants</a>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ $student->prenom_ar . ' ' . $student->nom_ar }}
            </p>
        </div>
        <div>
            <a href="{{route('student.incomes',['idStudent' => $student->idStudent])}}" target="_blank">
                <button type="button" class="btn btn-primary">
                    Mes Paiements
                </button>
            </a>
        </div>
    </div>

    <div class="card  mb-4 bg-white profile-content">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="profile-content-left profile-left-spacing">
                    <div class="text-center widget-profile px-0 border-0">
                        <div class="card-body">
                            <h4 class="py-2 text-dark">{{ $student->prenom_ar . ' ' . $student->nom_ar }}</h4>
                            <p>{{ $student->matricule }}</p>
                        </div>
                    </div>
                    <div class="contact-info pt-4">
                        <h5 class="text-dark">Information</h5>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Né(e) le:</p>
                        <p>{{ $student->dateNaissance }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Numéro de Téléphone</p>
                        <p>{{ $student->numTel }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Sexe</p>
                        <p>{{ ucfirst($student->sexe) }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Adresse</p>
                        <p>{{ $student->adresse }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Inscrie le:</p>
                        <p>{{ $student->created_at }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Modifié le:</p>
                        <p>{{ $student->created_at }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xl-9">
                <div class="profile-content-right profile-right-spacing py-5">
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="groups-tab" data-bs-toggle="tab" data-bs-target="#groups"
                                type="button" role="tab" aria-controls="groups" aria-selected="false">Groupes</button>
                        </li>
                        @admin
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="groups-tab" data-bs-toggle="tab" data-bs-target="#responsible"
                                type="button" role="tab" aria-controls="responsible"
                                aria-selected="false">Responsable</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings"
                                type="button" role="tab" aria-controls="settings"
                                aria-selected="false">Paramètres</button>
                        </li>
                        @endadmin
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                        {{-- Profile TAB --}}
                        @include('pages.students.profil.informations')

                        {{-- Responsible TAB --}}
                        @include('pages.students.profil.responsable')

                        {{-- GROUPS TAB --}}
                        @include('pages.students.profil.groupes')

                        {{-- SETTINGS OF THE ACCOUNT --}}
                        @include('pages.students.profil.settings')

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FACTURES --}}
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default p-4">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="card-title">Factures</h3>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select name="idGroup" class="form-control" id="groupPaiments">
                                <option value="null" selected>Tous</option>
                                @foreach ($invoiceGroups as $item)
                                    <option value="{{$item->idGroup}}">{{$item->designation}}</option>
                                @endforeach
                                <option value="0">Autre</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.delete.multiple') }}" method="post">
                        @csrf
                        @method('delete')
                        <table class="table tabled-boredered">
                            <thead>
                                @staff
                                @if (true)
                                    <th>
                                        <input type="checkbox" class="form-check-input" id="selectAllArchived">
                                    </th>
                                @endif
                                @endstaff
                                <th></th>
                                <th>N° Reçu</th>
                                <th>Designation</th>
                                <th>Montant</th>
                                <th>Etat</th>
                                <th>Date du Paiment</th>
                                @staff
                                <th>Action</th>
                                @endstaff
                            </thead>
                            @php
                                $i = 0;
                            @endphp
                            <tbody id="paimentSection">
                                @if (isset($lastPaiments))
                                    @foreach ($lastPaiments as $paiment)
                                        <tr>
                                            @staff
                                            <td class="align-middle">
                                                <input type="checkbox" name="paiments[]" value="{{ $paiment->idPayment }}"class="form-check-input archivedStudents">
                                            </td>
                                            @endstaff
                                            <td class="align-middle">{{++$i}}</td>
                                            <td class="align-middle">
                                                @if (is_null($paiment->numeroRecu))
                                                    -
                                                @else
                                                    {{Storage::get('config.txt')}}-N° {{$paiment->numeroRecu}}
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if (is_null($paiment->idPaiment))
                                                    {{$paiment->designation}}
                                                @else
                                                    {{$paiment->groupsDesignation}}
                                                @endif
                                                <p>{{$paiment->note}}</p>
                                            </td>
                                            <td class="align-middle">
                                                @if ($paiment->etat == 0)
                                                {{$paiment->amount-$paiment->amountPaid}} DH
                                                @else
                                                {{$paiment->amount}} DH
                                                @endif

                                            </td>
                                            <td class="align-middle">
                                                @if ($paiment->etat == 0)
                                                    <span class="badge badge-warning">Non Payé</span>
                                                @elseif ($paiment->etat == 1)
                                                    <span class="badge badge-success">Réglé</span>
                                                @elseif($paiment->etat == 2)
                                                    <span class="badge badge-dark">Désactivé</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if (is_null($paiment->datePayment))
                                                    -
                                                @else
                                                    {{$paiment->datePayment}}
                                                @endif
                                            </td>
                                            @staff
                                            <td class="align-middle">
                                                <div class="btn-group-spaced">
                                                    @if ($paiment->etat == 0)
                                                    <button type="button" class="btn btn-outline-info payInvoiceBtn" data-bs-toggle="modal" data-bs-target="#invoicePaiment" value="{{$paiment->idPayment}}">
                                                        <span class="mdi mdi-check-bold"></span>
                                                    </button>
                                                    @elseif($paiment->etat == 2)
                                                    <button type="button" class="btn btn-outline-warning activateInvoice" value="{{$item->idPayment}}"><span class="mdi mdi-lock-open-outline"></span></button>
                                                    @endif
                                                    <button type="button" class="btn btn-outline-danger" onclick="deleteInvoice({{$paiment->idPayment}})">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            @endstaff
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col btns">
                                <button type="submit" name="deleteAll" class="btn btn-outline-danger"
                                    onclick="return confirm('Voulez-vous supprimer définitivement ces Etudiants?');">
                                    <i class="bi bi-trash-fill"></i> Supprimer Tous
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('pages.students.add2Group')
    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#groupPaiments').on('change',function(){
                $('#paimentSection').empty();
                var idGroup = $('#groupPaiments').val();
                var idStudent = "{{$student->idStudent}}";

                // AJAX request
                $.ajax({
                    url: '/student/' + idStudent + '/groupPaiment/' + idGroup,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        if(response.length > 0){
                            var html = '';
                            for (let i = 0; i < response.length; i++) {
                                html = '<tr>';
                                html += '<td class="align-middle"><input type="checkbox" name="paiments[]" value="'+response[i].idPayment+'"class="form-check-input archivedStudents"></td><td class="align-middle">'+(i+1)+'</td>';
                                html += '<td class="align-middle">'+((response[i].numeroRecu == null) ? '-' :'CA-N°'+response[i].numeroRecu)+'</td>';
                                html += '<td class="align-middle">'+((response[i].idPaiment == null) ? response[i].designation : response[i].groupsDesignation)+' <p>'+response[i].note+'</p></td>';
                                html += '<td class="align-middle">'+((response[i].etat == 0) ? (response[i].amount - response[i].amountPaid) : response[i].amount)+' DH</td>';
                                if(response[i].etat == 0)
                                    html += '<td class="align-middle"><span class="badge badge-warning">Non Payé</span></td>';
                                else if(response[i].etat == 1)
                                    html += '<td class="align-middle"><span class="badge badge-success">Réglé</span></td>';
                                else if(response[i].etat == 2){
                                    html += '<td class="align-middle"><span class="badge badge-dark">Désactivé</span></td>';
                                }
                                html += '<td class="align-middle">'+((response[i].datePayment == null) ? '-' : response[i].datePayment)+'</td>';
                                if(response[i].etat == 0)
                                    html += '<td class="align-middle"> <div class="btn-group-spaced"><button type="button" class="btn btn-outline-info payInvoiceBtn" data-bs-toggle="modal" data-bs-target="#invoicePaiment" value="'+response[i].idPayment+'"> <span class="mdi mdi-check-bold"></span> </button> <button type="button" class="btn btn-outline-danger" onclick="deleteInvoice('+response[i].idPayment+')"> <i class="bi bi-trash-fill"></i> </button> </div> </td><tr>';
                                else if(response[i].etat == 1)
                                    html += '<td class="align-middle"> <div class="btn-group-spaced"><button type="button" class="btn btn-outline-danger" onclick="deleteInvoice('+response[i].idPayment+')"> <i class="bi bi-trash-fill"></i> </button> </div> </td><tr>';
                                else if(response[i].etat == 2){
                                    html += '<td class="align-middle"> <div class="btn-group-spaced"><button type="button" class="btn btn-outline-warning activateInvoice" value="'+response[i].idPayment+'"> <span class="mdi mdi-lock-open-outline"></span> </button> <button type="button" class="btn btn-outline-danger" onclick="deleteInvoice('+response[i].idPayment+')"> <i class="bi bi-trash-fill"></i> </button> </div> </td><tr>';
                                }
                                $('#paimentSection').append(html);
                            }
                        }
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#showFormButton").click(function() {
                $("#formSection").slideToggle();
            });
        });
        $(document).ready(function() {
            $("#addPayment").click(function() {
                $("#paymentForm").slideToggle();
            });
        });
    </script>
    <script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>
    <script>
        $('.add2GroupBtn').click(function() {
            $('#idStudent').val($(this).val());
            $('#gradesSelect').find('option').remove();
            $('#groupsResult').find('div').remove();
            $("#subjectSelect").prop('selectedIndex', 0);
        });
    </script>

    <script>
        // Listen for click on toggle checkbox
        $('#selectAllArchived').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $(".btns").hide();
        $(":checkbox").click(function() {
            if ($(this).is(":checked")) {
                $(".btns").show();
            } else {
                $(".btns").hide();
            }
        });
    </script>

    <script>
        function deleteInvoice(id){
            Swal.fire({
                title: "Vous êtes sur le point de supprimer cette facture",
                icon: "warning",
                iconColor: "red",
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: `Annuler`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/bmapaiment/delete/"+id;
                }
            })
        }
    </script>

    {{-- Paiment Modal --}}
    <script>
        $(document).on('click','.payInvoiceBtn', function(){
            var idPaiment = $(this).val();

            // AJAX request
            $.ajax({
                url: '/getbmapaiment/'+idPaiment,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#invoicePaimentForm').attr('action','/bmapaiment/'+response.idPayment);
                    $('#paimentNote').empty();
                    $("#paimentNote").append(response.note);
                    if(response.idGroup == null)
                        $('#paimentDesignation').val(response.incomeDesignation);
                    else
                        $('#paimentDesignation').val(response.groupDesignation);
                    $('#paimentIdStudent').val(response.matricule);
                    $('#paimentAmount').val(response.amount - response.amountPaid);
                    $('#paimentAmountPaid').attr('max',response.amount);
                    if(response.numeroRecu != null){
                        $('#numeroRecu').val(response.numeroRecu);
                        $('#numeroRecu').prop('readonly',true);
                    }
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
        });
    </script>

    {{-- Delete Note --}}
    <script>
        $('.deleteNote').on('click', function(){
            let idNote = $(this).val();
            Swal.fire({
                icon: 'warning',
                title: 'Attention',
                text: 'Vous êtes sur le point de supprimer cette note !',
                showCancelButton: true,
                cancelButtonText: 'Annuler',
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        type:'DELETE',
                        url:"{{ route('notes.delete') }}",
                        data:{"idNote" : idNote, "_token" : "{{ csrf_token() }}"},
                        success: function(response) {
                            if(response == 'true')
                                Swal.fire('Note Supprimée avec Succée!', '', 'success')
                            else
                                Swal.fire('problème rencontré ! Réessayez !', '', 'warning')
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                }
            });
        });
    </script>

    {{-- Activate Paiments --}}
    <script>
        $(document).on('click','.activateInvoice', function(){
            let idPayment = $(this).val();
            Swal.fire({
                icon: 'warning',
                title: 'Voulez-vous activer ce paiement ?',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: `Annuler`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type:'post',
                            url:"{{ route('paiment.activate') }}",
                            data:{"idPayment" : idPayment, "_token" : "{{ csrf_token() }}"},
                            success: function(response) {
                                if(response == true)
                                    Swal.fire('Paiement Activé !', '', 'success').then((result2) => {
                                        location.reload(true);
                                        Swal.fire('Reloading!')
                                    })
                                else
                                    Swal.fire('problème rencontré ! Réessayez !', '', 'warning')
                            },
                            error: function(request, status, error) {
                                console.log(request.responseText);
                            }
                        });
                    }
            })
        });
    </script>
@endsection
