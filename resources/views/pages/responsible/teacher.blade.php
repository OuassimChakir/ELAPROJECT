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
<h1>User List</h1>
<p class="breadcrumbs"><span><a href="index.html">Home</a></span>
<span><i class="mdi mdi-chevron-right"></i></span>User
</p>
</div>
<div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal"
data-bs-target="#addUser"> Add User
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
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Total Achats</th>
                    <th>Etat</th>
                    <th>Inscrie</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($clients as $client)
                    <tr>

                        <td>{{$client->email}}</td>
                        <td>{{$client->numTel}}</td>
                        <td>0</td>
                        <td>
                            @if ($client->etatClient == 1)
                             <span class="badge bg-success">Active</span>
                            @else
                             <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>{{$client->created_at}}</td>
                        <td>
                                        <div class="btn-group">                                                         
                                            <button type="button"
                                                class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" data-display="static">
                                                <span class="sr-only">Info</span>
                                            </button>
                                
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url('/clients/edit' , $client->idClient) }}">Edit</a><form id="{{$client->idClient}}" method="POST" action="{{ url('/clients/delete',$client->idClient)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                <button
                                                onclick="event.preventDefault(); if (confirm('etre vous sur ?')) 
                                                document.getElementById({{$client->idClient}}).submit();"

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
    {{$teacher->links()}}
</div>
</div>
</div>
</div>
<!-- Ajouter un teacher -->
@include('responsible.ajouterTeacher')
@endsection