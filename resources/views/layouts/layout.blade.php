<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="@yield('title') - ELA CENTER">

	<title>@yield('title') - ELA CENTER</title>
	<!-- FAVICON -->
	<link href="favicon.ico" rel="shortcut icon"/>
    <!-- Scripts -->
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>
    <!-- Styles -->
    @include('assets.styles')

</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

	<!--  WRAPPER  -->
	<div class="wrapper">
		<form id="logoutForm" action="{{route('logout')}}" method="post">@csrf</form>
		
		{{-- LEFT MAIN SIDEBAR --}}
		@include('partials.sidebar')

		<!--  PAGE WRAPPER -->
		<div class="ec-page-wrapper">

			<!-- Header -->
			@include('partials.header')

			<!-- CONTENT WRAPPER -->
			<div class="ec-content-wrapper">
				<div class="content">
					@yield('content')
				</div> <!-- End Content -->
			</div> 
			<!-- End Content Wrapper -->

			<!-- Footer -->
			@include('partials.footer')

		</div> <!-- End Page Wrapper -->

	</div>
  <!-- End Wrapper -->

  @include('assets.scripts')
			
  <script>
	document.getElementById("logoutHeader").addEventListener("click", function () {
		document.getElementById('logoutForm').submit();
	});
	document.getElementById("logoutSidebar").addEventListener("click", function () {
		document.getElementById('logoutForm').submit();
	});
</script>
</body>

</html>
