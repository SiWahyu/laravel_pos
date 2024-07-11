@extends('layouts.main')
@section('title', 'Detail Produk')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Produk</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row gx-4 gx-lg-5 align-items-md-center">
        <div class="col-sm-10 col-md-6 col-lg-5"><img class="card-img-top mb-5 mb-md-0"
                src="{{ asset('storage/images/produk/' . $produk->gambar) }}" alt="{{ $produk->nama }}" width="600px">
        </div>
        <div class="col-md-6">
            <form action="{{ route('cart.store', $produk->id) }}" method="post">
                @csrf
                <span class="h2 fw-bolder">{{ $produk->nama }}</span>
                <div class="mb-3 mt-3">
                    <div> <b>Harga : </b> Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                    <div><b>Kategori : </b> {{ $produk->kategori->nama }}</div>
                    <div><b>Stok : </b>{{ $produk->stok }}</div>
                    <div><b>Terjual : </b>10</div>

                </div>
                <div class="col-5 col-sm-3 col-md-4 col-lg-3 col-xl-4">
                    <div class="mb-2">
                        <b>Jumlah</b>
                    </div>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" id="button-minus">-</button>
                        <input type="text" class="form-control form-control-sm text-center border-secondary"
                            id="jumlaItem" value="1" min="0" name="jumlah_item">
                        <input type="hidden" name="jumlah_item" id="jumlahItemHidden">
                        <button class="btn btn-outline-secondary" type="button" id="button-plus">+</button>
                    </div>
                </div>
                @error('jumlah_item')
                    <div class="text-danger mt-1 d-inline">
                        {{ $message }}
                    </div>
                @enderror
                @error('jumlah_item_cart')
                    <div class="text-danger mt-1 d-inline">
                        {{ $message }}
                    </div>
                @enderror
                <div class="col-5 col-sm-3 col-md-4 col-lg-3 col-xl-4 mt-4">
                    <button class="btn btn-danger col-12" type="submit">
                        Beli Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let jumlaItem = document.getElementById('jumlaItem');
            let buttonMinus = document.getElementById('button-minus');
            let buttonPlus = document.getElementById('button-plus');
            let jumlahItemHidden = document.getElementById('jumlahItemHidden');

            // Event listener untuk tombol minus
            buttonMinus.addEventListener('click', function() {
                let value = parseInt(jumlaItem.value, 10);
                if (value > 0) {
                    jumlaItem.value = value - 1;
                    updateButtonState();
                }
            });

            // Event listener untuk tombol plus
            buttonPlus.addEventListener('click', function() {
                let value = parseInt(jumlaItem.value, 10);
                jumlaItem.value = value + 1;
                updateButtonState();
            });

            // Fungsi untuk memperbarui status tombol plus dan input number
            function updateButtonState() {
                let value = parseInt(jumlaItem.value, 10);

                // Menonaktifkan tombol plus jika nilai sudah lebih dari samadengan jumlah stok
                if (value >= {{ $produk->stok }}) {
                    buttonPlus.disabled = true;
                    buttonPlus.classList.add('disabled');
                    buttonPlus.classList.add('border-secondary');
                    jumlahItemHidden.value = value
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

                // Mematikan jumlaItem ketika nilainya mencapai 0 atau lebih dari 10
                if (value <= 0 || value >= {{ $produk->stok }}) {
                    jumlaItem.disabled = true;
                    jumlahItemHidden.disabled = false
                } else {
                    jumlaItem.disabled = false;
                    jumlahItemHidden.disabled = true
                }
            }

            // Memanggil fungsi pertama kali untuk menginisialisasi status tombol plus dan input number
            updateButtonState();
        });
    </script>

@endsection
