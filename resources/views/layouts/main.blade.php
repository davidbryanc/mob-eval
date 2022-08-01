<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>MOB UBAYA 2021 - @yield('title_bar')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/logo_square.png')}}" rel="icon">
  <link href="{{asset('assets/img/logo_square.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  {{-- <link rel="stylesheet" href="cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css"> --}}

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Resi - v2.2.1
  * Template URL: https://bootstrapmade.com/resi-free-bootstrap-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</head>

<body>
	@include('layouts.header')
	
	<main id="main">

		<!-- ======= Breadcrumbs ======= -->
		<section class="breadcrumbs">
			<div class="container">
				<div class="d-flex justify-content-between align-items-center">
					<h2>@yield('title_header')</h2>
					<hr>
					<span>{{date('l, j F Y')}}</span>
				</div>
			</div>
		</section><!-- End Breadcrumbs -->

		<section class="inner-page">
			<div class="container">
				@yield('content')
			</div>
		</section>

	</main><!-- End #main -->

	@yield('modal')

	@include('layouts.footer')
	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

	<!-- Vendor JS Files -->
	<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
	<script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
	<script src="{{asset('assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('assets/vendor/counterup/counterup.min.js')}}"></script>
	<script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
	<script src="{{asset('assets/vendor/venobox/venobox.min.js')}}"></script>
	<script src="{{asset('assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>

	<!-- Template Main JS File -->
	<script src="{{asset('assets/js/main.js')}}"></script>
	@yield('script')
</body>

</html>