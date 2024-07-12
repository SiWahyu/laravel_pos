@extends('layouts.main')
@section('title', 'Daftar Produk')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Produk</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="mt-4">
        <form action="" method="get">
            <div class="d-flex justify-content-start mb-3 gap-3">
                <div class="form-group">
                    <select class="form-select" id="basicSelect" name="kategori">
                        <option {{ request('kategori') ? '' : 'selected' }} value="">Kategori</option>
                        @foreach ($dataKategori as $kategori)
                            <option {{ request('kategori') == $kategori->nama ? 'selected' : '' }}
                                value="{{ $kategori->nama }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="nama" placeholder="Nama Produk" name="nama"
                        value="{{ request('nama') }}">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
        @if ($dataProduk->isEmpty())
            <h4 class="text-center fw-light">Data Kosong</h4>
        @endif
        <div
            class="row gx-2 gx-sm-3 gx-md-4 gx-lg-4 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 justify-content-start">
            @foreach ($dataProduk as $produk)
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm">
                        {{-- Status Product --}}
                        @if ($produk->stok <= 0)
                            <span class="badge bg-danger text-white position-absolute" style="top: 0.3rem; right: 0.3rem">
                                Habis
                            </span>
                        @else
                            <span class="badge bg-primary text-white position-absolute" style="top: 0.3rem; right: 0.3rem">
                                Tersedia
                            </span>
                        @endif
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ asset('storage/images/produk/' . $produk->gambar) }}"
                            alt="{{ $produk->nama }}" />
                        <!-- Product details-->
                        <div class="card-body px-4 pb-0">
                            <div class="text-start">
                                <!-- Product name-->
                                <h5>{{ $produk->nama }}</h5>
                                <!-- Product detail-->
                                <div>{{ $produk->kategori->nama }}</div>
                                <div>Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer border-top-0 bg-transparent pt-0">
                            <div class="text-center"><a
                                    class="btn btn-primary col-12 {{ $produk->stok <= 0 ? 'disabled ' : '' }}"
                                    href="{{ route('main.produk-detail', $produk->id) }}">Detail</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
