<div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
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
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nomor_induk" class="form-label">Nomor Induk
                            <span class="text-danger fst-italic fw-lighter" style="font-size: 12px"> *Min 8 Angka</span>
                        </label>
                        <input autocomplete="off" type="number"
                            class="form-control @error('nomor_induk') is-invalid @enderror" id="nomor_induk"
                            name="nomor_induk" value="{{ old('nomor_induk') }}" required>
                        @error('nomor_induk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input autocomplete="off" type="email"
                            class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password
                            <span class="text-danger fst-italic fw-lighter" style="font-size: 12px">
                                *Min 4 Karakter</span>
                        </label>
                        <input autocomplete="off" type="password"
                            class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                            value="{{ old('password') }}" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

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
