@extends('dashboard.layouts.main')

@section('container')
    <div class="col-md-10 p-0">
        <div class="card-body text-end">
            @if (session()->has('roomSuccess'))
                <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
                    {{ session('roomSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('deleteRoom'))
                <div class="col-md-16 mx-auto alert alert-success text-center  alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
                    {{ session('deleteRoom') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (auth()->user()->role_id === 1)
                <button type="button" class="mb-3 btn button btn-primary" data-bs-toggle="modal"
                    data-bs-target="#pinjamRuangan">
                    Pinjam
                </button>
                <button type="button" class="mb-3 btn button btn-primary" data-bs-toggle="modal" data-bs-target="#addRoom">
                    Tambah Ruangan
                </button>
            @endif
            <div class="table-responsive">
                <table class="table table-hover table-stripped table-bordered text-center dt-head-center">
                    <thead class="table-info">
                        <tr>
                            <th class="text-center" scope="row">No.</th>
                            <th class="text-center" scope="row">Gambar</th>
                            <th class="text-center" scope="row">Kode Ruangan</th>
                            <th class="text-center" scope="row">Nama Ruangan</th>
                            <th class="text-center" scope="row">Kapasitas</th>
                            <th class="text-center" scope="row">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($rooms->count() > 0)
                            @foreach ($rooms as $room)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td class="text-center">
                                        @if ($room->img)
                                            @if (Storage::exists('public/' . $room->img))
                                                <img src="{{ asset('storage/' . $room->img) }}" alt="{{ $room->name }}" 
                                                     class="img-thumbnail room-thumbnail" 
                                                     style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                                     onclick="showImageModal('{{ asset('storage/' . $room->img) }}', '{{ $room->name }}')">
                                            @else
                                                <img src="{{ asset($room->img) }}" alt="{{ $room->name }}" 
                                                     class="img-thumbnail room-thumbnail" 
                                                     style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                                     onclick="showImageModal('{{ asset($room->img) }}', '{{ $room->name }}')">
                                            @endif
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 80px; height: 80px; border-radius: 4px;">
                                                <i class="bi bi-image text-muted" style="font-size: 24px;"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $room->code }}</td>
                                    <td><a href="/dashboard/rooms/{{ $room->code }}" class="text-decoration-none"
                                            role="button">{{ $room->name }}</a></td>
                                    <td>{{ $room->capacity }} Kursi</td>

                                    @if (auth()->user()->role_id === 1)
                                        <td style="font-size: 22px;">
                                             <a href="/dashboard/rooms/{{ $room->code }}/edit"
                                                class="bi bi-pencil-square text-warning border-0 editroom" id="editroom"
                                                data-id="{{ $room->id }}" data-code="{{ $room->code }}"
                                                data-bs-toggle="modal" data-bs-target="#editRoom"></a>
                                            &nbsp; 
                                            <form action="/dashboard/rooms/{{ $room->code }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="bi bi-trash-fill text-danger border-0"
                                                    onclick="return confirm('Hapus data ruangan?')"></button>
                                            </form>
                                            
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    -- Belum Ada Daftar Ruangan --
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $rooms->links() }}
            </div>
        </div>
    </div>
    @extends('dashboard.partials.rentModal')
    @extends('dashboard.partials.addRoomModal')
    @extends('dashboard.partials.editRoomModal')

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Preview Gambar Ruangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="" class="img-fluid" style="max-height: 500px;">
                </div>
            </div>
        </div>
    </div>

    <script>
        function showImageModal(imageSrc, roomName) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalImage').alt = roomName;
            document.getElementById('imageModalLabel').textContent = 'Preview Gambar - ' + roomName;
            
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>
@endsection
