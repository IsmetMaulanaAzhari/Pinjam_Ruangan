<div class="modal fade" id="editAdminModal-{{ $admin->id }}" tabindex="-1" aria-labelledby="editAdminLabel-{{ $admin->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="editAdminLabel-{{ $admin->id }}">Form Edit Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-start">
                <form action="{{ route('dashboard.admin.update', $admin->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label for="name-{{ $admin->id }}" class="form-label">Nama Lengkap</label>
                        <input type="text"
                            class="form-control"
                            id="name-{{ $admin->id }}"
                            name="name"
                            value="{{ old('name', $admin->name) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_induk-{{ $admin->id }}" class="form-label">Nomor Induk</label>
                        <input type="number"
                            class="form-control"
                            id="nomor_induk-{{ $admin->id }}"
                            name="nomor_induk"
                            value="{{ old('nomor_induk', $admin->nomor_induk) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="email-{{ $admin->id }}" class="form-label">Email</label>
                        <input type="email"
                            class="form-control"
                            id="email-{{ $admin->id }}"
                            name="email"
                            value="{{ old('email', $admin->email) }}"
                            required>
                    </div>

                    <div class="modal-footer border-0 pt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
