@extends('dashboard.layouts.main')

@section('container')
    <div class="col-md-10 p-0">
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
                    {{ session('rentSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('deleteRent'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('deleteRent') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($adminRents->count() > 0)
                            @foreach ($adminRents as $rent)
                                <tr>
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
                                    @if (auth()->user()->role_id === 1)
                                        <td>
                                            <form action="/dashboard/rents/{{ $rent->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-link p-0 text-danger border-0"
                                                    onclick="return confirm('Hapus data peminjaman?')">
                                                    <i class="bi bi-trash-fill fs-5"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center py-4">
                                    <em>-- Belum Ada Daftar Peminjaman --</em>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $adminRents->links() }}
            </div>
        </div>
    </div>
    @include('dashboard.partials.rentModal')
@endsection
