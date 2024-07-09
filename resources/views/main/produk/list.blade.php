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
        <div
            class="row gx-2 gx-sm-3 gx-md-4 gx-lg-4 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 justify-content-start">
            @foreach ($dataProduk as $produk)
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm">
                        {{-- Status Product --}}
                        @if ($produk->stok <= 0)
                            <div class="badge bg-danger text-white position-absolute" style="top: 0.3rem; right: 0.3rem">
                                Habis
                            </div>
                        @else
                            <div class="badge bg-primary text-white position-absolute" style="top: 0.3rem; right: 0.3rem">
                                Tersedia
                            </div>
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