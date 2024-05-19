	<!-- Start Header/Navigation -->
	<nav class="navbar navbar-expand-md navbar-dark" id="mainNav">
		<div class="container">
			<a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('img/logo-white.svg')}}" alt="..." /></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('about_us')}}">About Us</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('trips.index')}}">Trips</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('reviews.index')}}">User Reviews</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('reviews.create')}}">Leave Review</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('contact_us')}}">Contact Us</a></li>
				</ul>
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					@auth
						@role('user')
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
									<i class="far fa-user"></i>
								</a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="{{route('profile.edit')}}">{{Auth::user()->name}}</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{route('bookings.index')}}">Bookings History</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{route('logout')}}">Logout</a>
								</div>
							</li>
						@endrole
					@else
						<li class="nav-item">
							<a class="nav-link btn btn-outline-secondary" href="{{route('login')}}">Login</a>
						</li>
					@endauth
				</ul>
			</div>
		</div>
	</nav>
	<!-- End Header/Navigation -->
{{-- 
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
		<div class="container">
			<a class="navbar-brand" href="#page-top">Travel Ease</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars ms-1"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
					<li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
					<li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
					<li class="nav-item"><a class="nav-link" href="#about">About</a></li>
					<li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
					<li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav> --}}