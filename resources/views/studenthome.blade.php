@extends('layouts.layout')
@section('title')
    Acceuil
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        @if (is_null($student->nom_ar) || is_null($student->prenom_ar))
            <h1>Bonjour {{$student->prenom_fr}} {{strtoupper($student->nom_fr)}},</h1>
        @else
            <h1>Bonjour {{$student->prenom_fr}} {{strtoupper($student->nom_fr)}} - {{$student->prenom_ar}} {{$student->nom_ar}},</h1>
        @endif
    </div>
</div>
	<!--  WRAPPER  -->
    <div class="ec-content-wrapper">
        <div class="content">
            <!-- Top Statistics -->
            <div class="row">
                <div class="col-xl-6 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-1">
                        <div class="card-body">
                            <h2 class="mb-1">{{$studentGroups->count()}}</h2>
                            <p>Nombre des Groups</p>
                            <span class="mdi mdi-account-arrow-left"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-2">
                        <div class="card-body">
                            <h2 class="mb-1">{{$pendingPaiment->count()}}</h2>
                            <p>Factures Impayées</p>
                            <span class="mdi mdi-content-paste"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Remarques --}}
                <div class="col-xl-6 col-md-12">
                    <div class="card card-default mb-24px">
                        <div class="card-header justify-content-between mb-1">
                            <h2>Remarques</h2>
                        </div>
                            <div class="card-body compact-notifications" data-simplebar style="height: auto!important;max-height: 300px!important;">
                                @if (isset($notes))
                                    @if ($notes->count() != 0)
                                        @foreach ($notes as $note)
                                        @php
                                            $date = date_create($note->created_at)
                                        @endphp
                                            <div class="media pb-3 align-items-center justify-content-between">
                                                <div class="media-body pr-3 ">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark">Note du Group: {{ $note->designation }}</a> <span class="badge badge-primary"><i class="mdi mdi-clock-outline"></i> {{date_format($note->created_at,'d-m-Y')}}</span>
        
                                                    <p>{{ $note->note }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                    <div class="alert alert-warning">
                                        Aucune <b>Remarque</b> n'a été trouvée!
                                    </div>
                                    @endif

                                @endif
    
                            </div>
                        <div class="mt-3"></div>
                    </div>
                </div>
                

                {{-- Last Activity --}}
                <div class="col-xl-6 col-md-12 p-b-15">
                    <div class="card card-default mb-24px">
                        <div class="card-header justify-content-between mb-1">
                            <h2>Les Dernières Fréquentations</h2>
                            <div>
                                <a href="{{route('absence')}}">
                                    <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-open-in-new"></i></button>
                                </a>
                            </div>
    
                        </div>
                            <div class="card-body compact-notifications" data-simplebar style="height: auto!important;max-height: 300px!important;">
                                    @if ($lastestAttendances->count() == 0)
                                        <div class="alert alert-warning">
                                            Aucune <b>Fréquentation</b> n'a été trouvée!
                                        </div>
                                    @else
                                        @foreach ($lastestAttendances as $attendance)
                                            <div class="media pb-3 align-items-center justify-content-between">
                                                <div class="media-body pr-3 ">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Group: {{ $attendance->designation }}</a>
                                                    @if ($attendance->absence == 0)
                                                        <p><span class="badge badge-success">Présent(e)</span></p>
                                                    @else
                                                        <p><span class="badge badge-danger">Absent(e)</span></p>
                                                    @endif
                                                </div>
                                                <span class=" font-size-12 d-inline-block">
                                                    <i class="mdi mdi-clock-outline"></i> {{$attendance->dateAbsence}}
                                                </span>
                                            </div>
                                        @endforeach
                                    @endif    
                            </div>
                        <div class="mt-3"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Pending Paiment --}}
                <div class="col-xl-6 col-md-12 p-b-15">
                    <div class="card card-default mb-24px">
                        <div class="card-header justify-content-between mb-1">
                            <h2>Factures</h2>
                            <div>
                                <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-cached"></i></button>
                            </div>
    
                        </div>
                            <div class="card-body compact-notifications" data-simplebar style="height: auto!important;max-height: 300px!important;">
                                @if (isset($pendingPaiment))
                                    @if ($pendingPaiment->count() == 0)
                                        <div class="alert alert-warning">
                                            Aucune facture <b>impayée</b> n'a été trouvée!
                                        </div>
                                    @else
                                        @foreach ($pendingPaiment as $item)
                                            @if (is_null($item->idGroup))
                                            <div class="media pb-3 align-items-center justify-content-between">
                                                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                                    <span class="mdi mdi-receipt"></span>
                                                </div>
                                                <div class="media-body pr-3 ">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Facture: {{ $item->description }}</a> <span class="badge badge-danger">{{$item->amount - $item->amountPaid}} DH</span>
        
                                                    <p>{{ $item->note }}</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block">
                                                    <button class="btn btn-outline-success payInvoiceBtn" data-bs-toggle="modal"
                                                    data-bs-target="#invoicePaiment" value="{{$item->idPayment}}"><span class="mdi mdi-check"></span></button>
                                                </span>
                                            </div>
                                            @else
                                            <div class="media pb-3 align-items-center justify-content-between">
                                                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                                    <span class="mdi mdi-receipt"></span>
                                                </div>
                                                <div class="media-body pr-3 ">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark" href="{{route('groups.profil',['idGroup' => $item->idGroup ])}}">Facture: {{ $item->designation }}</a> <span class="badge badge-danger">{{$item->amount - $item->amountPaid}} DH</span>
        
                                                    <p>{{ $item->note }}</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block">
                                                        <button class="btn btn-outline-success payInvoiceBtn" data-bs-toggle="modal"
                                                        data-bs-target="#invoicePaiment" value="{{$item->idPayment}}"><span class="mdi mdi-check"></span></button>
                                                </span>
                                            </div>
                                            @endif 
                                        @endforeach
                                    @endif

                                @endif
    
                            </div>
                        <div class="mt-3"></div>
                    </div>
                </div>
                {{-- Groups --}}
                <div class="col-xl-6 col-md-12 p-b-15">
                    <div class="card card-default mb-24px">
                        <div class="card-header justify-content-between mb-1">
                            <h2>Groupes</h2>
                            <a href="{{route('groups')}}">
                                <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-open-in-new"></i></button>
                            </a>
                        </div>
                        <div class="card-body compact-notifications" data-simplebar style="height: auto!important;max-height: 300px!important;">
                            @if ($studentGroups->count() == 0)
                                <div class="alert alert-warning">
                                    Aucune facture <b>impayée</b> n'a été trouvée!
                                </div>
                            @else
                                @foreach ($studentGroups as $group)
                                <div class="media pb-3 align-items-center justify-content-between">
                                    <div
                                        class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                        {{$group->shortForm}}
                                    </div>
                                    <div class="media-body pr-3 ">
                                        <a class="mt-0 mb-1 font-size-15 text-dark" href="{{route('groups.profil', ['idGroup' => $group->idGroup])}}" target="_blank">Groupe: {{$group->designation}}</a> <span  class="badge badge-dark">{{$group->nbElements}}/{{$group->capacity}}</span>

                                        <p>{{$group->prenom}} {{$group->nom}}</p>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mt-3"></div>
                    </div>
                </div>

            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
    <script src="{{asset('assets/js/chart.js')}}"></script>
    
@endsection