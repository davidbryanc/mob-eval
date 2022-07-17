<!-- ======= Header ======= -->
<header id="header" class="fixed-top header-inner-pages">
	<div class="container d-flex align-items-center justify-content-between">
		<!-- Uncomment below if you prefer to use an image logo -->
		<a href="{{route('index')}}" class="logo"><img src="{{asset('assets/img/logo.png')}}" alt="" class="img-fluid"></a>
		@auth
			<nav class="nav-menu d-none d-lg-block">
				<ul>
					<li><a class="font-weight-bold" href="{{route('index')}}">Home</a></li>
					<li><a class="font-weight-bold" href="{{route('students')}}">Students</a></li>
					<li><a class="font-weight-bold" href="{{route('enroll')}}">Enroll</a></li>
					<li><a class="font-weight-bold" href="{{route('setting')}}">Setting</a></li>
					<li><a href="javascript:void(0)" class="text-danger"><form action="{{route('logout')}}" method="post">@csrf <button style="all: unset" type="submit" onclick="if(!confirm('Are you sure want to logout?')){return false;}"><span class="iconify" data-icon="mdi:logout" data-inline="false"></span> Logout</button></form></a></li>
				</ul>
			</nav><!-- .nav-menu -->
		@endauth

	</div>
</header><!-- End Header -->