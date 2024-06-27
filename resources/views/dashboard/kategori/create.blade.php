@extends('layouts.dashboard')
@section('title', 'Dashboard Tambah Kategori')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kategori</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kategori.data') }}">Kategori</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tambah</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('kategori.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Kategori"
                                name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary col-12 col-md-3 text-center">Submit</button>
            </form>
        </div>
    </div>
@endsection
