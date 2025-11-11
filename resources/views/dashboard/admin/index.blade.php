@extends('dashboard.layouts.main')

@section('container')
<div class="col-md-10 p-0">
    <div class="card-body text-end">

        {{-- Notifikasi --}}
        @if (session('adminSuccess'))
            <div class="alert alert-success text-center">{{ session('adminSuccess') }}</div>
        @endif
        @if (session('deleteAdmin'))
            <div class="alert alert-danger text-center">{{ session('deleteAdmin') }}</div>
        @endif

        {{-- Tombol tambah --}}
        @if (auth()->user()->role_id === 1)
        <div class="d-flex justify-content-end gap-2 mb-3">
            <a href="/dashboard/users" class="btn btn-primary">Pilih dari Mahasiswa</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdmin">
                Tambah Admin Baru
            </button>
        </div>
        @endif

        {{-- Tabel daftar admin --}}
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered text-center align-middle" id="datatable">
                <thead class="table-info">
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Nomor Induk</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->nomor_induk }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            {{-- Tombol edit --}}
                            <a href="#" class="text-warning me-2" data-bs-toggle="modal"
                                data-bs-target="#editAdminModal-{{ $admin->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            {{-- Hapus --}}
                            <form action="{{ route('dashboard.admin.destroy', $admin->id) }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="border-0 bg-transparent text-danger"
                                    onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @include('dashboard.partials.editAdminModal', ['admin' => $admin])
                    @empty
                    <tr>
                        <td colspan="5" class="text-muted">-- Belum Ada Daftar Admin --</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah Admin --}}
@include('dashboard.partials.addAdminModal')
@endsection
