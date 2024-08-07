@extends('layouts.dashboard')
@section('title', 'Dashboard Kategori')
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kategori</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori</li>
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
                Data Kategori
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        @if (auth()->user()->hasRole('Admin|Gudang'))
                            <th class="text-center">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataKategori as $kategori)
                        <tr>
                            <td>{{ $kategori->nama }}</td>
                            @if (auth()->user()->hasRole('Admin|Gudang'))
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('kategori.delete', $kategori->id) }}" method="post"
                                            onclick="confirm('Yakin ingin menghapus {{ $kategori->nama }} ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
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
