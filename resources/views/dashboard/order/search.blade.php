@extends('layouts.dashboard')
@section('title', 'Dashboard Search Order')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Order</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Search Order
            </h5>
        </div>
        <div class="card-body">
            <form action="" method="get">
                <div class="d-flex justify-content-start gap-3 flex-wrap">
                    <div class="form-group col-10 col-md-6 col-lg-6">
                        <input type="text" class="form-control" id="nama" placeholder="Masukan kode order"
                            name="kode" value="{{ request('kode') }}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
            @if (request('kode'))
                @if ($order)
                    <hr>
                    <div class="col-12 col-md-6 col-lg-6">
                        <ul class="list-group">
                            <li class="list-group-item">
                                @if ($order->status == 'Paid')
                                    <div>Status : <span class="badge bg-primary">{{ $order->status }}</span></div>
                                @elseif($order->status == 'Pending')
                                    <div>Status : <span class="badge bg-success">{{ $order->status }}</span></div>
                                @elseif($order->status == 'Stock Insufficient')
                                    <div>Status : <span class="badge bg-secondary">{{ $order->status }}</span></div>
                                @else
                                    <div>Status : <span class="badge bg-danger">{{ $order->status }}</span></div>
                                @endif
                            </li>
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
                        <form action="{{ route('order.checkout-tunai', $order->id) }}" method="post">
                            @csrf
                            @if ($order->status == 'Pending')
                                <button type="submit" class="btn btn-primary col-12">Konfirmasi Pembayaran</button>
                            @elseif ($order->status == 'Paid')
                                <button type="button" class="btn btn-primary col-12" disabled>Sudah dibayar</button>
                            @elseif ($order->status == 'Stock Insufficient')
                                <button type="submit" class="btn btn-secondary col-12">Stok tidak cukup</button>
                            @else
                                <button type="button" class="btn btn-danger col-12" disabled>Terjadi kesalahan</button>
                            @endif
                        </form>
                    </div>
                @else
                    <hr>
                    <div class="text-center fw-light">Order tidak ditemukan</div>
                @endif
            @endif
        </div>
    </div>
@endsection
