@extends('layouts.layout')
@section('title')
    Acceuil
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Bonjour {{$teacher->prenom}} {{strtoupper($teacher->nom)}},</h1>
    </div>
</div>
	<!--  WRAPPER  -->
    <div class="ec-content-wrapper">
        <div class="content">
            <!-- Top Statistics --> 
            <div class="row">
                <div class="col-xl-12 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-1">
                        <div class="card-body">
                            <h2 class="mb-1">{{$teacherGroups->count()}}</h2>
                            <p>Nombre des Groups</p>
                            <span class="mdi mdi-account-arrow-left"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Groups --}}
                <div class="col-xl-6 col-md-12 p-b-15">
                    <div class="card card-default mb-24px">
                        <div class="card-header justify-content-between mb-1">
                            <h2>Groupes</h2>
                            <a href="{{route('groups')}}">
                                <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-open-in-new"></i></button>
                            </a>
                        </div>
                        <div class="card-body compact-notifications" data-simplebar style="height: 300px!important;">
                            @if ($teacherGroups->count() == 0)
                                <div class="alert alert-warning">
                                    Aucune <b>groupes</b> trouvée!
                                </div>
                            @else
                                @foreach ($teacherGroups as $group)
                                <div class="media pb-3 align-items-center justify-content-between">
                                    <div
                                        class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                        {{$group->shortForm}}
                                    </div>
                                    <div class="media-body pr-3 ">
                                        <a class="mt-0 mb-1 font-size-15 text-dark" href="{{route('groups.profil', ['idGroup' => $group->idGroup])}}" target="_blank">Groupe: {{$group->designation}}</a> <span  class="badge badge-dark">{{$group->nbElements}}/{{$group->capacity}}</span>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mt-3"></div>
                    </div>
                </div>

                {{-- Pending Paiment --}}
                <div class="col-xl-6 col-md-12 p-b-15">
                    <div class="card card-default mb-24px">
                        <div class="card-header justify-content-between mb-1">
                            <h2>Factures</h2>
                            <a href="{{route('teachers.factures',['idProfesseur' => auth()->user()->idProfesseur])}}">
                                <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-open-in-new"></i></button>
                            </a>
    
                        </div>
                            <div class="card-body compact-notifications" data-simplebar style="height: 300px!important;">
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
                                                    Facture: {{ $item->description }} <span class="badge badge-danger">{{$item->amount - $item->amountPaid}} DH</span>
        
                                                    <p>{{ $item->note }}</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block">
                                                        <a href="{{ route('teachers.pdf', ['idExpensePayment' => $item->idExpensePayment]) }}"
                                                            target="_blank">
                                                            <button type="submit" class="btn btn-outline-success" name="print">
                                                                <i class="bi bi-printer-fill"></i></i>
                                                            </button>
                                                        </a>

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
            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
    <script src="{{asset('assets/js/chart.js')}}"></script>
    
@endsection