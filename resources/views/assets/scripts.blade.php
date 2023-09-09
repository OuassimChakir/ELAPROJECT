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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
		title: "{{session()->get('successMessage')}}"
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
		title: "{{session()->get('deleteMessage')}}"
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
			title: "{{session()->get('updateMessage')}}"
		})
	</script>
@elseif(session()->has('accessDenied'))
<script>
	Swal.fire(
		'Accès Interdit !',
		"{{session()->get('accessDenied')}}",
		'error'
	)
</script>
@endif