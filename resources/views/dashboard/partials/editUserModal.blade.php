<div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Edit {{ $title ?? 'User' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form action="" method="post" id="editformuser">
                    @method('put')
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" id="id">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $user->name ?? '') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nomor_induk" class="form-label">Nomor Induk</label>
                        <input type="number" class="form-control @error('nomor_induk') is-invalid @enderror"
                            id="nomor_induk" name="nomor_induk"
                            value="{{ old('nomor_induk', $user->nomor_induk ?? '') }}" required>
                        @error('nomor_induk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label d-block">User Role</label>
                        <select class="form-select" name="role_id" id="role_id" required>
                            <option selected disabled>Pilih Role</option>
                            @foreach ($roles ?? [] as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.edituser').on('click', function() {
            const id = $(this).data('id');

            $.ajax({
                url: '/dashboard/users/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    const user = response; // Sudah JSON otomatis karena pakai response()->json di controller
                    console.log('User data loaded:', user); // Debugging

                    // Isi form
                    $('#id').val(user.id);
                    $('#name').val(user.name);
                    $('#nomor_induk').val(user.nomor_induk);
                    $('#email').val(user.email);
                    $('#role_id').val(user.role_id);

                    // SET ACTION FORM dengan ID user
                    $('#editformuser').attr('action', '/dashboard/users/' + user.id);
                },
                error: function(xhr) {
                    console.error('Gagal load data user:', xhr.responseText);
                    alert('Terjadi kesalahan saat memuat data.');
                }
            });
        });
    });
</script>
