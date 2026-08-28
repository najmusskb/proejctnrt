<nav class="sb-topnav navbar navbar-expand-lg navbar-dark">
    <!-- Sidebar toggle (mobile) -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-2 me-lg-0" id="sidebarToggle" href="#!"
        aria-label="Toggle sidebar"><i class="fas fa-bars"></i></button>

    <!-- Navbar Brand -->
    <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">{{ Str::limit($content->com_name, 20) }}</a>

    <!-- Clock -->
    <p class="text-white dashboard-date mb-0 ms-3 d-none d-lg-block"><i class="far fa-clock"></i> {{ date('l, j F Y,') }} <span id="timer"></span></p>

    <!-- Profile dropdown -->
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                @if (isset(Auth::user()->image))
                    <img class="profile-img" src="{{ asset(Auth::user()->image) }}" alt="">
                @else
                    <img class="profile-img" src="{{ asset('images/profile.png') }}" alt="">
                @endif
                <span class="common-text">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-key"></i> Password Change</button></li>
                <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
