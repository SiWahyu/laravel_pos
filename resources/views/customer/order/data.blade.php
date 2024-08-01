@extends('layouts.main')
@section('title', 'Order')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Order</h3>
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
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">List Order</h5>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab"
                        aria-controls="pending" aria-selected="true">Pending</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="paid-tab" data-bs-toggle="tab" href="#paid" role="tab"
                        aria-controls="paid" aria-selected="false" tabindex="-1">Paid</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="failed-tab" data-bs-toggle="tab" href="#failed" role="tab"
                        aria-controls="failed" aria-selected="false" tabindex="-1">Failed</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="stock_insufficient-tab" data-bs-toggle="tab" href="#stock_insufficient"
                        role="tab" aria-controls="stock_insufficient" aria-selected="false" tabindex="-1">Stock
                        Insufficient</a>
                </li>
            </ul>
            <div class="tab-content my-3" id="myTabContent">
                <div class="tab-pane fade active show" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Pembayaran</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderData->filter(function ($order) {
            return $order->status == 'Pending';
        }) as $order)
                                    <tr>
                                        <td>{{ $order->kode }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $order->status }}</span>
                                        </td>
                                        <td>{{ $order->pembayaran }}</td>
                                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td>{{ $order->created_at->translatedFormat('l, j F Y') }}</td>
                                        <td>
                                            <a href="{{ route('customer.order.detail', $order->kode) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Status</th>
                                <th scope="col">Pembayaran</th>
                                <th scope="col">Total</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderData->filter(function ($order) {
            return $order->status == 'Paid';
        }) as $order)
                                <tr>
                                    <td>{{ $order->kode }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $order->status }}</span>
                                    </td>
                                    <td>{{ $order->pembayaran }}</td>
                                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td>{{ $order->created_at->translatedFormat('l, j F Y') }}</td>
                                    <td>
                                        <a href="{{ route('customer.order.detail', $order->kode) }}"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="failed" role="tabpanel" aria-labelledby="failed-tab">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Status</th>
                                <th scope="col">Pembayaran</th>
                                <th scope="col">Total</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderData->filter(function ($order) {
            return $order->status == 'Failed';
        }) as $order)
                                <tr>
                                    <td>{{ $order->kode }}</td>
                                    <td>
                                        <span class="badge bg-danger">{{ $order->status }}</span>
                                    </td>
                                    <td>{{ $order->pembayaran }}</td>
                                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td>{{ $order->created_at->translatedFormat('l, j F Y') }}</td>
                                    <td>
                                        <a href="{{ route('customer.order.detail', $order->kode) }}"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="stock_insufficient" role="tabpanel"
                    aria-labelledby="stock_insufficient-tab">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Status</th>
                                <th scope="col">Pembayaran</th>
                                <th scope="col">Total</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderData->filter(function ($order) {
            return $order->status == 'Stock Insufficient';
        }) as $order)
                                <tr>
                                    <td>{{ $order->kode }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $order->status }}</span>
                                    </td>
                                    <td>{{ $order->pembayaran }}</td>
                                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td>{{ $order->created_at->translatedFormat('l, j F Y') }}</td>
                                    <td>
                                        <a href="{{ route('customer.order.detail', $order->kode) }}"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
