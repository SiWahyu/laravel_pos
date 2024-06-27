@extends('layouts.dashboard')
@section('title', 'Dashboard Produk')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Produk</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
                Data Produk
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataProduk as $produk)
                        <tr>
                            <td>{{ $produk->kode }}</td>
                            <td>{{ $produk->kategori->nama }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td><img src="{{ asset('storage/images/produk/' . $produk->gambar) }}" alt=""
                                    width="70"></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('produk.edit', $produk->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('produk.delete', $produk->id) }}" method="post"
                                        onclick="confirm('Yakin ingin menghapus {{ $produk->nama }} ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    {{-- Data table --}}
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>
@endsection
