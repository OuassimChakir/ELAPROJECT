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
                @if($staf->idStaffType == 2)
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
                            <form action="{{url('/staff/add/action')}}" method="delete">
                               
                                @method('delete')
                                <div class="btn-group">
                                    <button type="submit" name="edit" class="btn btn-outline-warning"
                                     value="{{$staf->idStaff}}" onclick="return confirm('Vous êtes sûr?');">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="submit" class="btn btn-outline-danger" name="delete" 
                                    value="{{$staf->idStaff}}" onclick="return confirm('Vous êtes sûr?');">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endif
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