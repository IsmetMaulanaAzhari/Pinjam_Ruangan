<div class="modal fade" id="addRoom" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('dashboard.rooms.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Ruangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="code" class="form-label">Kode Ruangan</label>
            <input type="text" class="form-control" name="code" required>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama Ruangan</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="mb-3">
            <label for="img" class="form-label">Foto Ruangan</label>
            <input type="file" class="form-control" name="img">
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="floor" class="form-label">Lantai</label>
              <input type="number" class="form-control" name="floor" required>
            </div>
            <div class="col">
              <label for="capacity" class="form-label">Kapasitas</label>
              <input type="number" class="form-control" name="capacity" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="building_id" class="form-label">Gedung</label>
            <select class="form-select" name="building_id" required>
              <option disabled selected>Pilih Gedung</option>
              @foreach ($buildings as $building)
              <option value="{{ $building->id }}">{{ $building->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="type" class="form-label">Tipe Ruangan</label>
            <select class="form-select" name="type" required>
              <option disabled selected>Pilih Tipe</option>
              <option value="Laboratorium">Laboratorium</option>
              <option value="Ruang Kelas">Ruang Kelas</option>
              <option value="Ruang Dosen">Ruang Dosen</option>
              <option value="Ruang Umum">Ruang Umum</option>
              <option value="Auditorium">Auditorium</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
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
