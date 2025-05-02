<!--====== HEADER PART START ======-->
<header class="header_area">
    <div id="header_navbar" class="header_navbar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand">
                            <img id="logo" src="{{ asset('assets/images/LOGO_ORIGINAL.png') }}" alt="Logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a href="/" class="text-warning">Home</a>
                                </li>
                                @auth
                                    <li class="nav-item">
                                        <a href="/daftarruang" class="text-warning">Daftar Ruang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/daftarpinjam" class="text-warning">Daftar Peminjaman</a>
                                    </li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="btn border border-warning rounded-pill text-warning "><i
                                                class="bi bi-box-arrow-right"></i>
                                            Logout</button>
                                    </form>
                                @else
                                    <li class="nav-item">
                                        <a href="#" class="header-btn btn-hover" data-bs-toggle="modal"
                                            data-bs-target="#loginModal">Login</a>
                                    </li>
                                @endauth
                            </ul>
                        </div> <!-- navbar collapse -->
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header navbar -->
</header>
<!--====== HEADER PART ENDS ======-->

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>