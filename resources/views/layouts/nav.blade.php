 <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm py-3">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">
					{{ config('app.name', 'Laravel') }}
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item mx-2">
						  <a href="{{ route('posts.index') }}" class="nav-link">Posts</a>
						</li>
						<form action="{{ route('posts.search')}}" method="GET" class="form-inline my-2 my-lg-0">
							<input name="keyword" class="form-control rounded-0" type="search" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-light my-2 my-sm-0 rounded-0" type="submit">Search</button>
						</form>
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">

						<!-- Authentication Links -->
						@guest
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
							</li>
							@if (Route::has('register'))
								<li class="nav-item">
									<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
								</li>
							@endif
						@else
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }}
								</a>

								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a href="{{ route('posts.create')}}" class="dropdown-item">New post</a>
									@if (Auth::user()->email_verified_at)
										<a href="{{route('account.index')}}" class="dropdown-item">
											Change Password
										</a>
									@endif
									<a class="dropdown-item" href="{{ route('logout') }}"
									   onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
									</form>

								</div>
							</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>
