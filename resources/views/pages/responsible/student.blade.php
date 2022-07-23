@extends('layouts.layout')
@section('title')
   liste des Etudiants
@endsection
@section('content')
  <!--message success -->
  @if(session()->has('success'))
  <div class="alert alert-success">
      {{session()->get('success')}}
  </div>
@endif
  <!--errour du validation -->
                @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
    <div class="table-responsive">
        <table id="responsive-data-table" class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Sexe</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Inscrie</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($student as $studen)
                    <tr>
                        <td>{{$studen->nomfr}}</td>
                        <td>{{$studen->prenomfr}}</td>
                        <td>{{$studen->sexe}}</td>
                        <td>{{$studen->email}}</td>
                        <td>{{$studen->numTel}}</td>
                        <td>{{$studen->adresse}}</td>
                        <td>{{$studen->CREATED_AT}}</td>                        
                        <td>
                            <form action="{{url('/student/add/action')}}" method="delete">
                               
                                @method('delete')
                                <div class="btn-group">
                                    <button type="submit" name="edit" class="btn btn-outline-warning"
                                     value="{{$studen->matricule}}" onclick="return confirm('Vous êtes sûr?');">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="submit" class="btn btn-outline-danger" name="delete" 
                                    value="{{$studen->matricule}}" onclick="return confirm('Vous êtes sûr?');">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>

</div>
</div>
</div>
</div>
<!-- Ajouter un student -->
@include('pages.responsible.add_student')
@endsection