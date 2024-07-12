@extends('layouts.main')
@section('title', 'Cart')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Cart</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row g-lg-3">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Produk</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0 text-start">
                                <thead>
                                    <tr>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart->cart_items as $item)
                                        <tr class="border-bottom">
                                            <td><img src="{{ asset('storage/images/produk/' . $item->produk->gambar) }}"
                                                    alt="" width="80"></td>
                                            <td>Sprite</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td> Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <form action="{{ route('cart.delete-item', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm"><i class="bi bi-trash"></i></button>
                                                    </form>
                                                    <button class="btn btn-sm"><i class="bi bi-pencil"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Total</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <hr>
                        @if (!$cart->cart_items->isEmpty())
                            <ul class="list-group">
                                @foreach ($cart->cart_items as $item)
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
                                            {{ number_format($totalHarga, 0, ',', '.') }}</div>
                                    </div>
                                </li>
                            </ul>
                            <button class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#checkout"
                                data-bs-backdrop="false" type="button">Checkout</button>
                            <div class="modal fade text-left modal-borderless" id="checkout" tabindex="-1"
                                aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true"
                                data-bs-backdrop="false">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Pilih Pembayaran</h5>
                                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18">
                                                    </line>
                                                    <line x1="6" y1="6" x2="18" y2="18">
                                                    </line>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="{{ route('order.checkout') }}">
                                                <div class="alert border border-primary text-center fw-bolder">
                                                    Tunai
                                                </div>
                                            </a>
                                            <a href="">
                                                <div class="alert border border-primary text-center fw-bolder">
                                                    Non Tunai
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
