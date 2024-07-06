@extends('layouts.dashboard')
@section('title', 'Dashboard Edit Karyawan')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Karyawan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('karyawan.data') }}">Karayawan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('karyawan.update', $karyawan->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Karyawan"
                                name="nama" value="{{ old('nama') ?? $karyawan->nama }}">
                            @error('nama')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="telepon">Telepon</label>
                            <input type="number" class="form-control" id="telepon" placeholder="Telepon Karyawan"
                                name="telepon" value="{{ old('telepon') ?? $karyawan->telepon }}">
                            @error('telepon')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email Karyawan"
                                name="email" value="{{ old('email') ?? $karyawan->user->email }}">
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group mb-3">
                            <label for="posisi">Posisi</label>
                            <select class="form-select" id="posisi" name="posisi">
                                @foreach ($dataPosisi as $posisi)
                                    <option {{ (old('posisi') ?? $karyawan->posisi) == $posisi->name ? 'selected' : '' }}
                                        value="{{ $posisi->name }}">
                                        {{ $posisi->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('posisi')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <button class="btn btn-primary col-12 col-md-3 text-center">Save</button>
            </form>
        </div>
    </div>
@endsection
