<div class="modal fade" id="editadmin" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Edit Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form method="POST" id="editformadmin">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="edit_name"
                            name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nomor_induk" class="form-label">Nomor Induk
                            <span class="text-danger fst-italic fw-lighter" style="font-size: 12px"> *Min 8 Angka</span>
                        </label>
                        <input type="number" class="form-control"
                            id="edit_nomor_induk" name="nomor_induk" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email"
                            name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" class="form-control" id="edit_password" name="password" placeholder="Biarkan kosong jika tidak ingin mengganti password">
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
    function setFormAction(id) {
        // Set form action dengan ID yang benar
        const actionUrl = '/dashboard/admin/' + id;
        document.getElementById('editformadmin').action = actionUrl;
        
        // Load admin data
        $.ajax({
            url: '/dashboard/admin/' + id + '/edit',
            method: 'GET',
            success: function(response) {
                try {
                    const admin = JSON.parse(response);
                    $('#edit_id').val(admin.id);
                    $('#edit_name').val(admin.name);
                    $('#edit_nomor_induk').val(admin.nomor_induk);
                    $('#edit_email').val(admin.email);
                    $('#edit_password').val('');
                } catch (e) {
                    console.error('Failed parsing admin response', e, response);
                }
            },
            error: function(xhr) {
                console.error('Failed to load admin data', xhr);
            }
        });
    }
</script>
