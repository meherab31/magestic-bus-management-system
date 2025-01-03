<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <!-- Logo and Brand -->
        <a class="navbar-brand d-flex align-items-center" href="index.html">
            <img src="{{ asset('logo.jpg') }}" alt="Logo" class="brand-logo">
            <span class="brand-text ms-2 text-success">Majestic Bus Service</span>
        </a>
        <!-- Toggle Button for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="mdi mdi-menu"></span>
        </button>
        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Search Bar -->
            <form class="d-flex me-auto">
                <div class="input-group">
                    <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                    <input type="text" class="form-control" placeholder="Search now" aria-label="search">
                </div>
            </form>
            <!-- User Profile Dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle" width="30" height="30">
                        @endif
                        <span class="ms-2">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('Profile') }}</a></li>
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <li><a class="dropdown-item" href="{{ route('api-tokens.index') }}">{{ __('API Tokens') }}</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>






<style>
.navbar {
    padding: 0.5rem 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.brand-logo {
    max-width: 50px;
    height: auto;
}

.brand-text {
    font-size: 1.25rem;
    font-weight: 600;
    white-space: nowrap;
}

.navbar .input-group {
    max-width: 500px;
}

.navbar-toggler {
    border: none;
}

.navbar-toggler .mdi-menu {
    font-size: 1.5rem;
}

.navbar-nav .dropdown-menu {
    min-width: 200px;
}

@media (max-width: 768px) {
    .navbar .input-group {
        max-width: 100%;
        margin-bottom: 0.5rem;
    }

    .navbar .brand-text {
        display: none;
    }
}
</style>
