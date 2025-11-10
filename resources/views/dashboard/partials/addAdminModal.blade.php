<div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
<<<<<<< HEAD
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white; border-radius: 15px 15px 0 0; padding: 20px 30px; border: none;">
                <h5 class="modal-title fw-bold" id="formModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>Tambah Admin Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form action="/dashboard/admin" method="post" id="addAdminForm">
                    @csrf
                    <input type="hidden" name="role_id" value="1">
                    
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold" style="color: #2d3748; font-size: 14px;">
                            <i class="bi bi-person me-1"></i>Nama Lengkap
                        </label>
                        <input autocomplete="off" type="text"
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name"
                            placeholder="Masukkan nama lengkap"
                            value="{{ old('name') }}" 
                            style="border-radius: 8px; padding: 12px 15px; border: 1px solid #e2e8f0; font-size: 14px;"
                            required>
=======
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Tambah {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form action="/dashboard/admin" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap </label>
                        <input autocomplete="off" type="text"
                            class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name') }}" required>
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
<<<<<<< HEAD

                    <div class="mb-4">
                        <label for="nomor_induk" class="form-label fw-semibold" style="color: #2d3748; font-size: 14px;">
                            <i class="bi bi-card-text me-1"></i>Nomor Induk
                            <span class="text-danger fst-italic fw-light" style="font-size: 11px;">*Min 8 angka</span>
                        </label>
                        <input autocomplete="off" type="text"
                            class="form-control @error('nomor_induk') is-invalid @enderror" 
                            id="nomor_induk"
                            name="nomor_induk" 
                            placeholder="Contoh: 3337230014"
                            value="{{ old('nomor_induk') }}"
                            style="border-radius: 8px; padding: 12px 15px; border: 1px solid #e2e8f0; font-size: 14px;"
                            required>
=======
                    <div class="mb-3">
                        <label for="nomor_induk" class="form-label">Nomor Induk
                            <span class="text-danger fst-italic fw-lighter" style="font-size: 12px"> *Min 8 Angka</span>
                        </label>
                        <input autocomplete="off" type="number"
                            class="form-control @error('nomor_induk') is-invalid @enderror" id="nomor_induk"
                            name="nomor_induk" value="{{ old('nomor_induk') }}" required>
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                        @error('nomor_induk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
<<<<<<< HEAD

                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold" style="color: #2d3748; font-size: 14px;">
                            <i class="bi bi-envelope me-1"></i>Email
                        </label>
                        <input autocomplete="off" type="email"
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" name="email"
                            placeholder="contoh@email.com"
                            value="{{ old('email') }}"
                            style="border-radius: 8px; padding: 12px 15px; border: 1px solid #e2e8f0; font-size: 14px;"
                            required>
=======
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input autocomplete="off" type="email"
                            class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                            value="{{ old('email') }}" required>
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
<<<<<<< HEAD

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold" style="color: #2d3748; font-size: 14px;">
                            <i class="bi bi-lock me-1"></i>Password
                            <span class="text-danger fst-italic fw-light" style="font-size: 11px;">*Min 4 karakter</span>
                        </label>
                        <input autocomplete="off" type="password"
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" name="password"
                            placeholder="Masukkan password"
                            value="{{ old('password') }}"
                            style="border-radius: 8px; padding: 12px 15px; border: 1px solid #e2e8f0; font-size: 14px;"
                            required>
=======
                    <div class="mb-3">
                        <label for="password" class="form-label">Password
                            <span class="text-danger fst-italic fw-lighter" style="font-size: 12px">
                                *Min 4 Karakter</span>
                        </label>
                        <input autocomplete="off" type="password"
                            class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                            value="{{ old('password') }}" required>
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
<<<<<<< HEAD

                    <div class="modal-footer" style="border: none; padding: 0; padding-top: 20px;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" 
                            style="border-radius: 8px; padding: 10px 24px; font-weight: 500;">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary"
                            style="border-radius: 8px; padding: 10px 24px; font-weight: 500; background: #007bff; border: none;">
                            <i class="bi bi-check-circle me-1"></i>Tambah Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-content .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
    }

    .modal-content .btn-primary:hover {
        background: #0056b3 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    .modal-content .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-1px);
    }
</style>
=======
                    <input type="hidden" name="role_id" id="role_id" value="{{ 2 }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
