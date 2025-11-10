@extends('dashboard.layouts.main')

@section('container')
    <div class="col-md-10 p-0">
<<<<<<< HEAD
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Daftar Peminjaman Sementara</h2>
            </div>

            @if (session()->has('acceptSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('acceptSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('declineSuccess'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('declineSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle" id="datatable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Ruangan</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Mulai Pinjam</th>
                            <th scope="col">Selesai Pinjam</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Mulai Transaksi</th>
                            <th scope="col">Status Pinjam</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rents->count() > 0)
                            @foreach ($rents as $rent)
                                <tr>
                                    <td>{{ ($rents->currentPage() - 1) * $rents->perPage() + $loop->iteration }}</td>
                                    <td>{{ $rent->room->name }}</td>
                                    <td class="text-start">{{ $rent->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rent->time_start_use)->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rent->time_end_use)->format('Y-m-d H:i:s') }}</td>
                                    <td class="text-start">{{ $rent->purpose }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rent->transaction_start)->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            {{ $rent->status }}
                                        </span>
                                    </td>
                                    @if (auth()->user()->role_id === 1)
                                        <td>
                                            <a href="/dashboard/temporaryRents/{{ $rent->id }}/acceptRents"
                                                class="btn btn-success btn-sm me-1"
                                                onclick="return confirm('Terima peminjaman ini?')">
                                                <i class="bi bi-check-lg"></i>
                                            </a>
                                            <a href="/dashboard/temporaryRents/{{ $rent->id }}/declineRents"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Tolak peminjaman ini?')">
                                                <i class="bi bi-x-lg"></i>
                                            </a>
=======
        <div class="card-body text-end">
            <div class="table-responsive">
                <div class="d-flex justify-content-start">
                    {{ $rents->links() }}
                </div>
                <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="datatable">
                    <thead class="table-info">
                        <tr>
                            <th scope="row">No.</th>
                            <th scope="row">Nama Ruangan</th>
                            <th scope="row">Nama Peminjam</th>
                            <th scope="row">Mulai Pinjam</th>
                            <th scope="row">Selesai Pinjam</th>
                            <th scope="row">Tujuan</th>
                            <th scope="row">Mulai Transaksi</th>
                            <th scope="row">Status Pinjam</th>
                            <th scope="row">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($rents->count() > 0)
                            @foreach ($rents as $rent)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th scope="row">
                                    <td><a href="/dashboard/rooms/{{ $rent->room->code }}"
                                            class="text-decoration-none">{{ $rent->room->code }}</a></td>
                                    <td>{{ $rent->user->name }}</td>
                                    <td>{{ $rent->time_start_use }}</td>
                                    <td>{{ $rent->time_end_use }}</td>
                                    <td>{{ $rent->purpose }}</td>
                                    <td>{{ $rent->transaction_start }}</td>
                                    <td>{{ $rent->status }}</td>

                                    @if (auth()->user()->role_id === 1)
                                        <td>
                                            <a href="/dashboard/temporaryRents/{{ $rent->id }}/acceptRents"
                                                class="btn btn-success mb-2" style="padding: 2px 10px"><i
                                                    class="bi bi-check-lg"></i></a>
                                            <a href="/dashboard/temporaryRents/{{ $rent->id }}/declineRents"
                                                class="btn btn-danger mb-2" style="padding: 2px 10px"><i
                                                    class="bi bi-x-lg"></i></a>
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
<<<<<<< HEAD
                                <td colspan="9" class="text-center py-4">
                                    <em>-- Belum Ada Peminjaman Sementara --</em>
=======
                                <td colspan="9" class="text-center">
                                    -- Belum Ada Daftar Peminjam --
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
<<<<<<< HEAD

            <div class="d-flex justify-content-end mt-3">
                {{ $rents->links() }}
            </div>
=======
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
        </div>
    </div>
@endsection
