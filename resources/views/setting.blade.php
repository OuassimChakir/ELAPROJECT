@extends('layouts.layout')
@section('title')
   Paramètre
@endsection
@section('content')
<div class="ec-content-wrapper">
<div class="content">
<div class="breadcrumb-wrapper breadcrumb-contacts">
    <div>
        <h1>Paramètre</h1>
        <p class="breadcrumbs">
            <span><a href="{{route('acceuil')}}">Acceuil</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Paramètre
        </p>
    </div>
    <div>
       <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addNewYear"><i class="bi bi-arrow-clockwise"></i> Nouvel Année</button>
    </div>
</div>
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

					<div class="row">
						<div class="col-12">
							<div class="card card-default">  
                                <form enctype="multipart/form-data" method="put" >
								<div class="card-body">
                                  
									<div class="row ec-vendor-uploads">
										<div class="col-lg-4">
											<div class="ec-vendor-img-upload">
												<div class="ec-vendor-main-img">
													<div class="avatar-upload">
                                                        <!--ICOUN-->
														<div class="avatar-edit">
															<input type='file' id="imageUpload" class="ec-image-upload"
																accept=".png, .jpg, .jpeg" />
															<label for="imageUpload"><img
																	src="assets/img/icons/edit.svg"
																	class="svg_img header_svg" alt="edit" /></label>
														</div>
                                                        <!--IMAGES-LOGO-->
														<div class="avatar-preview ec-preview">
															<div class="imagePreview ec-div-preview">
																<img class="ec-image-preview"
																	src="{{asset('images/Logo/logo.webp')}}"
																	alt="edit" />
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="ec-vendor-upload-detail">
												
                                                    <!--TITLE-->
													<div class="col">
														<label for="inputEmail4" class="form-label">Titre de Logo</label>
														<input type="title" class="form-control slug-title" id="inputEmail4">
													</div><br>
                                                    
                                                    <!--AJOUTE-->
													<div class="col-md-12">
														<button type="submit" name="addlogo" class="btn btn-primary">Modifier</button>
                                                        
													</div>
												
											</div>
										</div>
									</div>
                                    
								</div>
                                </form>
							</div>
						</div>
					</div>
				</div> <!-- End Content -->
			</div> <!-- End Content Wrapper -->

    <script src="{{asset('assets/plugins/charts/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/chart.js')}}"></script>

@endsection