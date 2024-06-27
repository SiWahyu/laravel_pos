@extends('layouts.dashboard')
@section('title', 'Dashboard Edit Produk')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Produk</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('produk.data') }}">Produk</a></li>
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
            <form action="{{ route('produk.update', $produk->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control" id="kode" placeholder="Kode Produk"
                                name="kode" value="{{ old('kode') ?? $produk->kode }}">
                            @error('kode')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Produk"
                                name="nama" value="{{ old('nama') ?? $produk->nama }}">
                            @error('nama')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <fieldset class="form-group mb-3">
                            <label for="kategori_id">Kategori</label>
                            <select class="form-select" id="kategori_id" name="kategori_id">
                                @foreach ($dataKategori as $kategori)
                                    <option
                                        {{ (old('kategori_id') ?? $produk->kategori_id) == $kategori->id ? 'selected' : '' }}
                                        value="{{ $kategori->id }}">
                                        {{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" placeholder="Harga Produk"
                                name="harga" value="{{ old('harga') ?? $produk->harga }}">
                            @error('harga')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control" id="stok" placeholder="Stok Produk"
                                name="stok" value="{{ old('stok') ?? $produk->stok }}">
                            @error('stok')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 row align-items-center">
                            <div class="col mb-2">
                                <label for="gambar"><img src="{{ asset('storage/images/produk/' . $produk->gambar) }}"
                                        width="70" alt=""></label>
                            </div>
                            <div class="col-12">
                                <div>
                                    <input class="form-control form-control-sm" type="file" id="gambar"
                                        name="gambar">
                                    @error('gambar')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary col-12 col-md-3 text-center">Update</button>
            </form>
        </div>
    </div>
@endsection
