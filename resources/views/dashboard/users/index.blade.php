@extends('dashboard.layouts.main')

@section('container')
    <div class="content">
        @if (auth()->user()->role_id == 1)
            <div class="d-flex justify-content-end mb-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser"
                    style="padding: 12px 24px; font-size: 14px; border-radius: 8px; font-weight: 500; background: #007bff; border: none;">
                    <i class="bi bi-person-plus-fill me-2"></i>Tambah Mahasiswa
                </button>
            </div>
        @endif

        @if (session()->has('userSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                {{ session('userSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('deleteUser'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                {{ session('deleteUser') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="user-table-container">
            <table class="table table-borderless align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 80px;">No.</th>
                        <th scope="col">Username</th>
                        <th scope="col" class="text-center" style="width: 150px;">Nomor Induk</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="text-center" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td class="text-center">{{ $user->nomor_induk }}</td>
                                <td>{{ $user->email }}</td>                             
                                @if (auth()->user()->role_id == 1)
                                    <td class="text-center">
                                        <a href="/dashboard/users/{{ $user->id }}/makeAdmin" 
                                            class="makeadmin me-2"
                                            title="Jadikan Admin"
                                            onclick="return confirm('Jadikan {{ $user->name }} sebagai admin?')"
                                            style="color: #28a745; text-decoration: none; font-size: 18px;">
                                            <i class="bi bi-person-check-fill"></i>
                                        </a>
                                        <a href="#" class="edituser me-2"
                                            data-id="{{ $user->id }}"
                                            data-action="/dashboard/users/{{ $user->id }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#edituser"
                                            title="Edit"
                                            style="color: #ffc107; text-decoration: none; font-size: 18px;"
                                            onclick="setFormActionUser({{ $user->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="/dashboard/users/{{ $user->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0 border-0"
                                                title="Hapus"
                                                onclick="return confirm('Hapus data mahasiswa?')"
                                                style="color: #dc3545; text-decoration: none; font-size: 18px;">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <em class="text-muted">-- Belum Ada Daftar Mahasiswa --</em>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $users->links() }}
        </div>
    </div>
    @include('dashboard.partials.addUserModal')
    @include('dashboard.partials.editUserModal')

    <style>
        .user-table-container {
            background: white;
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .user-table-container .table {
            margin-bottom: 0;
        }

        .user-table-container .table thead {
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .user-table-container .table thead th {
            font-weight: 600;
            color: #495057;
            padding: 18px 15px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .user-table-container .table tbody td {
            padding: 18px 15px;
            vertical-align: middle;
            border: none;
            color: #212529;
            font-size: 14px;
        }

        .user-table-container .table tbody tr {
            border-bottom: 1px solid #f1f3f5;
            transition: background-color 0.2s ease;
        }

        .user-table-container .table tbody tr:last-child {
            border-bottom: none;
        }

        .user-table-container .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .makeadmin:hover, .edituser:hover {
            opacity: 0.7;
            transform: scale(1.1);
            transition: all 0.2s ease;
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
