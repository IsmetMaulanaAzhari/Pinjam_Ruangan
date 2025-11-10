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
<<<<<<< HEAD
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h5 class="modal-title text-white fw-bold" id="loginModalLabel">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Alert untuk error login dengan animasi -->
                <div id="loginAlert" class="alert alert-danger d-none alert-dismissible fade show" role="alert" style="animation: slideDown 0.3s ease;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-circle-fill fs-4 me-3"></i>
                        <div>
                            <strong>Login Gagal!</strong>
                            <p class="mb-0" id="loginAlertMessage"></p>
                        </div>
                    </div>
                </div>
                
                <form id="loginForm" action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="login_email" class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1"></i>Email
                        </label>
                        <input type="email" class="form-control form-control-lg" id="login_email" name="email" 
                               placeholder="example@untirta.ac.id" required>
                    </div>
                    <div class="mb-4">
                        <label for="login_password" class="form-label fw-semibold">
                            <i class="bi bi-lock me-1"></i>Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-lg" id="login_password" name="password" 
                                   placeholder="Masukkan password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg w-100 text-white fw-bold" id="loginButton" 
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                        <span id="loginButtonText">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </span>
                        <span id="loginSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
=======
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
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                </form>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</div>

<style>
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.shake {
    animation: shake 0.5s;
}

#loginAlert {
    border-radius: 10px;
    border-left: 4px solid #dc3545;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

#loginButton:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    transition: all 0.3s ease;
}

#loginButton:active {
    transform: translateY(0);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginAlert = document.getElementById('loginAlert');
    const loginAlertMessage = document.getElementById('loginAlertMessage');
    const loginButton = document.getElementById('loginButton');
    const loginButtonText = document.getElementById('loginButtonText');
    const loginSpinner = document.getElementById('loginSpinner');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('login_password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    // Toggle password visibility
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            if (type === 'password') {
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        });
    }
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Hide previous alert
            loginAlert.classList.add('d-none');
            loginAlert.classList.remove('shake');
            
            // Show loading state
            loginButton.disabled = true;
            loginButtonText.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';
            loginSpinner.classList.remove('d-none');
            
            const formData = new FormData(loginForm);
            
            fetch('/login', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || formData.get('_token')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Success - show success message briefly then redirect
                    loginButtonText.innerHTML = '<i class="bi bi-check-circle me-2"></i>Berhasil!';
                    loginButton.classList.add('btn-success');
                    loginSpinner.classList.add('d-none');
                    
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 500);
                } else {
                    // Show error message with shake animation
                    loginAlertMessage.textContent = data.message;
                    loginAlert.classList.remove('d-none');
                    loginAlert.classList.add('shake');
                    
                    // Reset button state
                    loginButton.disabled = false;
                    loginButtonText.innerHTML = '<i class="bi bi-box-arrow-in-right me-2"></i>Login';
                    loginSpinner.classList.add('d-none');
                    
                    // Add shake to form
                    loginForm.classList.add('shake');
                    setTimeout(() => {
                        loginForm.classList.remove('shake');
                    }, 500);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                loginAlertMessage.textContent = 'Terjadi kesalahan koneksi. Silakan coba lagi.';
                loginAlert.classList.remove('d-none');
                loginAlert.classList.add('shake');
                
                // Reset button state
                loginButton.disabled = false;
                loginButtonText.innerHTML = '<i class="bi bi-box-arrow-in-right me-2"></i>Login';
                loginSpinner.classList.add('d-none');
            });
        });
    }
    
    // Reset form when modal is closed
    const loginModal = document.getElementById('loginModal');
    if (loginModal) {
        loginModal.addEventListener('hidden.bs.modal', function () {
            loginForm.reset();
            loginAlert.classList.add('d-none');
            loginAlert.classList.remove('shake');
            loginButton.disabled = false;
            loginButton.classList.remove('btn-success');
            loginButtonText.innerHTML = '<i class="bi bi-box-arrow-in-right me-2"></i>Login';
            loginSpinner.classList.add('d-none');
            passwordInput.setAttribute('type', 'password');
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        });
    }
});
</script>
=======
</div>
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
