<div class="modal fade" id="editRoom" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editRoomForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Laravel mengenali PUT request -->
        <div class="modal-header">
          <h5 class="modal-title">Edit Ruangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="edit_id" name="id">
          <div class="mb-3">
            <label class="form-label">Kode Ruangan</label>
            <input type="text" id="edit_code" name="code" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Nama Ruangan</label>
            <input type="text" id="edit_name" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Foto Ruangan</label>
            <input type="file" id="edit_img" name="img" class="form-control">
          </div>
          <div class="row mb-3">
            <div class="col">
              <label class="form-label">Lantai</label>
              <input type="number" id="edit_floor" name="floor" class="form-control" required>
            </div>
            <div class="col">
              <label class="form-label">Kapasitas</label>
              <input type="number" id="edit_capacity" name="capacity" class="form-control" required>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Gedung</label>
            <select id="edit_building_id" name="building_id" class="form-select" required>
              <option disabled selected>Pilih Gedung</option>
              @foreach ($buildings as $building)
              <option value="{{ $building->id }}">{{ $building->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Tipe Ruangan</label>
            <select id="edit_type" name="type" class="form-select" required>
              <option value="Laboratorium">Laboratorium</option>
              <option value="Ruang Kelas">Ruang Kelas</option>
              <option value="Ruang Dosen">Ruang Dosen</option>
              <option value="Ruang Umum">Ruang Umum</option>
              <option value="Auditorium">Auditorium</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea id="edit_description" name="description" class="form-control" rows="4" required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.editroom');
    const form = document.getElementById('editRoomForm');

    editButtons.forEach(button => {
        button.addEventListener('click', async function() {
            const code = this.dataset.code;

            try {
                const response = await fetch(`/dashboard/rooms/${code}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();

                // Set form action directly
                form.action = `/dashboard/rooms/${data.code}`;

                form.querySelector('#edit_id').value = data.id;
                form.querySelector('#edit_code').value = data.code;
                form.querySelector('#edit_name').value = data.name;
                form.querySelector('#edit_floor').value = data.floor;
                form.querySelector('#edit_capacity').value = data.capacity;
                form.querySelector('#edit_building_id').value = data.building_id;
                form.querySelector('#edit_type').value = data.type;
                form.querySelector('#edit_description').value = data.description;

                console.log('Room data loaded:', data);
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memuat data ruangan: ' + error.message);
            }
        });
    });
});
</script>

