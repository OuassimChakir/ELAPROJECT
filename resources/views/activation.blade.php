@extends('layouts.layout')
@section('title')
    Activation
@endsection
@section('content')
	<!--  WRAPPER  -->
    <div class="ec-content-wrapper">
        <div class="content">
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
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Activation</h1>
                    <p class="breadcrumbs">
                        <span><a href="{{route('acceuil')}}">Acceuil</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span><a href="{{route('activite')}}">Activités</a>
                    </p>
                </div>
            </div>
    <!-- Notification Table -->
<div class="card card-default">
    <form  action="#">
        @csrf
		<div class="card-header justify-content-between mb-1">
			<h2 class="mt-3">les dernières activations</h2>
			    <div class="col-5">
                   <label for="exampleFormControlTextarea1" class="form-label">Date Activités</label>
                   <input type="date" name="date" class="form-control" value="{{date('Y-m-d')}}" >
			    </div>
                <div class="mt-5">
                    <button type="submit" name="recherch" class="btn btn-warning btn-pill">Recherche</button>
			    </div>   
		</div>
    </form>
    <div class="card-body compact-notifications" data-simplebar style="height: 434px;">
        
    @if (isset($activites))
    @foreach($activites as $activite)
<div class="media pb-3 align-items-center justify-content-between">
            @php
                $a = "a Ajouté"; 
                $s = "a Supprimé"; 
                $m = "a Modifié";
                $r = "a Réstauré";
                $sall = "a Supprimé définitivement"; 
            @endphp

                @if ($activite->typeActivity == $a)
                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                <i class="bi bi-plus font-size-20"></i>
                </div>
                @elseif($activite->typeActivity == $s ||  $activite->typeActivity == $sall)
                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                    <i class="mdi mdi-stack-exchange font-size-20"></i>
                    </div>
                @elseif($activite->typeActivity == $m)
                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                    <i class="bi bi-pencil-square font-size-20"></i>
                    </div>
                @elseif($activite->typeActivity == $r)
                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                    <i class="bi bi-arrow-clockwise font-size-20"></i>
                    </div>
                @endif
           
            <div class="media-body pr-3 ">
              <a class="mt-0 mb-1 font-size-15 text-dark"
                href="#"><b>{{$activite->name}}</b> {{ $activite->typeActivity}}</a>
                <a class="mt-0 mb-1 font-size-15 text-dark"
                href="#">{{ $activite->description}}</a>
              
            </div>
            <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i>{{$activite->created_at}}</span>
        </div>
    @endforeach
    @endif        
    </div>
</div>
@endsection