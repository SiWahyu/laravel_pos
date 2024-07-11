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
                                                    <button class="btn btn-sm"><i class="bi bi-trash"></i></button>
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
                        <ul class="list-group">
                            @foreach ($cart->cart_items as $item)
                                <li class="list-group-item">
                                    <div>{{ $item->produk->nama }}</div>
                                    <div class="d-flex justify-content-between">
                                        <div>{{ $item->jumlah }} x {{ number_format($item->produk->harga, 0, ',', '.') }}
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
                        <form action="">
                            <button class="btn btn-primary col-12">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inputQuantity = document.getElementById('inputQuantity');
            var buttonMinus = document.getElementById('button-minus');
            var buttonPlus = document.getElementById('button-plus');

            // Event listener untuk tombol minus
            buttonMinus.addEventListener('click', function() {
                var value = parseInt(inputQuantity.value, 10);
                if (value > 0) {
                    inputQuantity.value = value - 1;
                    updateButtonState();
                }
            });

            // Event listener untuk tombol plus
            buttonPlus.addEventListener('click', function() {
                var value = parseInt(inputQuantity.value, 10);
                inputQuantity.value = value + 1;
                updateButtonState();
            });

            // Fungsi untuk memperbarui status tombol plus dan input number
            function updateButtonState() {
                var value = parseInt(inputQuantity.value, 10);

                // Menonaktifkan tombol plus jika nilai sudah lebih dari samadengan jumlah stok
                if (value >= {{ $produk->stok }}) {
                    buttonPlus.disabled = true;
                    buttonPlus.classList.add('disabled');
                    buttonPlus.classList.add('border-secondary');
                } else {
                    buttonPlus.disabled = false;
                    buttonPlus.classList.remove('disabled');
                }

                if (value <= 0) {
                    buttonMinus.disabled = true;
                    buttonMinus.classList.add('disabled');
                } else {
                    buttonMinus.disabled = false;
                    buttonMinus.classList.remove('disabled');
                }

                // Menonaktifkan tombol minus jika nilai sudah 1
                if (value === 1) {
                    buttonMinus.disabled = true;
                    buttonMinus.classList.add('disabled');
                    buttonPlus.classList.add('border-secondary');
                }

                // Mematikan inputQuantity ketika nilainya mencapai 0 atau lebih dari 10
                if (value <= 0 || value >= {{ $produk->stok }}) {
                    inputQuantity.disabled = true;
                } else {
                    inputQuantity.disabled = false;
                }
            }

            // Memanggil fungsi pertama kali untuk menginisialisasi status tombol plus dan input number
            updateButtonState();
        });
    </script> --}}

@endsection
