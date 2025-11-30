<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="d-flex flex-column align-items-center text-center mb-5">
            <img src="{{ asset('assets/images/LOGO_ORIGINAL.png') }}" style="width: 60px; height: 60px; margin-bottom: 10px;" alt="Logo">
            <div style="font-weight: 700; font-size: 18px; color: #000; line-height: 1.3;">
                Dashboard<br>Admin
            </div>
        </div>

        <button id="toggle-navbar" onclick="toggleNavbar()">
            <img src="/assets/navbar-times.svg" alt="">
        </button>
    </div>

    @if (auth()->user()->role_id == 1)
        <a href="/dashboard/admin" class="sidebar-item {{ Request::is('dashboard/admin') ? 'active' : '' }}">
            <span>Daftar Admin</span>
        </a>

        <a href="/dashboard/users" class="sidebar-item {{ Request::is('dashboard/users') ? 'active' : '' }}">
            <span>Daftar Mahasiswa</span>
        </a>

        <a href="/dashboard/rooms" class="sidebar-item {{ Request::is('dashboard/rooms') ? 'active' : '' }}">
            <span>Daftar Ruangan</span>
        </a>

        <a href="/dashboard/temporaryRents"
            class="sidebar-item {{ Request::is('dashboard/temporaryRents') ? 'active' : '' }}">
            <span>Daftar Peminjaman Sementara</span>
        </a>

        <a href="/dashboard/rents" class="sidebar-item {{ Request::is('dashboard/rents') ? 'active' : '' }}">
            <span>Daftar Peminjaman</span>
        </a>
    @endif

    <div class="sidebar-footer" style="position: absolute; bottom: 20px; left: 0; right: 0; padding: 0 15px;">
        <div class="user-info" style="background: #f8f9fa; padding: 12px; border-radius: 8px; margin-bottom: 10px;">
            <div style="font-size: 12px; color: #6c757d; margin-bottom: 4px;">Logged in as</div>
            <div style="font-weight: 600; color: #2d3748; font-size: 14px;">{{ auth()->user()->name }}</div>
            <div style="font-size: 12px; color: #6c757d;">{{ auth()->user()->email }}</div>
        </div>
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-danger w-100" style="border-radius: 8px; font-weight: 500; padding: 10px;">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>
        </form>
    </div>

</aside>
