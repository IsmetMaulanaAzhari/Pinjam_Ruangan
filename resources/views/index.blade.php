@extends('layouts.main')

@section('container')
    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="home" class="hero-area bg_cover">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 offset-xl-7 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="hero-content">
                        <h2 class="mb-30 wow fadeInUp" data-wow-delay=".2s">Sistem Peminjaman Ruangan</h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Selamat datang di Website Peminjaman Ruangan Fakultas Teknik Universitas Sultan Ageng Tirtayasa.</p>
                        <d class="hero-btns">
                            <a href="#skill" class="main-btn wow fadeInUp" data-wow-delay=".6s">Panduan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-left" style="display: flex; align-items: center; justify-content: flex-start; height: 120vh;">
            <img src="assets/images/ft2.jpg" alt="" style="max-width: 100%; height: auto;">
        </div>
    </section>

    <section id="skill" class="skill-area pt-170">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7 col-md-10 mx-auto">
                <div class="section-title text-center">
                    <h2 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Panduan</h2>
                    <p class="wow fadeInUp" data-wow-delay=".4s">Tata Cara Penggunaan Sistem Peminjaman Ruangan<br> Universitas Sultan Ageng Tirtayasa</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="assets/gif/login.gif" alt="Login GIF" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="single-skill wow fadeInUp" data-wow-delay=".2s">
                    <div class="skill-content">
                        <h4>Login</h4>
                        <p>Silahkan login terlebih dahulu menggunakan akun UNTIRTA</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="assets/gif/cari.gif" alt="Isi Form GIF" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="single-skill wow fadeInUp" data-wow-delay=".4s">
                    <div class="skill-content">
                        <h4>Pilih Ruangan</h4>
                        <p>Silakan menuju ke menu Daftar Ruangan. Kemudian filter ruangan sesuai keperluan lalu klik ruangan yang ingin dipinjam</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="assets/gif/form.gif" alt="Isi Form GIF" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="single-skill wow fadeInUp" data-wow-delay=".4s">
                    <div class="skill-content">
                        <h4>Isi Form</h4>
                        <p>Silakan isi form peminjaman dengan alasan yang kuat agar diterima oleh admin</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="assets/gif/tunggu.gif" alt="Proses GIF" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="single-skill wow fadeInUp" data-wow-delay=".6s">
                    <div class="skill-content">
                        <h4>Tunggu</h4>
                        <p>Silahkan tunggu sampai permintaan peminjaman mu diterima oleh admin</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection