@extends('layouts.layout')
@section('title')
    Catégories des Niveaux
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
        <h1>Catégories des Niveaux</h1>
        <p class="breadcrumbs"><span><a href="{{ route('acceuil') }}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Catégories des Niveaux
        </p>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        @if (isset($updatedCategory))
                            {{-- Update Form --}}
                            <h4>Modifier une Categorie</h4>

                            <form
                                action="{{ route('gradesCategory.update.query', ['idGradeCategory' => $updatedCategory->idGradeCategory]) }}"
                                method="put">
                                @method('put')
                                @csrf
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Categorie</label>
                                    <div class="col-12">
                                        <input id="category" name="category" class="form-control" type="text"
                                            value="{{ $updatedCategory->category }}" required>
                                    </div>
                                </div>
                                <input type="hidden" name="idGradeCategory"
                                    value="{{ $updatedCategory->idGradeCategory }}">
                                <div class="row">
                                    <div class="col-12">
                                        <button name="update" type="submit" class="btn btn-warning">Modifier</button>
                                        <button name="reset" type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="{{ route('gradesCategory') }}">
                                            <button type="button" class="btn btn-secondary">
                                                Annuler
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        @else
                            {{-- Add Form --}}
                            <h4>Ajouter une Categorie de Niveau</h4>
                            <small>le type de niveaux par exemple, <b>Niveaux de communication</b> ou <b>Niveaux
                                    scolaires</b>..</small>

                            <form action="{{ route('gradesCategory.add') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Categorie</label>
                                    <div class="col-12">
                                        <input id="category" name="category" class="form-control" type="text"
                                            placeholder="Communication, Scolaire..." required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button name="addGrade" type="submit" class="btn btn-primary">Ajouter</button>
                                        <button name="Reset" type="reset" class="btn btn-secondary">Reset</button>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Categorie</th>
                                    <th>Description</th>
                                    <th>Type de formation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($gCategories))
                                    @foreach ($gCategories as $categorie)
                                        <tr>
                                            <td>{{ $categorie->idGradeCategory }}</td>
                                            <td>{{ $categorie->category }}</td>
                                            <td>{{ $categorie->description }}</td>
                                            <td>
                                                <div class="badge bg-dark">{{ $categorie->course }}</div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a
                                                        href="{{ route('gradesCategory.update',['idGradeCategory' => $categorie->idGradeCategory])}}">
                                                        <button type="submit" name="edit"
                                                            class="btn btn-outline-warning"
                                                            value="{{ $categorie->idGradeCategory }}">
                                                            <i class="bi bi-pencil-square"></i>

                                                        </button>
                                                    </a>
                                                    <a
                                                        href="{{ route('gradesCategory.delete',['idGradeCategory' => $categorie->idGradeCategory])}}">
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            name="delete" value="{{ $categorie->idGradeCategory }}"
                                                            onclick="return confirm('Vous êtes sûr?');">
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
