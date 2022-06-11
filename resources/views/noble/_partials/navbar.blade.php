<nav class="navbar">
	<a href="#" class="sidebar-toggler">
		<i data-feather="menu"></i>
	</a>
	<div class="navbar-content">
		{{-- <form class="search-form">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<i data-feather="search"></i>
					</div>
				</div>
				<input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
			</div>
		</form> --}}
		<ul class="navbar-nav">
			<li class="nav-item dropdown nav-profile">
				<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{-- <img src="{{ asset('assets/backend/noble-ui/images/person-icon.png') }}" alt="profile"> --}}
					<img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&&name={{ session('authUserData')->user->name }}" alt="profile">
				</a>
				<div class="dropdown-menu" aria-labelledby="profileDropdown">
					<div class="dropdown-header d-flex flex-column align-items-center">
						<div class="figure mb-3">
							{{-- <img src="{{ asset('assets/backend/noble-ui/images/person-icon.png') }}" alt=""> --}}
							<img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&&name={{ session('authUserData')->user->name }}" alt="">
						</div>
						<div class="info text-center">
							<p class="name font-weight-bold mb-0">User</p>
							{{-- <p class="email text-muted mb-3">amiahburton@gmail.com</p> --}}
						</div>
					</div>
					<div class="dropdown-body">
						<ul class="profile-nav p-0 pt-3">
							<li class="nav-item">
								<a href="{{ str_replace('logout', 'profile', session('authUserData')->ssoLogoutLink) }}" class="nav-link">
									<i data-feather="edit"></i>
									<span>Edit Profile</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModal">
									<i data-feather="settings"></i>
									<span>Ubah Role</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ session('authUserData')->ssoLogoutLink }}" class="nav-link" onclick="document.getElementById('form-logout').submit()">
									{{-- <form id="form-logout" action="{{ route('logout', 1) }}" method="GET">
										@csrf
									</form> --}}
									<i data-feather="log-out"></i>
									<span>Log Out</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</li>
		</ul>
	</div>
</nav>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<select class="form-control" name="" id="change_role">
					{{-- <option value="0" {{ (session('defaultRole')->id == 0) ? 'selected' : '' }}>All</option> --}}
					@foreach (session('authUserData')->roles as $value)
					<option value="{{ $value->id }}" {{ (session('defaultRole')->id == $value->id) ? 'selected' : '' }}>{{ $value->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button id="btn_change_role" type="button" class="btn btn-primary">Ubah</button>
			</div>
		</div>
	</div>
</div>