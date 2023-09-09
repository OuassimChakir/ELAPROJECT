@extends('layouts.layout')
@section('title')
    Types de Formation
@endsection
@section('content')
<div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
    <h1>Types de Formation</h1>
    <p class="breadcrumbs"><span><a href="{{route('acceuil')}}">Acceuil</a></span>
        <span><i class="mdi mdi-chevron-right"></i></span>Types de Formation</p>
</div>


<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            <div class="card-body">
                <div class="ec-cat-form">

                    @if (isset($courseInfo))
                        <h4>Modifier Le Type de Formation</h4>

                        <form action="{{route('courses.update.query',['idCourseType' => $courseInfo->idCourseType])}}" method="put">
                            @method('put')
                            @csrf
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Type de Formation</label> 
                                <div class="col-12">
                                    <input id="text" name="course" class="form-control here slug-title" type="text" value="{{$courseInfo->course}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-12 col-form-label">Abbréviation</label> 
                                <div class="col-12">
                                    <input id="slug" name="shortForm" class="form-control here set-slug" type="text" value="{{$courseInfo->shortForm}}">
                                    <small>L'abbreviation du type par exemple "C" pour "Communication"</small>
                                </div>
                            </div>
                            <input type="hidden" value="{{$courseInfo->idCourseType}}" name="idCourseType">
                            <div class="row">
                                <div class="col-12">
                                    <button name="update" type="submit" class="btn btn-warning">Modifier</button>
                                    <button name="reset" type="reset" class="btn btn-secondary">Reset</button>
                                    <a href="{{route('courseType')}}">
                                        <button type="button" class="btn btn-secondary">
                                            Annuler
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </form>
                    @else
                        <h4>Ajouter un Type de Formation</h4>
                        <form action="{{route('courses.add')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Type de Formation</label> 
                                <div class="col-12">
                                    <input id="text" name="course" class="form-control here slug-title" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-12 col-form-label">Abbréviation</label> 
                                <div class="col-12">
                                    <input id="slug" name="shortForm" class="form-control here set-slug" type="text">
                                    <small>L'abbreviation du type par exemple "C" pour "Communication"</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button name="ajouter" type="submit" class="btn btn-primary">Ajouter</button>
                                    <button name="reset" type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>

                        </form>
                    @endif

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
                                <th>Formation</th>
                                <th>Abbréviation</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i=1;
                             @endphp
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$course->course}}</td>
                                    <td>{{$course->shortForm}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('courses.update',['idCourseType' => $course->idCourseType])}}">
                                                <button name="edit" class="btn btn-outline-warning" value="{{$course->idCourseType}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                    
                                                </button>
                                             </a>
                                            <a href="{{route('courses.delete',['idCourseType' => $course->idCourseType])}}">
                                                <button class="btn btn-outline-danger" name="delete" value="{{$course->idCourseType}}" onclick="return confirm('Vous êtes sûr?');">
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
</div>
    
@endsection
