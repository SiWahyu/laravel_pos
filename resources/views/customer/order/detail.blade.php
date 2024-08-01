@extends('layouts.main')
@section('title', 'Order')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Order Detail</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Order</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card col-12 col-md-10 col-lg-9">
        <div class="card-header">
            <div>
                <h4 class="card-title ">
                    @if ($order->status == 'Paid')
                        {{ 'Pembayaran berhasil ' }} <i class="bi bi-check-circle text-primary-emphasis ms-1"></i>
                    @elseif ($order->status == 'Pending')
                        {{ 'Tunjukan pesanan ke kasir ' }}<i class="bi bi-clock-history text-info-emphasis ms-1"></i>
                    @elseif ($order->status == 'Stock Insufficient')
                        {{ 'Stok produk tidak cukup ' }}<i class="bi bi-info-circle text-secondary-emphasis ms-1"></i>
                    @else
                        {{ 'Pesanan terjadi kesalahan' }}<i class="bi bi-x-circle text-danger-emphasis ms-1"></i>
                    @endif
                </h4>
                @if ($order->status == 'Failed')
                    <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                        <i class="bi bi-info-circle me-1"></i> Info
                    </button>
                @elseif($order->status == 'Stock Insufficient')
                    <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                        <i class="bi bi-info-circle me-1"></i> Info
                    </button>
                @endif
                <div class="collapse mt-2" id="collapseExample" style="">
                    <ul class="list-group">
                        @if ($order->status == 'Failed')
                            <li class="list-group-item d-flex justify-content-start align-items-center">
                                <span class="me-2"> 1. </span>
                                <span> Coba untuk membuat ulang pesanan.</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-start align-items-center">
                                <span class="me-2"> 2. </span>
                                <span> Jika masih gagal, coba beritahu kepada kasir bahwa pesanan kamu gagal.</span>
                            </li>
                        @elseif('Stock Insufficient')
                            <li class="list-group-item d-flex justify-content-start align-items-center">
                                <span class="me-2"> 1. </span>
                                <span> Tanyakan kepada kasir apakah stok produk benar-benar habis.</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-start align-items-center">
                                <span class="me-2"> 2. </span>
                                <span> Jika stok produk habis, anda bisa membatalkan pesanan atau kembali besok hingga
                                    stok
                                    produk tersedia</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-start align-items-center">
                                <span class="me-2"> 3. </span>
                                <span> Buat pesanan ulang dengan jumlah stok produk yang tersedia.</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div id="detail">
                        <div>Kode : <b>{{ $order->kode }}</b></div>
                        <div>Tanggal : <b>{{ $order->created_at->translatedFormat('l, j F Y') }}</b></div>
                        <div>Pembayaran : <b>{{ $order->pembayaran }}</b></div>
                        <div>Status :
                            @if ($order->status == 'Paid')
                                <span class="badge bg-primary">{{ $order->status }}</span>
                            @elseif ($order->status == 'Pending')
                                <span class="badge bg-success">{{ $order->status }}</span>
                            @elseif ($order->status == 'Stock Insufficient')
                                <span class="badge bg-secondary">{{ $order->status }}</span>
                            @else
                                <span class="badge bg-danger">{{ $order->status }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-white p-2">
                            {!! QrCode::size(100)->generate($order->kode) !!}
                        </div>
                    </div>
                </div>
                <hr>
                <ul class="list-group">
                    @foreach ($order->order_items as $item)
                        <li class="list-group-item">
                            <div>{{ $item->produk->nama }}</div>
                            <div class="d-flex justify-content-between">
                                <div>{{ $item->jumlah }} x
                                    {{ number_format($item->produk->harga, 0, ',', '.') }}
                                </div>
                                <div class="text-danger">
                                    Rp
                                    {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <hr>
                <ul class="list-group mb-4">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div class="fw-bolder">Totol Harga</div>
                            <div class="fw-bolder text-danger">RP
                                {{ number_format($order->total, 0, ',', '.') }}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
