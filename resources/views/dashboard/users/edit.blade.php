@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-5">
    <h3>Edit Data Mahasiswa</h3>
    <form action="{{ url('dashboard/users/' . $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input 
                type="text" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                id="name" 
                value="{{ old('name', $user->name) }}" 
                required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nomor_induk" class="form-label">Nomor Induk</label>
            <input 
                type="text" 
                name="nomor_induk" 
                class="form-control @error('nomor_induk') is-invalid @enderror" 
                id="nomor_induk" 
                value="{{ old('nomor_induk', $user->nomor_induk) }}" 
                required>
            @error('nomor_induk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                id="email" 
                value="{{ old('email', $user->email) }}" 
                required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ url('/dashboard/users') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
