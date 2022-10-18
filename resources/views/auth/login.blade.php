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
							
							<form action="{{route('login')}}" method="POST">
								@csrf
								<div class="row">
									<div class="form-group col-md-12 mb-4">
										<input type="email" name="email" class="form-control" id="email" placeholder="Email">
									</div>
									
									<div class="form-group col-md-12 ">
										<input type="password" name="password" class="form-control" id="password" placeholder="Password">
									</div>
									
									<div class="col-md-12">
										<div class="d-flex my-2 justify-content-between">
											@if (Route::has('password.request'))
												<p><a class="text-blue" href="{{ route('password.request') }}">Mot de passe Oublié?</a></p>
											@endif
											
										</div>
										
										<button type="submit" class="btn btn-primary btn-block mb-4">
											{{ __('Log in') }}
										</button>
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