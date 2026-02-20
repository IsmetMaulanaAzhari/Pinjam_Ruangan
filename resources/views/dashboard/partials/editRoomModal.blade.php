<div class="modal fade" id="editRoom" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Edit {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form method="post" enctype="multipart/form-data" id="editform">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="editCode" class="form-label">Kode Ruangan</label>
                        <input type="text" class="form-control  @error('code') is-invalid @enderror" id="editCode"
                            name="code" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class='mb-3'>
                        <label for='img' class='form-label'>Foto Ruangan <span
                                class="text-danger fst-italic fw-lighter" style="font-size: 12px">
                                *Max 2 Mb</span></label>
                        <input class="form-control @error('img') is-invalid @enderror" type='file' id='editImg'
                            name='img' accept="image/*" onchange="previewImage(event, 'editRoomPreview')" />
                        @error('img')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <!-- Current Image Display -->
                        <div class="mt-2">
                            <div id="currentImageContainer" style="display: none;">
                                <label class="form-label">Gambar Saat Ini:</label>
                                <div>
                                    <img id="currentImage" src="#" alt="Current Image" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
                                </div>
                            </div>
                            <!-- Preview for new image -->
                            <div id="newImageContainer" style="display: none;">
                                <label class="form-label mt-2">Preview Gambar Baru:</label>
                                <div>
                                    <img id="editRoomPreview" src="#" alt="Preview" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="editFloor" class="form-label">Lantai</label>
                            <input type="number" class="form-control" id="editFloor" name="floor" required>
                        </div>
                        <div class="col-6">
                            <label for="editCapacity" class="form-label">Kapasitas</label>
                            <input type="number" class="form-control" id="editCapacity" name="capacity" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editBuildingId" class="form-label d-block">Gedung</label>
                        <select class="form-select" aria-label="Default select example" name="building_id"
                            id="editBuildingId" required>
                            <option selected disabled>Pilih Gedung</option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building->id }}">{{ $building->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editType" class="form-label">Tipe Ruangan</label>
                        <select class="form-select" name="type" id="editType" required>
                            <option disabled>Pilih Tipe Ruangan</option>
                            <option value="Laboratorium">Laboratorium</option>
                            <option value="Ruang Kelas">Ruang Kelas</option>
                            <option value="Ruang Dosen">Ruang Dosen</option>
                            <option value="Ruang Umum">Ruang Umum</option>
                            <option value="Auditorium">Auditorium</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Deskripsi Ruangan</label>
                        <textarea name="description" id="editDescription" cols="30" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="editbtn" name="editbtn">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
