@extends('layouts.layout')
@section('title')
    liste des Roles
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
    
			<!-- CORT WRAPPER -->
			<div class="ec-content-wrapper">
				<div class="content">
                    <div class="row">
                        <div class="breadcrumb-wrapper breadcrumb-contacts">
                            <h1>Liste des Roles</h1>
                            <p class="breadcrumbs"><span><a href="{{route('acceuil')}}">Acceuil</a></span>
                                <span><i class="mdi mdi-chevron-right"></i></span>Roles
                            </p>
                        </div>
                    <div>
					<div class="row">
						<div class="col-xl-4 col-lg-12">
							<div class="ec-cat-list card card-default mb-24px">
								<div class="card-body">
									<div class="ec-cat-form">
										<h4>Add New Category</h4>
                                        <form>

											<div class="form-group row">
												<label for="text" class="col-12 col-form-label">Role</label> 
												<div class="col-12">
													<input id="text" name="role" class="form-control here slug-title" type="text">
												</div>
											</div>

											<div class="form-group row">
												<label for="codeRole" class="col-12 col-form-label">Code Roles</label> 
												<div class="col-12">
													<input id="codeRole" name="codeRole" class="form-control" type="text">
													<small>01 : Administrateur - 02 : Comptable</small>
												</div>
											</div>

											<div class="form-group row">
												<label for="color" class="col-12 col-form-label">Couleur</label> 
												<div class="col-12">
													<input id="color" name="color" type="color">
												</div>
											</div>

											<div class="row">
												<div class="col-12">
													<button name="ajouterRoles" type="submit" class="btn btn-primary">Ajouter Roles</button>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-8 col-lg-12">
							<div class="ec-cat-list card card-default">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>#</th>
													<th>Role</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        <td>{{$role->codeRole}}</td>
                                                        <td>{{$role->role}}</td>
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
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- End Content -->
			</div> <!-- End Content Wrapper -->



@endsection