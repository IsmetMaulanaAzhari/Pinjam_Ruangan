@extends('layouts.main')

@section('container')
    <!--====== Daftar Ruang ======-->
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
            <div class="row mb-4">
                <div class="col-md-12">
                    <form action="{{ route('daftarruang') }}" method="GET" class="d-flex align-items-center">
                        <div class="form-group me-3">
                            <label for="building_id" class="form-label">Gedung</label>
                            <select class="form-select" name="building_id" id="building_id">
                                <option value="">Semua Gedung</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}" {{ request('building_id') == $building->id ? 'selected' : '' }}>
                                        {{ $building->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group me-3">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="date" id="date" value="{{ request('date') }}">
                        </div>
                        <div class="form-group me-3">
                            <label for="time" class="form-label">Waktu</label>
                            <input type="time" class="form-control" name="time" id="time" value="{{ request('time') }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-4">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-7">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">Daftar Ruangan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($rooms as $room)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="/showruang/{{ $room->code }}">
                                    @if ($room->img && Storage::exists('public/' . $room->img))
                                        <img src="{{ asset('storage/' . $room->img) }}" alt="">
                                    @else
                                        @if ($room->img)
                                            <img src="{{ $room->img }}" alt="FotoRuang">
                                        @endif
                                    @endif
                                </a>
                            </div>
                            <div class="blog-content">
                                <h4><a href="/showruang/{{ $room->code }}">{{ $room->name }}</a></h4>
                                <p>Gedung : {{ $room->building->name }}</p>
                                <p>Kapasitas : {{ $room->capacity }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-end">
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection