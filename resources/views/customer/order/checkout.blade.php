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
    <div class="d-flex">
        <div class="card col-12 col-md-10 col-lg-9">
            <div class="card-header">
                <h4 class="card-title">Tunjukan Pembayaran ini ke Kasir</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div id="detail">
                        <div>Kode : <b>P00012</b></div>
                        <div>Tanggal : <b>12 Juni 2024</b></div>
                        <div>Pembayaran : <b>Tunai</b></div>
                        <div>Status : <span class="badge bg-success">Pending</span></div>
                    </div>
                    <hr>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div>Sprite</div>
                            <div class="d-flex justify-content-between">
                                <div>5 x
                                    {{ number_format(5000, 0, ',', '.') }}
                                </div>
                                <div class="text-danger">
                                    Rp
                                    {{ number_format(5000 * 5, 0, ',', '.') }}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div>Chitato</div>
                            <div class="d-flex justify-content-between">
                                <div>5 x
                                    {{ number_format(10000, 0, ',', '.') }}
                                </div>
                                <div class="text-danger">
                                    Rp
                                    {{ number_format(10000 * 5, 0, ',', '.') }}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <hr>
                    <ul class="list-group mb-4">
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div class="fw-bolder">Totol Harga</div>
                                <div class="fw-bolder text-danger">RP
                                    {{ number_format(25000, 0, ',', '.') }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
