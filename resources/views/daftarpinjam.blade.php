@extends('layouts.main')

@section('container')
    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="blog" class="blog-area pt-170 pb-140">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">Daftar Peminjaman</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-10 p-0">
                    <div class="card-body text-end">
                        @if (session()->has('rentSuccess'))
                            <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
                                style="margin-top: 50px" role="alert">
                                {{ session('rentSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
                                style="margin-top: 50px" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="col-md-16 mx-auto alert alert-danger text-center alert-dismissible fade show"
                                style="margin-top: 50px" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-responsive justify-content-center">
                            <div class="d-flex justify-content-end">
                                {{ $userRents->links() }}
                            </div>

                            <table class="fl-table">
                                <thead>
                                    <tr>
                                        <th scope="row">No.</th>
                                        <th scope="row">Kode Ruangan</th>
                                        <th scope="row">Nama Peminjam</th>
                                        <th scope="row">Mulai Pinjam</th>
                                        <th scope="row">Selesai Pinjam</th>
                                        <th scope="row">Tujuan</th>
                                        <th scope="row">Waktu Permintaan</th>
                                        <th scope="row">Waktu Direspon</th>
                                        <th scope="row">Status Pinjam</th>
                                        <th scope="row">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($userRents->count() > 0)
                                        @foreach ($userRents as $rent)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th scope="row">
                                                <td><a href="/showruang/{{ $rent->room->code }}"
                                                        class="text-decoration-none"
                                                        role="button">{{ $rent->room->code }}</a>
                                                </td>
                                                @if (auth()->user()->role_id <= 2)
                                                    <td>{{ $rent->user->name }}</td>
                                                @endif
                                                <td>{{ $rent->time_start_use }}</td>
                                                <td>{{ $rent->time_end_use }}</td>
                                                <td>{{ $rent->purpose }}</td>
                                                <td>{{ $rent->transaction_start }}</td>
                                                <td>
                                                    @if (!is_null($rent->transaction_end))
                                                        {{ $rent->transaction_end }}
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($rent->status == 'pending')
                                                        <span class="badge bg-warning text-dark">{{ $rent->status }}</span>
                                                    @elseif($rent->status == 'dipinjam')
                                                        <span class="badge bg-primary">{{ $rent->status }}</span>
                                                    @elseif($rent->status == 'ditolak')
                                                        <span class="badge bg-danger">{{ $rent->status }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $rent->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($rent->status == 'pending')
                                                        <form action="/dashboard/rents/{{ $rent->id }}/cancel" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                                onclick="return confirm('Tarik permintaan peminjaman ini?')" 
                                                                title="Tarik Permintaan">
                                                                <i class="bi bi-x-circle"></i> Tarik
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                -- Belum Ada Peminjaman --
                                            </td>
                                        </tr>
                                    @endif
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
