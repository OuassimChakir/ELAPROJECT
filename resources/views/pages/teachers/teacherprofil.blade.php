@extends('layouts.layout')
@section('title')
    {{$teacher->prenom." ".$teacher->nom}}
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css"> 
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>{{$teacher->prenom." ".$teacher->nom}}</h1>
        <p class="breadcrumbs"><span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span><a href="{{route('teachers.liste')}}">Professeurs</a>
            <span><i class="mdi mdi-chevron-right"></i></span>{{$teacher->prenom." ".$teacher->nom}}
        </p>
    </div>
</div>

<div class="card bg-white profile-content">
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <div class="profile-content-left profile-left-spacing">
                <div class="text-center widget-profile px-0 border-0">
                    <div class="card-body">
                        <h4 class="py-2 text-dark">{{ucfirst($teacher->prenom)." ".strtoupper($teacher->nom)}}</h4>
                        @if ($teacher->sexe == "M")
                            <p><div class="badge badge-pill badge-info">Male</div></p>
                        @else
                            <p><div class="badge badge-pill badge-purple">Female</div></p>
                        @endif
                        <p>{{$teacher->cnie}}</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
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
                    <p class="text-dark font-weight-medium pt-24px mb-2">Matière Enseignée</p>
                    <p><div class="badge badge-dark">{{$teacher->libelle}}</div></p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Email</p>
                    <p>{{$teacher->email}}</p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Numéro de Téléphone</p>
                    <p>{{$teacher->numTel}}</p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Date d'engagement</p>
                    <p>{{$teacher->dateEngagement}}</p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Modifié le:</p>
                    <p>{{$teacher->UPDATED_AT}}</p>
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
                        <button class="nav-link" id="settings-tab" data-bs-toggle="tab"
                            data-bs-target="#settings" type="button" role="tab"
                            aria-controls="settings" aria-selected="false">Paramètres</button>
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
                                            <div
                                                class="media pb-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                    <i
                                                        class="mdi mdi-cart-outline font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3 ">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">New Order</a>
                                                    <p>Selena has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 10
                                                    AM</span>
                                            </div>

                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                                                    <i
                                                        class="mdi mdi-email-outline font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">New Enquiry</a>
                                                    <p>Phileine has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 9
                                                    AM</span>
                                            </div>


                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                                    <i
                                                        class="mdi mdi-stack-exchange font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">Support Ticket</a>
                                                    <p>Emma has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 10
                                                    AM</span>
                                            </div>

                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                    <i
                                                        class="mdi mdi-cart-outline font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">New order</a>
                                                    <p>Ryan has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 10
                                                    AM</span>
                                            </div>

                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
                                                    <i
                                                        class="mdi mdi-calendar-blank font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="">Comapny Meetup</a>
                                                    <p>Phileine has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 10
                                                    AM</span>
                                            </div>

                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                                    <i
                                                        class="mdi mdi-stack-exchange font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">Support Ticket</a>
                                                    <p>Emma has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 10
                                                    AM</span>
                                            </div>

                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                                                    <i
                                                        class="mdi mdi-email-outline font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">New Enquiry</a>
                                                    <p>Phileine has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 9
                                                    AM</span>
                                            </div>

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
                            <form action="{{route('teachers.update',['idProfesseur' => $teacher->idProfesseur])}}" method="post">
                                @csrf
                                @method('put')  
                                <div class="modal-body px-4">
                                    <div class="row mb-2 g-3">                     
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstName">Prénom</label>
                                                <input type="text" class="form-control" name="prenom" id="firstName" value="{{$teacher->prenom}}" required>
                                            </div>
                                        </div>
                
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="lastName">Nom</label>
                                                <input type="text" class="form-control" name="nom" id="lastName" value="{{$teacher->nom}}" required>
                                            </div>
                                        </div>
                
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="numTel">Numéro de Téléphone</label>
                                                <input type="tel" class="form-control" name="numTel" id="numTel" value="{{$teacher->numTel}}" required>
                                            </div>
                                        </div>
                
                                        <!-- sexe -->
                                        <div class="col-lg-6">
                                            <div class="form-group mb-2">
                                                <label>Sexe</label>
                                                <div class="col-6 d-flex align-items-center justify-content-between">
                                                    @if ($teacher->sexe == "M")
                                                        <div class="form-check">
                                                            <input class="form-check-input" value="M" type="radio" name="sexe" id="homme" checked>
                                                            <label class="form-check-label" for="homme">Homme</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" value="F" type="radio" name="sexe" id="femme" >
                                                            <label class="form-check-label" for="femme">Femme</label>
                                                        </div>
                                                    @else
                                                        <div class="form-check">
                                                            <input class="form-check-input" value="M" type="radio" name="sexe" id="homme" >
                                                            <label class="form-check-label" for="homme">Homme</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" value="F" type="radio" name="sexe" id="femme" checked>
                                                            <label class="form-check-label" for="femme">Femme</label>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="cine">CINE</label>
                                                <input type="text" class="form-control" name="cine" id="cine"value="{{$teacher->cnie}}" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="form-label">Matières</label>
                                                <select name="idSubject" id="id-Subject" class="form-select" required>
                                                    <option disabled selected>-- Choisir une Matière</option>
                                                    @foreach ($courseTypes as $courseType)  
                                                        <optgroup label="{{$courseType->course}}">
                                                            @foreach ($subjects as $subject)
                                                                @if ($courseType->idCourseType == $subject->idCourseType)
                                                                    @if ($teacher->idSubject == $subject->idSubject)
                                                                        <option value="{{ $subject->idSubject }}" selected>
                                                                            {{ $subject->libelle  }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $subject->idSubject }}">
                                                                            {{ $subject->libelle  }}
                                                                        </option>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                
                
                
                                        
                                    </div>
                                </div>
                                <div class="modal-footer px-4">
                                    <a href="{{route('teachers.delete',['idProfesseur' => $teacher->idProfesseur])}}">
                                        <button type="button" class="btn btn-outline-danger btn-pill"  onclick="return confirm('Vous êtes sûr?');">Supprimer le Compte</button>
                                    </a>
                                    <button type="submit" name="updateTeacher" class="btn btn-warning btn-pill">Mettre à jour</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

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

@endsection