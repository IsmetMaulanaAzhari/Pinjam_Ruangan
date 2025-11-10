@extends('dashboard.layouts.main')

@section('container')
    <div class="col-md-10 p-0">
<<<<<<< HEAD
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Peminjaman</h2>
                @if (auth()->user()->role_id === 1)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#pinjamRuangan">
                        Pinjam
                    </button>
                @endif
            </div>

            @if (session()->has('rentSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
=======
        <div class="card-body text-end">
            @if (session()->has('rentSuccess'))
                <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                    {{ session('rentSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('deleteRent'))
<<<<<<< HEAD
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
=======
                <div class="col-md-16 mx-auto alert alert-success text-center  alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                    {{ session('deleteRent') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

<<<<<<< HEAD
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle" id="datatable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Ruangan</th>
                            @if (auth()->user()->role_id <= 2)
                                <th scope="col">Nama Peminjam</th>
                            @endif
                            <th scope="col">Mulai Pinjam</th>
                            <th scope="col">Selesai Pinjam</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Mulai Transaksi</th>
                            <th scope="col">Kembalikan</th>
                            <th scope="col">Status Pinjam</th>
                            @if (auth()->user()->role_id <= 2)
                                <th scope="col">Action</th>
=======
            @if (auth()->user()->role_id === 1)
                <button type="button" class="mb-3 btn button btn-primary" data-bs-toggle="modal"
                    data-bs-target="#pinjamRuangan">
                    Pinjam
                </button>
            @endif
            <div class="table-responsive">
                <div class="d-flex justify-content-start">
                    {{ $adminRents->links() }}
                </div>
                <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="datatable">
                    <thead class="table-info">
                        <tr>
                            <th scope="row">No.</th>
                            <th scope="row">Kode Ruangan</th>
                            @if (auth()->user()->role_id <= 2)
                                <th scope="row">Nama Peminjam</th>
                            @endif
                            <th scope="row">Mulai Pinjam</th>
                            <th scope="row">Selesai Pinjam</th>
                            <th scope="row">Tujuan</th>
                            <th scope="row">Waktu Transaksi</th>
                            <th scope="row">Kembalikan</th>
                            <th scope="row">Status Pinjam</th>
                            @if (auth()->user()->role_id <= 2)
                                <th scope="row">Action</th>
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($adminRents->count() > 0)
                            @foreach ($adminRents as $rent)
                                <tr>
<<<<<<< HEAD
                                    <td>{{ ($adminRents->currentPage() - 1) * $adminRents->perPage() + $loop->iteration }}</td>
                                    <td>{{ $rent->room->name }}</td>
                                    <td class="text-start">{{ $rent->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rent->time_start_use)->format('Y-m-d H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rent->time_end_use)->format('Y-m-d H:i') }}</td>
                                    <td class="text-start">{{ $rent->purpose }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rent->transaction_start)->format('Y-m-d H:i:s') }}</td>
                                    @if ($rent->status == 'dipinjam')
                                        <td>
                                            <a href="/dashboard/rents/{{ $rent->id }}/endTransaction"
                                                class="btn btn-success btn-sm"
                                                onclick="return confirm('Kembalikan ruangan ini?')">
                                                <i class="bi bi-check-lg"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            @if (!is_null($rent->transaction_end))
                                                {{ \Carbon\Carbon::parse($rent->transaction_end)->format('Y-m-d H:i:s') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        <span class="badge bg-{{ $rent->status == 'dipinjam' ? 'warning' : 'success' }}">
                                            {{ $rent->status }}
                                        </span>
                                    </td>
=======
                                    <th scope="row">{{ $loop->iteration }}</th scope="row">
                                    <td><a href="/dashboard/rooms/{{ $rent->room->code }}" class="text-decoration-none"
                                            role="button">{{ $rent->room->code }}</a></td>
                                    <td>{{ $rent->user->name }}</td>
                                    <td>{{ $rent->time_start_use }}</td>
                                    <td>{{ $rent->time_end_use }}</td>
                                    <td>{{ $rent->purpose }}</td>
                                    <td>{{ $rent->transaction_start }}</td>
                                    @if ($rent->status == 'dipinjam')
                                        <td><a href="/dashboard/rents/{{ $rent->id }}/endTransaction"
                                                class="btn btn-success" type="submit" style="padding: 2px 10px"><i
                                                    class="bi bi-check fs-5"></i></a></td>
                                    @else
                                        @if (!is_null($rent->transaction_end))
                                            <td>{{ $rent->transaction_end }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                    @endif
                                    <td>{{ $rent->status }}</td>

>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                                    @if (auth()->user()->role_id === 1)
                                        <td>
                                            <form action="/dashboard/rents/{{ $rent->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
<<<<<<< HEAD
                                                <button type="submit" class="btn btn-link p-0 text-danger border-0"
                                                    onclick="return confirm('Hapus data peminjaman?')">
                                                    <i class="bi bi-trash-fill fs-5"></i>
                                                </button>
=======
                                                <button type="submit" class="bi bi-trash-fill text-danger border-0"
                                                    onclick="return confirm('Hapus data peminjaman?')"></button>
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
<<<<<<< HEAD
                                <td colspan="10" class="text-center py-4">
                                    <em>-- Belum Ada Daftar Peminjaman --</em>
=======
                                <td colspan="10" class="text-center">
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
                {{ $adminRents->links() }}
            </div>
        </div>
    </div>
    @include('dashboard.partials.rentModal')
=======
        </div>
    </div>
    @extends('dashboard.partials.rentModal')
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
@endsection
