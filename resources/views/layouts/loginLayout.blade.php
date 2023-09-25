<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="@yield('title') - BMA School">

	<title>@yield('title') - BMA School</title>
	<!-- FAVICON -->
	<link href="favicon.ico" rel="shortcut icon" />


    @include('assets.styles')

</head>

    @yield('content')

    @include('assets.scripts')

</body>

</html>
