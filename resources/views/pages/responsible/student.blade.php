@extends('layouts.layout')
@section('title')
   liste des Etudiants
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css"> 
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
  @elseif(session()->has('updateGrade'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
      {{session()->get('updateGrade')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <!-- end errour du validation -->
<div class="breadcrumb-wrapper breadcrumb-contacts">
<div>
<h1>Etudiant List</h1>
<p class="breadcrumbs"><span><a href="index.html">Home</a></span>
<span><i class="mdi mdi-chevron-right"></i></span>Etudiant
</p>
</div>
<div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal"
data-bs-target="#addUser"> Add Etudiant
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
                    <th>Prenom</th>
                    <th>Sexe</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Inscrie</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{$student->matricule}}</td>
                        <td>{{$student->nom_fr}}</td>
                        <td>{{$student->prenom_fr}}</td>
                        <td>{{$student->sexe}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->numTel}}</td>
                        <td>{{$student->CREATED_AT}}</td>                        
                        <td>
                            <div class="btn-group">
                                <a href="{{url("/student/".$student->matricule)}}">
                                    <button type="button" name="show" class="btn btn-outline-info" value="{{$student->matricule}}">
                                        <i class="bi bi-person-fill"></i>
                                    </button>
                                </a>
                                <a href="{{url('/student/delete/'.$student->matricule)}}">
                                    <button type="button" class="btn btn-outline-danger" name="delete" value="{{$student->matricule}}" onclick="return confirm('Vous êtes sûr?');">
                                            <i class="bi bi-trash-fill"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
    </table>
</div>
</div>
</div>
</div>
<!-- Ajouter un student -->
@include('pages.responsible.add_student')
@endsection