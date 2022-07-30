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
            <span><i class="mdi mdi-chevron-right"></i></span><a href="{{route('student.archive')}}">Archive des Etudiants</a>
            <span><i class="mdi mdi-chevron-right"></i></span>{{$student->prenom_fr." ".$student->nom_fr}}
        </p>
    </div>
</div>
  <!--message success -->
  @if (session()->has('successType'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{session()->get('successType')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @elseif(session()->has('deleteType'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{session()->get('deleteType')}}
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
                    <p class="text-dark font-weight-medium pt-24px mb-2">Supprimé le:</p>
                    <p>{{$student->deleted_at}}</p>
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