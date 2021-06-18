<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Sweetalert 2 -->
    <link rel="stylesheet" href="{{ asset('css/sweetalert.min.css') }}">
    <!-- Pace -->
    <link rel="stylesheet" href="{{ asset('css/pace.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('style')
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed pace-primary">
    <div class="wrapper">
        <!-- Modal -->
        @yield('modal')
        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')
        <!-- Content Wrapper -->
        @yield('content')
		<a id="back-to-top" href="javascript:void(0)" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top" >
			<i class="fas fa-chevron-up"></i>
		</a>
        <!-- Main Footer -->
        @include('layouts.footer')
    </div>
    
<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap 4.6 -->
<script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
<!-- Pace -->
<script src="{{ asset('js/pace.min.js')}}"></script>
<!-- Sweetalert 2 -->
<script src="{{ asset('js/sweetalert.min.js')}}"></script>
<!-- Adminlte Script -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<!-- Custom Script -->
<script src="{{ asset('js/script.js') }}"></script>
@yield('script')
<!-- Alert -->
@php ($alert = ['success', 'info', 'error', 'warning', 'question'])
@foreach ($alert as $type)
@if(session()->has($type))
<script>
	$(function() {
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 4000
		});
		
		Toast.fire({
			icon: '{{ $type }}',
			title: '{{ session($type) }}'
		});
	});
</script>
@endif
@endforeach
</body>
</html>
