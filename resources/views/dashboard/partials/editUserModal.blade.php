<div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Edit {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form method="POST" id="editformuser">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" id="edit_user_id">
                    <div class="mb-3">
                        <label for="edit_user_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="edit_user_name"
                            name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_user_nomor_induk" class="form-label">Nomor Induk
                            <span class="text-danger fst-italic fw-lighter" style="font-size: 12px"> *Min 8 Angka</span>
                        </label>
                        <input type="number" class="form-control"
                            id="edit_user_nomor_induk" name="nomor_induk" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_user_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_user_email"
                            name="email" required>
                    </div>
                    <input type="hidden" name="role_id" id="edit_user_role_id" value="2">
                    <div class="mb-3">
                        <label for="edit_user_password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" class="form-control" id="edit_user_password" name="password" placeholder="Biarkan kosong jika tidak ingin mengganti password">
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
    function setFormActionUser(id) {
        // Set form action dengan ID yang benar
        const actionUrl = '/dashboard/users/' + id;
        document.getElementById('editformuser').action = actionUrl;
        
        // Load user data
        $.ajax({
            url: '/dashboard/users/' + id + '/edit',
            method: 'GET',
            success: function(response) {
                try {
                    const user = JSON.parse(response);
                    $('#edit_user_id').val(user.id);
                    $('#edit_user_name').val(user.name);
                    $('#edit_user_nomor_induk').val(user.nomor_induk);
                    $('#edit_user_email').val(user.email);
                    $('#edit_user_role_id').val(2);
                    $('#edit_user_password').val('');
                } catch (e) {
                    console.error('Failed parsing user response', e, response);
                }
            },
            error: function(xhr) {
                console.error('Failed to load user data', xhr);
            }
        });
    }
    
    $(document).ready(function() {
        // Safety: block submit if action not set
        $('#editformuser').on('submit', function(e) {
            const action = $(this).attr('action') || '';
            if (!action || action.trim() === '') {
                e.preventDefault();
                alert('Terjadi kesalahan: URL tujuan tidak tersedia. Silakan tutup modal lalu buka kembali.');
            }
        });
    });
</script>
