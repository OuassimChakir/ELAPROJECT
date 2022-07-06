@extends('layouts.layout')
@section('title')
    Niveaux Scolaires
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
<h1>staff List</h1>
<p class="breadcrumbs"><span><a href="index.html">Home</a></span>
<span><i class="mdi mdi-chevron-right"></i></span>Staff
</p>
</div>
<div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal"
data-bs-target="#addUser"> Add Staff
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
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Etat</th>
                    <th>Inscrie</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($Staff as $staf)
                    <tr>
                        <td>{{$staf->nom}}</td>
                        <td>{{$staf->prenom}}</td>
                        <td>{{$staf->email}}</td>
                        <td>{{$staf->numTel}}</td>
                        <td>
                            @if ($staf->idStaffType == 1)
                             <span class="badge bg-success">Professeur</span>
                            @else
                             <span class="badge bg-danger">responsable</span>
                            @endif
                        </td>
                        <td>{{$staf->dateEngagement}}</td>
                        <td>
                                        <div class="btn-group">                                                         
                                            <button type="button"
                                                class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" data-display="static">
                                                <span class="sr-only">Info</span>
                                            </button>
                                
                                            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('/staff/edit' , $staf->idStaff) }}">Edit</a>
                      <form id="{{$staf->idStaff}}" method="POST"
                         action="{{ url('/staff/delete',$staf->idStaff)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                <button
                                                onclick="event.preventDefault(); if (confirm('etre vous sur ?')) 
                                                document.getElementById({{$staf->idStaff}}).submit();"

                                                 type="submit" class="dropdown-item" >DELETE</button> 
                                            </form>
                                            </div>
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
</div>
<!-- Ajouter un staff -->
@include('pages.responsible.add_staff')
@endsection