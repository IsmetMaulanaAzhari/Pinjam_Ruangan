<div class="modal fade" id="editRoom" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Edit Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form method="POST" enctype="multipart/form-data" id="editformroom">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" id="edit_room_id">
                    <div class="mb-3">
                        <label for="edit_room_building_id" class="form-label">Gedung</label>
                        <select class="form-select" name="building_id" id="edit_room_building_id" required>
                            <option value="" disabled>Pilih Gedung</option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building->id }}" data-code="{{ $building->code }}">{{ $building->name }} ({{ $building->code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_room_name" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" id="edit_room_name" name="name"
                            placeholder="Contoh: R 4-1, BR 2-3, Aula Utama" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_room_code" class="form-label">Kode Ruangan</label>
                        <input type="text" class="form-control" id="edit_room_code" name="code"
                            placeholder="Contoh: R-4-1, BR-2-3, Aula-Utama" required>
                    </div>
                    <div class='mb-3'>
                        <label for='edit_room_img' class='form-label'>Foto Ruangan 
                            <span class="text-danger fst-italic fw-lighter" style="font-size: 12px">*Max 2 Mb (Kosongkan jika tidak diubah)</span>
                        </label>
                        <div id="current_image_info" class="mb-2 p-2" style="background: #f8f9fa; border-radius: 6px; font-size: 13px;">
                            <i class="bi bi-image text-primary"></i> <span class="text-muted">Gambar saat ini akan dipertahankan jika tidak diupload gambar baru</span>
                        </div>
                        <input class="form-control" type='file' id='edit_room_img' name='img' accept="image/*" />
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="edit_room_floor" class="form-label">Lantai</label>
                            <input type="number" class="form-control" id="edit_room_floor" name="floor" required>
                        </div>
                        <div class="col-6">
                            <label for="edit_room_capacity" class="form-label">Kapasitas</label>
                            <input type="number" class="form-control" id="edit_room_capacity" name="capacity" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_room_type" class="form-label">Tipe Ruangan</label>
                        <select class="form-select" name="type" id="edit_room_type" required>
                            <option value="" disabled>Pilih Tipe Ruangan</option>
                            <option value="Laboratorium">Laboratorium</option>
                            <option value="Ruang Kelas">Ruang Kelas</option>
                            <option value="Ruang Dosen">Ruang Dosen</option>
                            <option value="Ruang Umum">Ruang Umum</option>
                            <option value="Auditorium">Auditorium</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_room_description" class="form-label">Deskripsi Ruangan</label>
                        <textarea name="description" id="edit_room_description" cols="30" rows="5" class="form-control" required></textarea>
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
    function setFormActionRoom(code) {
        // Set form action dengan code yang benar
        const actionUrl = '/dashboard/rooms/' + code;
        document.getElementById('editformroom').action = actionUrl;
        
        // Load room data
        $.ajax({
            url: '/dashboard/rooms/' + code + '/edit',
            method: 'GET',
            success: function(response) {
                try {
                    const room = JSON.parse(response);
                    $('#edit_room_id').val(room.id);
                    $('#edit_room_floor').val(room.floor);
                    $('#edit_room_capacity').val(room.capacity);
                    $('#edit_room_building_id').val(room.building_id);
                    $('#edit_room_type').val(room.type);
                    $('#edit_room_description').val(room.description);
                    $('#edit_room_name').val(room.name);
                    $('#edit_room_code').val(room.code);
                    $('#edit_room_name').val(room.name);
                    
                    // Set building code untuk auto-generation
                    const selectedOption = $('#edit_room_building_id option:selected');
                    if (selectedOption.length) {
                        window.editSelectedBuildingCode = selectedOption.data('code');
                    }
                } catch (e) {
                    console.error('Failed parsing room response', e, response);
                }
            },
            error: function(xhr) {
                console.error('Failed to load room data', xhr);
            }
        });
    }
    
    $(document).ready(function() {
        // No auto-generation, all manual input
    });
</script>
