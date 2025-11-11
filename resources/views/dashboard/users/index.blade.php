@extends('dashboard.layouts.main')

@section('container')
<div class="col-md-10 p-0">
    <div class="card-body text-end">

        {{-- Alert sukses / gagal --}}
        @if (session()->has('userSuccess'))
            <div class="alert alert-success text-center alert-dismissible fade show" style="margin-top: 50px" role="alert">
                {{ session('userSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session()->has('deleteUser'))
            <div class="alert alert-success text-center alert-dismissible fade show" style="margin-top: 50px" role="alert">
                {{ session('deleteUser') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Tombol Tambah Mahasiswa --}}
        @if (auth()->check() && auth()->user()->role_id === 1)
            <button type="button" class="mb-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                Tambah Mahasiswa
            </button>
        @endif

        <div class="table-responsive">
            @if(isset($users) && $users->count())
                <div class="d-flex justify-content-start mb-2">
                    {{ $users->links() }}
                </div>
            @endif

            <table class="table table-hover table-striped table-bordered text-center">
                <thead class="table-info">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nomor Induk</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users ?? [] as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name ?? '-' }}</td>
                            <td>{{ $user->nomor_induk ?? '-' }}</td>
                            <td>{{ $user->email ?? '-' }}</td>
                            <td>{{ $user->role->name ?? '-' }}</td>

                            @if (auth()->check() && auth()->user()->role_id === 1)
                                <td style="font-size: 20px;">
                                    {{-- Tombol Edit --}}
                                    <a href="#" 
                                       class="edituser text-warning" 
                                       data-id="{{ $user->id }}" 
                                       data-bs-toggle="modal" 
                                       data-bs-target="#edituser">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Jadikan Admin --}}
                                    <a href="/dashboard/users/{{ $user->id }}/makeAdmin" class="text-primary mx-2">
                                        <i class="bi bi-person-plus-fill"></i>
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="/dashboard/users/{{ $user->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="border-0 bg-transparent text-danger" 
                                            onclick="return confirm('Hapus data mahasiswa?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">-- Belum Ada Mahasiswa --</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal --}}
@include('dashboard.partials.addUserModal')
@include('dashboard.partials.editUserModal')
@endsection
