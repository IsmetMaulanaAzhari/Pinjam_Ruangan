@extends('dashboard.layouts.main')

@section('container')
    <div class="col-md-10 p-0">
<<<<<<< HEAD
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Daftar Ruangan</h2>
                <div>
                    @if (auth()->user()->role_id === 1)
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#pinjamRuangan">
                            Pinjam
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoom">
                            Tambah Ruangan
                        </button>
                    @endif
                </div>
            </div>

            @if (session()->has('roomSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
=======
        <div class="card-body text-end">
            @if (session()->has('roomSuccess'))
                <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                    {{ session('roomSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('deleteRoom'))
<<<<<<< HEAD
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
=======
                <div class="col-md-16 mx-auto alert alert-success text-center  alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                    {{ session('deleteRoom') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

<<<<<<< HEAD
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle dt-head-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Ruangan</th>
                            <th scope="col">Nama Ruangan</th>
                            <th scope="col">Kapasitas</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rooms->count() > 0)
                            @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ ($rooms->currentPage() - 1) * $rooms->perPage() + $loop->iteration }}</td>
                                    <td>{{ $room->code }}</td>
                                    <td class="text-start">
                                        <a href="/showruang/{{ $room->code }}" class="text-decoration-none text-primary fw-semibold"
                                            role="button">{{ $room->name }}</a>
                                    </td>
                                    <td>{{ $room->capacity }} Kursi</td>
                                    @if (auth()->user()->role_id === 1)
                                        <td>
                                            <a href="#" class="text-warning me-2 editroom" id="editroom"
                                                data-id="{{ $room->id }}" data-code="{{ $room->code }}"
                                                data-bs-toggle="modal" data-bs-target="#editRoom">
                                                <i class="bi bi-pencil-square fs-5"></i>
                                            </a>
=======
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
                                    <td >{{ $room->code }}</td>
                                    <td><a href="/dashboard/rooms/{{ $room->code }}" class="text-decoration-none"
                                            role="button">{{ $room->name }}</a></td>
                                    <td> {{ $room->capacity }} Kursi</td>

                                    @if (auth()->user()->role_id === 1)
                                        <td style="font-size: 22px;">
                                             <a href="/dashboard/rooms/{{ $room->code }}/edit"
                                                class="bi bi-pencil-square text-warning border-0 editroom" id="editroom"
                                                data-id="{{ $room->id }}" data-code="{{ $room->code }}"
                                                data-bs-toggle="modal" data-bs-target="#editRoom"></a>
                                            &nbsp; 
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                                            <form action="/dashboard/rooms/{{ $room->code }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
<<<<<<< HEAD
                                                <button type="submit" class="btn btn-link p-0 text-danger border-0"
                                                    onclick="return confirm('Hapus data ruangan?')">
                                                    <i class="bi bi-trash-fill fs-5"></i>
                                                </button>
                                            </form>
=======
                                                <button type="submit" class="bi bi-trash-fill text-danger border-0"
                                                    onclick="return confirm('Hapus data ruangan?')"></button>
                                            </form>
                                            
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
<<<<<<< HEAD
                                <td colspan="5" class="text-center py-4">
                                    <em>-- Belum Ada Daftar Ruangan --</em>
=======
                                <td colspan="4" class="text-center">
                                    -- Belum Ada Daftar Ruangan --
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
<<<<<<< HEAD
            
            <div class="d-flex justify-content-end mt-3">
=======
            <div class="d-flex justify-content-end">
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                {{ $rooms->links() }}
            </div>
        </div>
    </div>
<<<<<<< HEAD
    @include('dashboard.partials.rentModal')
    @include('dashboard.partials.addRoomModal')
    @include('dashboard.partials.editRoomModal')
=======
    @extends('dashboard.partials.rentModal')
    @extends('dashboard.partials.addRoomModal')
    @extends('dashboard.partials.editRoomModal')
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
@endsection
