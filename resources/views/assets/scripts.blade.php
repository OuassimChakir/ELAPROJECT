{{-- Your Script --}}
@yield('script')

<!-- JS -->
<script src="{{asset('Bootstrap/js/bootstrap.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('JS/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/plugins/simplebar/simplebar.min.js')}}"></script>
	<script src="{{asset('assets/plugins/jquery-zoom/jquery.zoom.min.js')}}"></script>
<!-- Chart -->
<script src="{{asset('assets/plugins/charts/Chart.min.js')}}"></script>
<script src="{{asset('assets/js/chart.js')}}"></script>

{{-- SweetAlert --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Date Range Picker -->
<script src="{{asset('assets/plugins/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/js/date-range.js')}}"></script>

<!-- Option Switcher -->
<script src="{{asset('assets/plugins/options-sidebar/optionswitcher.js')}}"></script>

<!-- Ekka Custom -->
<script src="{{asset('assets/js/ekka.js')}}"></script>
<script src="{{asset('assets/plugins/simplebar/simplebar.min.js')}}"></script>

<!-- Data Tables -->
<script src='{{asset('assets/plugins/data-tables/jquery.datatables.min.js')}}'></script>
<script src='{{asset('assets/plugins/data-tables/datatables.bootstrap5.min.js')}}'></script>
<script src='{{asset('assets/plugins/data-tables/datatables.responsive.min.js')}}'></script>


{{-- SCRIPT --}}
<script>
    // SWEET ALERT
    $(document).ready(function(){
        $( "#deleteButton" ).bind( "click", function() {
            var idGroup = $(this).val();
            var url = $(this).data('url');
            var message = $(this).data('confirm');
            var title = $(this).data('title');
            var type = $(this).data('type');
            swal({
                title: title,
                text: message,
                icon: type,
                buttons: ["Non","Oui"],
                closeOnConfirm: true
            })
            .then((value) => {
                if(value == true)
                    return window.location.href = url;
            });
        });
    });
    
</script>