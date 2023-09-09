@extends('layouts.layout')
@section('title')
    Spécialités
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Spécialités</h1>
        <p class="breadcrumbs">
            <span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Spécialités
        </p>
    </div>
    <div>
        <button type="button" class="btn btn-primary" id="showFormButton">
            <i class="bi bi-plus-square"></i> Ajouter une Spécialité
        </button>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            
            @if (isset($updatedStaffType))
                <div class="card-body">
                    <div class="ec-cat-form">
                        <h4>Modifier une Spécialité</h4>
                        <form action="{{route('specialite.update.request',['idStaffType' => $updatedStaffType->idStaffType])}}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Designation</label> 
                                <div class="col-10">
                                    <input id="text" name="designation" class="form-control" type="text" value="{{$updatedStaffType->designation}}">
                                </div>
                            </div>
                            <div class="field_wrapper">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button name="updateStaffType" type="submit" class="btn btn-warning">Mettre à Jour</button>
                                    <a href="{{route('specialite')}}">
                                        <button type="button" class="btn btn-secondary">
                                            Annuler
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="card-body" id="formSection">
                    <div class="ec-cat-form">
                            <h4 id="sectionTitle">Ajouter une Spécialité</h4>
                            <form action="{{route('specialite.add')}}" method="post">
                                @csrf
                                @method('post')
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Designation</label> 
                                    <div class="col-10">
                                        <input id="text" name="designation" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="field_wrapper">
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button name="addStaffType" type="submit" class="btn btn-primary">Ajouter</button>
                                        <button name="Reset" type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@if (!isset($updatedStaffType))
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Designation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                            $i = 0;
                        @endphp
                        <tbody>
                            @if (isset($staffTypes))
                                @foreach ($staffTypes as $staffType)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td><div class="badge bg-dark">{{$staffType->designation}}</div></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('specialite.update',['idStaffType' => $staffType->idStaffType])}}">
                                                    <button type="button" name="edit" class="btn btn-outline-warning" value="">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </a>
                                                <a href="{{route('specialite.delete',['idStaffType' => $staffType->idStaffType])}}">
                                                    <button type="button" class="btn btn-outline-danger" name="delete" value="" onclick="return confirm('Vous êtes sûr?');">
                                                            <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif



<script src="{{asset('JS/jquery.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#showFormButton").click(function(){
            $("#formSection").slideToggle();
        });
    });
</script>
@endsection

