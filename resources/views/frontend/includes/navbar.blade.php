<nav class="navbar navbar-expand-lg py-lg-3 navbar-dark bg-primary">
    <div class="container">

        <!-- logo -->
        <a href="/" class="navbar-brand me-lg-5">
            <img src="assets/images/logo-blue.png" alt="" class="logo-dark" height="" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>

        <!-- menus -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <!-- left menu -->
            <ul class="navbar-nav me-auto align-items-center">
                <li class="nav-item mx-lg-1">
                    <a class="nav-link active" href="">Home</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a class="nav-link" href="">About Us</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a class="nav-link" href="">Contact Us</a>
                </li>
            </ul>

            <!-- right menu -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-0">
                    <a href="{{ route('login') }}" class="nav-link d-lg-none">Login</a>
                    <a href="{{ route('login') }}" class="btn btn-sm btn-light btn-rounded d-none d-lg-inline-flex">
                        <i class="mdi mdi-basket me-2"></i> Login
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>
