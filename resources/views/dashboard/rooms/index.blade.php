@extends('dashboard.layouts.main')

@section('container')
    <div class="content">
        @if (session()->has('roomSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                {{ session('roomSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('deleteRoom'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                {{ session('deleteRoom') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                <strong>Error!</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (auth()->user()->role_id == 1)
            <div class="d-flex justify-content-end mb-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoom"
                    style="padding: 12px 24px; font-size: 14px; border-radius: 8px; font-weight: 500; background: #007bff; border: none;">
                    <i class="bi bi-plus-circle-fill me-2"></i>Tambah Ruangan
                </button>
            </div>
        @endif

        <div class="room-table-container">
            <table class="table table-borderless align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 80px;">No.</th>
                        <th scope="col">Gedung</th>
                        <th scope="col">Nama Ruangan</th>
                        <th scope="col" class="text-center" style="width: 120px;">Kapasitas</th>
                        <th scope="col" class="text-center" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($rooms->count() > 0)
                        @foreach ($rooms as $room)
                            <tr>
                                <td class="text-center">{{ ($rooms->currentPage() - 1) * $rooms->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $room->building ? $room->building->name : '-' }}</strong></td>
                                <td>
                                    <a href="/showruang/{{ $room->code }}" class="text-decoration-none" style="color: #007bff; font-weight: 500;">
                                        {{ $room->name }}
                                    </a>
                                </td>
                                <td class="text-center">{{ $room->capacity }} Kursi</td>
                                <td class="text-center">
                                    <a href="#" class="editroom me-2" 
                                        data-id="{{ $room->id }}" 
                                        data-code="{{ $room->code }}"
                                        data-action="/dashboard/rooms/{{ $room->code }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editRoom"
                                        title="Edit"
                                        onclick="setFormActionRoom('{{ $room->code }}')"
                                        style="color: #ffc107; text-decoration: none;">
                                        <i class="bi bi-pencil-square" style="font-size: 18px;"></i>
                                    </a>
                                    <form action="/dashboard/rooms/{{ $room->code }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 border-0"
                                            onclick="return confirm('Hapus data ruangan?')"
                                            title="Hapus"
                                            style="color: #dc3545; text-decoration: none;">
                                            <i class="bi bi-trash-fill" style="font-size: 18px;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <em class="text-muted">-- Belum Ada Daftar Ruangan --</em>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $rooms->links() }}
        </div>
    </div>
    @include('dashboard.partials.rentModal')
    @include('dashboard.partials.addRoomModal')
    @include('dashboard.partials.editRoomModal')

    <style>
        .room-table-container {
            background: white;
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .room-table-container .table {
            margin-bottom: 0;
        }

        .room-table-container .table thead {
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .room-table-container .table thead th {
            font-weight: 600;
            color: #495057;
            padding: 18px 15px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .room-table-container .table tbody td {
            padding: 18px 15px;
            vertical-align: middle;
            border: none;
            color: #212529;
            font-size: 14px;
        }

        .room-table-container .table tbody tr {
            border-bottom: 1px solid #f1f3f5;
            transition: background-color 0.2s ease;
        }

        .room-table-container .table tbody tr:last-child {
            border-bottom: none;
        }

        .room-table-container .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-primary {
            background: #007bff !important;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #0056b3 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.25);
        }
    </style>
@endsection
