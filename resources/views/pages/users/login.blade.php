@extends('layouts.loginLayout')
@section('title')
    Se Connecter
@endsection
@section('content')
    <body id="body" class="sign-inup bg-primary" >
        <div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-10">
					<div class="card">
						<div class="card-header">
							<div class="ec-brand text-center">
									<img src="{{asset('images/Logo/logo.webp')}}" width="30%" alt="" />
							</div>
						</div>
						<div class="card-body p-5">
							<h4 class="text-dark mb-5">S'Authentifier</h4>
							
							<form action="/index.html">
								<div class="row">
									<div class="form-group col-md-12 mb-4">
										<input type="email" class="form-control" id="email" placeholder="Username">
									</div>
									
									<div class="form-group col-md-12 ">
										<input type="password" class="form-control" id="password" placeholder="Password">
									</div>
									
									<div class="col-md-12">
										<div class="d-flex my-2 justify-content-between">
											<div class="d-inline-block mr-3">
												<div class="control control-checkbox">Remember me
													<input type="checkbox" />
													<div class="control-indicator"></div>
												</div>
											</div>
											
											<p><a class="text-blue" href="#">Forgot Password?</a></p>
										</div>
										
										<button type="submit" class="btn btn-primary btn-block mb-4">Se Connecter</button>
										
										<p class="sign-upp">Don't have an account yet ?
											<a class="text-blue" href="sign-up.html">Sign Up</a>
										</p>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
@endsection