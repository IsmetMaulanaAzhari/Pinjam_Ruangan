@extends('dashboard.layouts.main')

@section('container')
<<<<<<< HEAD
    <div class="content">
        @if (session()->has('adminSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                {{ session('adminSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('deleteAdmin'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                {{ session('deleteAdmin') }}
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
                <a href="/dashboard/users" class="btn btn-primary me-2" 
                    style="padding: 12px 24px; font-size: 14px; border-radius: 8px; font-weight: 500; background: #007bff; border: none;">
                    <i class="bi bi-people-fill me-2"></i>Pilih dari Mahasiswa
                </a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdmin"
                    style="padding: 12px 24px; font-size: 14px; border-radius: 8px; font-weight: 500; background: #007bff; border: none;">
                    <i class="bi bi-person-plus-fill me-2"></i>Tambah Admin Baru
                </button>
            </div>
        @endif

        <div class="admin-table-container">
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
                    @if ($admins->count() > 0)
                        @foreach ($admins as $admin)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td><strong>{{ $admin->name }}</strong></td>
                                <td class="text-center">{{ $admin->nomor_induk }}</td>
                                <td>{{ $admin->email }}</td>
                                <td class="text-center">
                                    <a href="/dashboard/admin/{{ $admin->id }}/demote" 
                                        class="me-2"
                                        title="Turunkan ke Mahasiswa"
                                        onclick="return confirm('Turunkan {{ $admin->name }} menjadi mahasiswa biasa?')"
                                        style="color: #17a2b8; text-decoration: none;">
                                        <i class="bi bi-arrow-down-circle-fill" style="font-size: 18px;"></i>
                                    </a>
                                    <a href="#" class="editadmin me-2" 
                                        data-id="{{ $admin->id }}" 
                                        data-bs-toggle="modal"
                                        data-bs-target="#editadmin"
                                        title="Edit"
                                        style="color: #ffc107; text-decoration: none;">
                                        <i class="bi bi-pencil-square" style="font-size: 18px;"></i>
                                    </a>
                                    <form action="/dashboard/admin/{{ $admin->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 border-0"
                                            onclick="return confirm('Hapus data Admin?')" 
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
                                <em class="text-muted">-- Belum Ada Daftar Admin --</em>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('dashboard.partials.addAdminModal')
    @include('dashboard.partials.editAdminModal')

    <style>
        .admin-table-container {
            background: white;
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .admin-table-container .table {
            margin-bottom: 0;
        }

        .admin-table-container .table thead {
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .admin-table-container .table thead th {
            font-weight: 600;
            color: #495057;
            padding: 18px 15px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .admin-table-container .table tbody td {
            padding: 18px 15px;
            vertical-align: middle;
            border: none;
            color: #212529;
            font-size: 14px;
        }

        .admin-table-container .table tbody tr {
            border-bottom: 1px solid #f1f3f5;
            transition: background-color 0.2s ease;
        }

        .admin-table-container .table tbody tr:last-child {
            border-bottom: none;
        }

        .admin-table-container .table tbody tr:hover {
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
=======
    <div class="col-md-10 p-0">
        <div class="card-body text-end">
            @if (session()->has('adminSuccess'))
                <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
                    {{ session('adminSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('deleteAdmin'))
                <div class="col-md-16 mx-auto alert alert-success text-center  alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
                    {{ session('deleteAdmin') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (auth()->user()->role_id === 1)
                <a href="/dashboard/users" type="button" class="mb-3 btn button btn-primary">
                    Pilih dari Mahasiswa
                </a>
                <button type="button" class="mb-3 btn button btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addAdmin">
                    Tambah Admin Baru
                </button>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="datatable">
                    <thead class="table-info">
                        <tr>
                            <th scope="row">No.</th>
                            <th scope="row">Username</th>
                            <th scope="row">Nomor Induk</th>
                            <th scope="row">Email</th>
                            <th scope="row">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($admins->count() > 0)
                            @foreach ($admins as $admin)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }} </th>
                                    <td>{{ $admin->name }} </td>
                                    <td>{{ $admin->nomor_induk }} </td>
                                    <td>{{ $admin->email }} </td>
                                    <td style="font-size: 22px;">
                                        <a href="/dashboard/users/{{ $admin->id }}/edit" class="editadmin" id="editadmin"
                                            data-id="{{ $admin->id }}" data-bs-toggle="modal"
                                            data-bs-target="#editadmin"><i
                                                class="bi bi-pencil-square text-warning"></i></a>&nbsp;
                                        <form action="/dashboard/admin/{{ $admin->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="bi bi-trash-fill text-danger border-0"
                                                onclick="return confirm('Hapus data Admin?')">
                                            </button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">
                                    -- Belum Ada Daftar Admin --
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @extends('dashboard.partials.addAdminModal')
    @extends('dashboard.partials.editAdminModal')
    {{-- @extends('dashboard.partials.chooseAdminModal') --}}
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
@endsection
