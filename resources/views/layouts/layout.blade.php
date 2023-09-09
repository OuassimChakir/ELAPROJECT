<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="@yield('title') - ELA CENTER">

    <title>@yield('title') - ELA CENTER</title>
    <!-- FAVICON -->
    <link href="favicon.ico" rel="shortcut icon" />
    <!-- Scripts -->
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>

    <!-- Styles -->
    @include('assets.styles')
</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

    <!--  WRAPPER  -->
    <div class="wrapper">
        <form id="logoutForm" action="{{ route('logout') }}" method="post">@csrf</form>

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

    <!-- JS -->
    <script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-zoom/jquery.zoom.min.js') }}"></script>
    <!-- Chart -->
    <script src="{{ asset('assets/plugins/charts/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>



    <!-- Date Range Picker -->
    <script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/date-range.js') }}"></script>

    <!-- Option Switcher -->
    <script src="{{ asset('assets/plugins/options-sidebar/optionswitcher.js') }}"></script>

    <!-- Ekka Custom -->
    <script src="{{ asset('assets/js/ekka.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/simplebar.min.js') }}"></script>

    <!-- Data Tables -->
    <script src='{{ asset('assets/plugins/data-tables/jquery.datatables.min.js') }}'></script>
    <script src='{{ asset('assets/plugins/data-tables/datatables.bootstrap5.min.js') }}'></script>
    <script src='{{ asset('assets/plugins/data-tables/datatables.responsive.min.js') }}'></script>
    

<!--------------------------------
!! Message d'alert
---------------------------------->

    @if (session()->has('successMessage'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: "{{ session()->get('successMessage') }}"
            })
        </script>
    @elseif(session()->has('deleteMessage'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'error',
                title: "{{ session()->get('deleteMessage') }}"
            })
        </script>
    @elseif(session()->has('updateMessage'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'warning',
                title: "{{ session()->get('updateMessage') }}"
            })
        </script>
    @elseif(session()->has('accessDenied'))
        <script>
            Swal.fire(
                'Accès Interdit !',
                "{{ session()->get('accessDenied') }}",
                'error'
            )
        </script>
    @endif


    <script>
        document.getElementById("logoutHeader").addEventListener("click", function() {
            document.getElementById('logoutForm').submit();
        });
        document.getElementById("logoutSidebar").addEventListener("click", function() {
            document.getElementById('logoutForm').submit();
        });
    </script>

</body>

</html>
