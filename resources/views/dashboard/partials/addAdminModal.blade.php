<div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="addAdminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            {{-- Header Modal --}}
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="addAdminLabel">
                    Form Tambah Admin
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Body Modal --}}
            <div class="modal-body text-start">
                {{-- ✅ Perbaikan di sini --}}
                <form action="{{ route('dashboard.admin.store') }}" method="POST">
                    @csrf
                    {{-- Input Nama --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" 
                            autocomplete="off" 
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Nomor Induk --}}
                    <div class="mb-3">
                        <label for="nomor_induk" class="form-label">
                            Nomor Induk 
                            <span class="text-danger fst-italic fw-lighter" style="font-size: 12px">*Min 8 Angka</span>
                        </label>
                        <input 
                            type="number" 
                            id="nomor_induk" 
                            name="nomor_induk" 
                            class="form-control @error('nomor_induk') is-invalid @enderror"
                            value="{{ old('nomor_induk') }}" 
                            autocomplete="off" 
                            required>
                        @error('nomor_induk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" 
                            autocomplete="off" 
                            required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password 
                            <span class="text-danger fst-italic fw-lighter" style="font-size: 12px">*Min 4 Karakter</span>
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control @error('password') is-invalid @enderror"
                            autocomplete="off" 
                            required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Footer Modal --}}
                    <div class="modal-footer border-0 pt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i> Tambah Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
