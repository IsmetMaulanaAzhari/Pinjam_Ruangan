@extends('dashboard.layouts.main')

@section('container')
<div class="col-md-10 p-0">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Daftar Ruangan</h2>
            @if (auth()->user()->role_id === 1)
            <div>
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#pinjamRuangan">
                    Pinjam
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoom">
                    Tambah Ruangan
                </button>
            </div>
            @endif
        </div>

        {{-- Alert --}}
        @if (session()->has('roomSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('roomSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if (session()->has('deleteRoom'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('deleteRoom') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="table-responsive">
    <table class="table table-hover table-bordered text-center">
        <thead class="table-info">
            <tr>
                <th>No</th>
                <th>Kode Ruangan</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rooms as $room)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $room->code }}</td>
                <td>
                    <a href="/dashboard/rooms/{{ $room->code }}" class="text-decoration-none">
                        {{ $room->name }}
                    </a>
                </td>
                <td>{{ $room->capacity }} Kursi</td>
                <td>
                    <!-- Tombol Edit -->
                    <button type="button" class="btn btn-warning btn-sm editroom"
                        data-id="{{ $room->id }}" data-code="{{ $room->code }}"
                        data-bs-toggle="modal" data-bs-target="#editRoom">
                        Edit
                    </button>

                    <!-- Tombol Hapus -->
                    <form action="/dashboard/rooms/{{ $room->code }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus data ruangan?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">-- Belum Ada Daftar Ruangan --</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
        <div class="d-flex justify-content-end mt-3">
            {{ $rooms->links() }}
        </div>
    </div>
</div>

@include('dashboard.partials.rentModal')
@include('dashboard.partials.addRoomModal')
@include('dashboard.partials.editRoomModal')
@endsection
