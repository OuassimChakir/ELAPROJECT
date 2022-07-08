@extends('layouts.layout')
@section('title')
    Matières
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
    <h1>Matières</h1>
    <p class="breadcrumbs"><span><a href="{{route('acceuil')}}">Acceuil</a></span>
        <span><i class="mdi mdi-chevron-right"></i></span>Matières</p>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            <div class="card-body">
                <div class="ec-cat-form">
                    <h4>Ajouter une Matières</h4>

                    <form>

                        <div class="form-group row">
                            <label for="text" class="col-12 col-form-label">Libelle</label> 
                            <div class="col-12">
                                <input id="libelle" name="libelle" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="parent-category" class="col-12 col-form-label">Type de Formation</label> 
                            <div class="col-12">
                                <select id="courseType" name="courseType" class="custom-select" required>
                                    <option selected disabled>-- Choisir le Type de Formation du Matière --</option>
                                    @foreach ($courses as $course)
                                        <option value="{{$course->idCourseType}}">{{$course->course}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="responsive-data-table" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Matière</th>
                                <th>Type de Formation du Matiere</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($subjects))
                                @php
                                $i=1;
                                @endphp
                                @foreach ($subjects as $subject)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$subjects->liballe}}</td>
                                        <td>{{$subjects->course}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{url('/matieres/type/update/'.$subjects->idCourseType)}}">
                                                    <button type="submit" name="edit" class="btn btn-outline-warning" value="{{$subjects->idCourseType}}">
                                                        <i class="bi bi-pencil-square"></i>
                                                        
                                                    </button>
                                                </a>
                                                <a href="{{url('/matieres/type/delete/'.$course->idCourseType)}}">
                                                    <button type="submit" class="btn btn-outline-danger" name="delete" value="{{$course->idCourseType}}" onclick="return confirm('Vous êtes sûr?');">
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
    
@endsection