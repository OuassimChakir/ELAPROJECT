@extends('layouts.layout')
@section('title')
    liste des Utilisateurs
@endsection
@section('content')
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
<h1>Liste des Utilisateurs</h1>
<p class="breadcrumbs"><span><a href="{{route('acceuil')}}">Acceuil</a></span>
<span><i class="mdi mdi-chevron-right"></i></span>Utilisateurs
</p>
</div>
<div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal"
data-bs-target="#addUser"><i class="bi bi-plus-square"></i> Créer un Compte
</button>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="ec-vendor-list card card-default">
<div class="card-body">
    <form action="#" method="post">
        @method('delete')
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Créé à</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if (!is_null($user->color))
                            <div class="badge" style="color: white;background-color: {{$user->color}}">{{$user->role}}</div>
                        @else
                            <div class="badge bg-dark">{{$user->role}}</div>
                        @endif
                    </td>
                    <td><i class="bi bi-clock"></i> {{$user->created_at}}</td>
                    <td>                           
                            <div class="btn-group">
                                <a href="#">
                                    <button type="button" name="edit" class="btn btn-outline-info" value="{{$user->id}}">
                                        <i class="bi bi-person-fill"></i>
                                    </button>
                                </a>
                                <a href="#">
                                    <button type="button" class="btn btn-outline-danger" name="delete" onclick="return confirm('Vous êtes sûr?');">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </a>
                            </div>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </form>     
</div>
</div>
</div>
</div>
<!-- Ajouter un staff -->
@include('pages.users.addUser')
<script src="{{asset('JS/jquery.min.js')}}"></script>

@endsection