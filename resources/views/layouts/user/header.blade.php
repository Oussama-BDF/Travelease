	<!-- Start Header/Navigation -->
	<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="{{route('home')}}">Travel Ease<span>.</span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<li class="nav-item">
						<a class="nav-link" href="{{route('home')}}">Home</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="{{route('trips.index')}}">Trips</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('review.index')}}">User Reviews</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('review.create')}}">Leave Review</a></li>
				</ul>
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					@auth
						@role('user')
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
									<img src="{{asset('img/user.svg')}}" />
								</a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="{{route('profile.edit')}}">{{Auth::user()->name}}</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{route('logout')}}">Logout</a>
								</div>
							</li>
						@endrole
					@else
						<li class="nav-item">
							<a class="nav-link btn btn-secondary" href="{{route('login')}}">Login</a>
						</li>
					@endauth
				</ul>
			</div>
		</div>
	</nav>
	<!-- End Header/Navigation -->