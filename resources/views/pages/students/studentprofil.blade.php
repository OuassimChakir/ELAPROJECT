@extends('layouts.layout')
@section('title')
    {{$student->prenom_fr." ".$student->nom_fr}}
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css"> 
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>{{$student->prenom_fr." ".$student->nom_fr}}</h1>
        <p class="breadcrumbs"><span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span><a href="{{route('student.liste')}}">Etudiants</a>
            <span><i class="mdi mdi-chevron-right"></i></span>{{$student->prenom_fr." ".$student->nom_fr}}
        </p>
    </div>
</div>
  <!--message success -->
  @if (session()->has('successMessage'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{session()->get('successMessage')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @elseif(session()->has('deleteMessage'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{session()->get('deleteMessage')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @elseif(session()->has('updateMessage'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
      {{session()->get('updateMessage')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <!-- end errour du validation -->
<div class="card bg-white profile-content">
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <div class="profile-content-left profile-left-spacing">
                <div class="text-center widget-profile px-0 border-0">
                    <div class="card-body">
                        <h4 class="py-2 text-dark">{{$student->prenom_fr." ".$student->nom_fr}}</h4>
                        <p>{{$student->matricule}}</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between ">
                    <div class="text-center pb-4">
                        <h6 class="text-dark pb-2">10</h6>
                        <p>Absences</p>
                    </div>

                    <div class="text-center pb-4">
                        <h6 class="text-dark pb-2">32</h6>
                        <p>Wish List</p>
                    </div>

                    <div class="text-center pb-4">
                        <h6 class="text-dark pb-2">1150</h6>
                        <p>Following</p>
                    </div>
                </div>

                <hr class="w-100">

                <div class="contact-info pt-4">
                    <h5 class="text-dark">Information</h5>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Né(e) le:</p>
                    <p>{{$student->dateNaissance}}</p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Email</p>
                    <p>{{$student->email}}</p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Numéro de Téléphone</p>
                    <p>{{$student->sNumTel}}</p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Sexe</p>
                    <p>{{ucfirst($student->sSexe)}}</p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Adresse</p>
                    <p>{{$student->adresse}}</p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Inscrie le:</p>
                    <p>{{$student->sCREATED_AT}}</p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Modifié le:</p>
                    <p>{{$student->sUPDATED_AT}}</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8 col-xl-9">
            <div class="profile-content-right profile-right-spacing py-5">
                <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="true">Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="groups-tab" data-bs-toggle="tab"
                            data-bs-target="#groups" type="button" role="tab"
                            aria-controls="groups" aria-selected="false">Groupes</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="settings-tab" data-bs-toggle="tab"
                            data-bs-target="#settings" type="button" role="tab"
                            aria-controls="settings" aria-selected="false">Paramètres</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="recus-tab" data-bs-toggle="tab"
                            data-bs-target="#recus" type="button" role="tab"
                            aria-controls="recus" aria-selected="false">Reçus</button>
                    </li>

                </ul>
                <div class="tab-content px-3 px-xl-5" id="myTabContent">

                    <div class="tab-pane fade show active" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <div class="tab-widget mt-5">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="media widget-media p-3 bg-white border">
                                        <div class="icon rounded-circle mr-3 bg-primary">
                                            <i class="mdi mdi-account-outline text-white "></i>
                                        </div>

                                        <div class="media-body align-self-center">
                                            <h4 class="text-primary mb-2">546</h4>
                                            <p>Bought</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="media widget-media p-3 bg-white border">
                                        <div class="icon rounded-circle bg-warning mr-3">
                                            <i class="mdi mdi-cart-outline text-white "></i>
                                        </div>

                                        <div class="media-body align-self-center">
                                            <h4 class="text-primary mb-2">1953</h4>
                                            <p>Wish List</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="media widget-media p-3 bg-white border">
                                        <div class="icon rounded-circle mr-3 bg-success">
                                            <i class="mdi mdi-ticket-percent text-white "></i>
                                        </div>

                                        <div class="media-body align-self-center">
                                            <h4 class="text-primary mb-2">02</h4>
                                            <p>Voucher</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">

                                    <!-- Notification Table -->
                                    <div class="card card-default">
                                        <div class="card-header justify-content-between mb-1">
                                            <h2>Absences</h2>
                                        </div>
                                        <div class="card-body compact-notifications" data-simplebar
                                            style="height: 434px;">
                                            @foreach ($absence as $absenc)
                                            @if($absenc->matricule == $student->matricule )
                                            @elseif($absenc->absence == 1 || $absenc->absence == 2)
                                                <div class="media pb-3 align-items-center justify-content-between">
                                                    <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                        <i class="bi bi-list-stars"></i>                                               
                                                    </div>
                                                    <div class="media-body pr-3 ">
                                                        <a class="mt-0 mb-1 font-size-15 text-dark" href="#">                                                    @foreach($allgroup as $allgroups)
                                                            @if($absenc->idGroup == $allgroups->idGroup)
                                                            {{$allgroups->designation}}
                                                            @endif
                                                            @endforeach
                                                        </a>
                                                    </div>    
                                                    <span class="font-size-12  d-inline-block mr-3"><i class="mdi mdi-clock-outline"></i> {{$absenc->dateAbsence}}</span>
                                                    </a>
                                                </div> 
                                           @endif
                                           @endforeach
                                        </div>
                                        <div class="mt-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SETTINGS OF THE ACCOUNT --}}
                    <div class="tab-pane fade" id="settings" role="tabpanel"
                        aria-labelledby="settings-tab">
                        <div class="tab-pane-content mt-5">
                            <form action="{{route('student.update',['matricule' => $student->matricule])}}" method="post">
                                @csrf
                                @method('put')  
                                <div class="modal-body px-4">
                                    <div class="row mb-2 g-3">                     
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstName">Prénom</label>
                                                <input type="text" class="form-control" name="prenom_fr" id="firstName" value="{{$student->prenom_fr}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" dir="rtl">
                                            <div class="form-group">
                                                <label for="firstName_ar" lang="ar">الإسم الشخصي</label>
                                                <input type="text" class="form-control keyboardInput" lang="ar" name="prenom_ar" id="firstName_ar" value="{{$student->prenom_ar}}" dir="rtl" required>
                                            </div>
                                        </div>
                                        <!-- les nom arabe et françe-->
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="lastName">Nom</label>
                                                <input type="text" class="form-control" name="nom_fr" id="lastName" value="{{$student->nom_fr}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" dir="rtl">
                                            <div class="form-group">
                                                <label for="lastName_ar" lang="ar">الإسم العائلي</label>
                                                <input type="text" class="form-control keyboardInput" lang="ar" name="nom_ar" id="lastName_ar" dir="rtl" value="{{$student->nom_ar}}" required>
                                            </div>
                                        </div>
                                        <!-- Email-->
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    value="{{$student->email}}" required>
                                            </div>
                                        </div>
                                         <!-- Numéro de Téléphone-->
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="numTel">Numéro de Téléphone</label>
                                                <input type="tel" class="form-control" name="numTel" id="numTel"
                                                    value="{{$student->sNumTel}}" required>
                                            </div>
                                        </div>
                                         <!-- date Naissance-->
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="date">date Naissance</label>
                                                <input type="date" class="form-control" name="dateNaissance" id="date" value="{{$student->dateNaissance}}">
                                            </div>
                                        </div>
                                         <!-- numéro de carte d'identifion-->
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="CINE">CINE</label>
                                                <input type="text" class="form-control" name="cnie" id="CINE"
                                                    value="{{$student->cnie}}" required>
                                            </div>
                                        </div>
                                        <!-- sexe -->
                                        <div class="col-lg-12">
                                            <div class="form-group mb-2">
                                                <label>Sexe</label>
                                                <div class="col-6 d-flex align-items-center justify-content-between">
                                                @if ($student->sSexe == "Homme")
                                                    <div class="form-check">
                                                        <input class="form-check-input" value="Homme" type="radio" name="sexe" id="sexe1" checked>
                                                        <label class="form-check-label" for="sexe1">Homme</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" value="Femme" type="radio" name="sexe" id="sexe2" >
                                                        <label class="form-check-label" for="sexe2">Femme</label>
                                                    </div>
                                                    </div>
                                                @else
                                                    <div class="form-check">
                                                        <input class="form-check-input" value="Homme" type="radio" name="sexe" id="sexe1">
                                                        <label class="form-check-label" for="sexe1">Homme</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" value="Femme" type="radio" name="sexe" id="sexe2" checked>
                                                        <label class="form-check-label" for="sexe2">Femme</label>
                                                    </div>
                                                    </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <!-- adresse-->
                                        <div class="col-lg-12">
                                            <div class="form-group mb-4">
                                                <label for="adresse">Adresse</label>
                                                <input type="text" class="form-control" name="adresse" id="adresse" value="{{$student->adresse}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer px-4">
                                    <a href="{{route('student.delete',['matricule' => $student->matricule])}}">
                                        <button type="button" class="btn btn-outline-danger btn-pill"  onclick="return confirm('Vous êtes sûr?');">Supprimer le Compte</button>
                                    </a>
                                    <button type="submit" name="updateStudent" class="btn btn-warning btn-pill">Mise à jour</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- GROUPS TAB --}}
                    <div class="tab-pane fade" id="groups" role="tabpanel"
                        aria-labelledby="groups-tab">
                        <div class="tab-widget mt-5">
                            <div class="row">
                                <div class="col-xl-10">
                                    <div class="media widget-media p-3 bg-white border">
                                        <div class="icon rounded-circle mr-3 bg-primary">
                                            <i class="mdi mdi-account-outline text-white "></i>
                                        </div>

                                        <div class="media-body align-self-center">
                                            <h4 class="text-primary mb-2">
                                                @if (is_null($groupes))
                                                    0
                                                @else
                                                    {{count($groupes)}}
                                                @endif
                                            </h4>
                                            <p>Groupes Assigné</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-2">
                                    <button class="add2GroupBtn btn btn-outline-success" value="{{$student->matricule}}" data-bs-toggle="modal" data-bs-target="#add2Group" id="tab-widget-addBtn">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">

                                    <!-- Notification Table -->
                                    <div class="card card-default">
                                        <div class="card-header justify-content-between mb-1">
                                            <h2>Groupes</h2>
                                        </div>
                                        @if (!isset($groupes[0]))
                                            <div class="alert alert-warning">Cet étudiant n'appartient à aucun groupe</div>
                                        @else
                                        <div class="card-body compact-notifications" data-simplebar style="height: 434px;">
                                            @foreach ($groupes as $group)
                                                <div class="media pb-3 align-items-center justify-content-between">
                                                    <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                        <i class="bi bi-list-stars"></i>
                                                    </div>
                                                    <div class="media-body pr-3 ">
                                                        <a class="mt-0 mb-1 font-size-15 text-dark" href="#">{{$group->designation}}</a> <span class="badge badge-pill badge-info">{{$group->nbElement.'/'.$group->capacity}}</span>

                                                        <p><a href="{{route('teachers.profil',['idProfesseur'=>$group->idStaff, 'nom'=>$group->nom])}}"></a></p>
                                                    </div>
                                                    <span class="font-size-12  d-inline-block mr-3"><i class="mdi mdi-clock-outline"></i> {{$group->CREATED_AT}}</span>
                                                    <a href="{{route('classroom.cancelAssignment',['id'=>$group->id])}}">
                                                        <button class="btn btn-outline-danger" value="{{$group->id}}" onclick="return confirm('Confirmer votre Operation')">
                                                            <i class="bi bi-x-lg"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div>
                                        @endif
                                        <div class="mt-3"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Reçus TAB --}}
                    <div class="tab-pane fade" id="recus" role="tabpanel"
                    aria-labelledby="recus-tab">
                    <div class="col-5 modal-footer px-4">
                        <button type="button" class="btn btn-primary" id="showFormButton">
                            <i class="bi bi-plus-square"></i> Ajouter une Reçus
                        </button>
                    </div>
                    <form action="{{route('incomePayment.add')}}" method="post"> 
                        @csrf
                        @method('post')
                        <div class="modal-body px-4" id="formSection">
                                <div class="row mb-2 g-3">  
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="form-label">Reçus de Payment</label>
                                            <select name="idIncome"  class="form-select" required>
                                                <option disabled selected>-- Choisir type de Revenus --</option>
                                                    @foreach ($incomes as $income)
                                                        <option value="{{$income->idIncome}}">
                                                            {{$income->designation }}
                                                        </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="staffSelect form-group mb-4">
                                            <label for="form-label" id="staffLabel">Etudiants</label>
                                            <input type="text" name="matricule" class="form-control" value="{{$student->matricule}}" id="matricule" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2 g-3">  
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="datePayment">Date du Payement</label>
                                            <input type="date" name="datePayment" class="form-control" id="datePayment">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="form-label">Montant</label>
                                            <input type="number" name="amount" class="form-control" id="amount"><small class="text-muted">HD</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2 g-3">
                                    <div class="col-lg-6">
                                        <label>Type de Paiement</label>
                                        <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" value="Espece" type="radio" name="paymentMode" id="typePyament1" checked>
                                            <label class="form-check-label" for="typePyament1" checked>
                                                Espèce 	
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input"  value="Virement" type="radio" name="paymentMode" id="typePyament2" >
                                            <label class="form-check-label" for="typePyament2">
                                                Virement Bancaire 
                                            </label>
                                          </div>
                                        </div>
                                     </div>  
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
        
                        <div class="modal-footer px-4">
                            <button type="reset" class="btn btn-secondary btn-pill">Reset</button>
                            <button type="submit" name="addPayment" class="btn btn-primary btn-pill">Ajouter</button>
                        </div>
                    </form>
                </div>
                                                    <!-- Notification Table -->
                                                    <div class="card card-default">
                                                        <div class="card-header justify-content-between mb-1">
                                                            <h2>Les paiement de étudiant</h2>
                                                        </div>
                                                        <div class="card-body compact-notifications" data-simplebar
                                                            style="height: 434px;">
                                                            <table id="responsive-data-table"  class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Numéro</th>
                                                                        <th>Designation</th>
                                                                        <th>Type de Paiement</th>
                                                                        <th>Prix</th>
                                                                        <th>Date de Reçus</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                    
                                                                <tbody>
                                                                    @if (isset($incomePayment))
                                    
                                                                        @foreach ($incomePayment as $Payment)
                                                                            <tr>
                                                                                <td>ELA-R.{{str_pad((string) $Payment->idPayment, 4, 0, STR_PAD_LEFT)}}</td>
                                                                                <td><span class="badge badge-primary">{{$Payment->designation}}</span></td>
                                                                                <td>{{$Payment->paymentMode}}</td>
                                                                                <td><span class="badge badge-dark">{{$Payment->amount}} DH</span></td>
                                                                                <td>{{$Payment->datePayment}}</td>
                                                                                <td>
                                                                                    <div class="btn-group-spaced">
                                                                                        <a href="" target="_blank">
                                                                                            <button type="submit" class="btn btn-outline-success" name="print">
                                                                                                <i class="bi bi-printer-fill"></i></i>
                                                                                            </button>
                                                                                        </a>
                                                                                        <a href="{{route('incomePayment.delete',['idPayment'=>$Payment->idPayment])}}">
                                                                                            <button type="submit" class="btn btn-outline-danger" name="deletePayment" onclick="return confirm('Vous êtes sûr?');">
                                                                                                    <i class="bi bi-trash-fill"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                        <div class="mt-3"></div>
                                                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            <div class="card-body">
                <div class="ec-cat-form">
                    <div class="row">
                        <div class="col-9">
                            <h4>Responsable</h4>
                        </div>
                        <div class="col-3 text-right responsableButtons">
                            @if (!is_null($student->cnieResponsible))
                                <a href="{{route('responsible.delete',['matricule' => $student->matricule, 'cnieResponsible' => $student->cnieResponsible])}}">
                                    <button type="button" class="btn btn-outline-danger btn-pill"  onclick="return confirm('Vous êtes sûr?');"><i class="bi bi-trash"></i></button>
                                </a>
                                <button type="button" class="btn btn-warning" id="showFormButton"><i class="bi bi-pencil" ></i></button> 
                            @else
                                <button type="button" class="btn btn-primary btn-pill" id="showFormButton"><i class="bi bi-plus-square"></i></button>
                            @endif
                        </div>
                    </div>

                    <div id="formSection">
                        @if (is_null($student->cnieResponsible))
                            <form action="{{route('responsible.add')}}" method="post">
                                @csrf
                                @method('post')
                                <div class="modal-header px-4">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un Responsable</h5>
                                </div>
                                <input type="hidden" name="matricule" value="{{$student->matricule}}">
                                <div class="modal-body px-4">
                                    <div class="row mb-2 g-3">                     
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstName">Prénom</label>
                                                <input type="text" class="form-control" name="prenom" id="firstName" required>
                                            </div>
                                        </div>                                    
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="lastName">Nom</label>
                                                <input type="text" class="form-control" name="nom" id="lastName" required>
                                            </div>
                                        </div>
                                        <!-- numéro de carte d'identifion-->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="CINE">CINE</label>
                                                <input type="text" class="form-control" name="cine" id="CINE" required>
                                            </div>
                                        </div>
                                        <!-- sexe -->
                                        <div class="col-lg-6">
                                            <div class="form-group mb-2">
                                                <label>Sexe</label>
                                                <div class="col-6 d-flex align-items-center justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input" value="Homme" type="radio" name="sexe" id="homme">
                                                    <label class="form-check-label" for="homme">
                                                    Homme
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" value="Femme" type="radio" name="sexe" id="femme" >
                                                    <label class="form-check-label" for="femme">
                                                    Femme
                                                    </label>
                                                </div></div>
                                            </div>
                                        </div>
                                        <!-- Numéro de Téléphone-->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="numTel">Numéro de Téléphone</label>
                                                <input type="tel" class="form-control" name="numTel" id="numTel" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="modal-footer px-4">
                                    <button type="submit" name="addReponsible" class="btn btn-primary btn-pill">Ajouter</button>
                                    <button type="reset" name="reset" class="btn btn-secondary btn-pill">Reset</button>
                                </div>
                            </form>
                        @else
                            <form action="{{route('responsible.update', ['cnieResponsible' => $student->cnieResponsible])}}" method="post">
                                @csrf
                                @method('put')
                                <div class="modal-header px-4">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Modifier le Responsable</h5>
                                </div>
                                <div class="modal-body px-4">
                                    <div class="row mb-2 g-3">                     
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstName">Prénom</label>
                                                <input type="text" class="form-control" name="prenom" id="firstName" value="{{$student->prenom}}" required>
                                            </div>
                                        </div>                                    
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="lastName">Nom</label>
                                                <input type="text" class="form-control" name="nom" id="lastName" value="{{$student->nom}}" required>
                                            </div>
                                        </div>
                                        <!-- numéro de carte d'identifion-->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="CINE">CINE</label>
                                                <input type="text" class="form-control" name="cine" id="CINE" value="{{$student->cnieResponsible}}" required>
                                            </div>
                                        </div>
                                        <!-- sexe -->
                                        <div class="col-lg-6">
                                            <div class="form-group mb-2">
                                                <label>Sexe</label>
                                                <div class="col-6 d-flex align-items-center justify-content-between">
                                                    @if ($student->rSexe == "Homme")
                                                        <div class="form-check">
                                                            <input class="form-check-input" value="Homme" type="radio" name="sexe" id="homme" checked>
                                                            <label class="form-check-label" for="homme">Homme</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" value="Femme" type="radio" name="sexe" id="femme" >
                                                            <label class="form-check-label" for="femme">Femme</label>
                                                        </div>
                                                    @else
                                                        <div class="form-check">
                                                            <input class="form-check-input" value="Homme" type="radio" name="sexe" id="homme" >
                                                            <label class="form-check-label" for="homme">Homme</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" value="Femme" type="radio" name="sexe" id="femme" checked>
                                                            <label class="form-check-label" for="femme">Femme</label>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Numéro de Téléphone-->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="numTel">Numéro de Téléphone</label>
                                                <input type="tel" class="form-control" name="numTel" id="numTel" value="{{$student->rTel}}" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="modal-footer px-4">
                                    <button type="submit" name="updateResponsible" class="btn btn-warning btn-pill">Mettre à Jour</button>
                                    <button type="reset" name="reset" class="btn btn-secondary btn-pill">Reset</button>
                                </div>
                            </form>
                        @endif
                        <hr>
                    </div>
                    @if (!is_null($student->cnieResponsible))
                        <div class="row">
                            <div class="col-6">
                                <div class="contact-info pt-4">
                                    <p class="text-dark font-weight-medium pt-24px mb-2">Nom Complet</p>
                                    <p>{{$student->prenom.' '.$student->nom}}</p>
                                    <p class="text-dark font-weight-medium pt-24px mb-2">CINE</p>
                                    <p>{{$student->cnieResponsible}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="contact-info pt-4">
                                    <p class="text-dark font-weight-medium pt-24px mb-2">Numéro de Téléphone</p>
                                    <p>{{$student->rTel}}</p>
                                    <p class="text-dark font-weight-medium pt-24px mb-2">Sexe</p>
                                    <p>{{$student->rSexe}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.students.add2Group')
<script src="{{asset('JS/jquery.min.js')}}"></script>
<script src="{{asset('Bootstrap/js/bootstrap.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#showFormButton").click(function(){
            $("#formSection").slideToggle();
        });
    });
</script>
<script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script> 
<script>
    $('.add2GroupBtn').click(function() {
        $('#idStudent').val($(this).val());
        $('#gradesSelect').find('option').remove();
        $('#groupsResult').find('div').remove();
        $("#subjectSelect").prop('selectedIndex',0);
    });
</script>
@endsection