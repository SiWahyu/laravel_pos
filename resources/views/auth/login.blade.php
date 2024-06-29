@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-lg-6 col-md-10 col-12">
            <div id="auth-left">
                <h2 class="auth-title mb-4">Log in</h2>
                <form action="{{ route('login.authenticate') }}" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Masukan Email" id="email"
                            value="{{ old('email') }}" name="email">
                        <div class="form-control-icon">
                            <label for="email">
                                <i class="bi bi-person"></i>
                            </label>
                        </div>
                        @error('email')
                            <div class="text-danger mt-1 d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-5">
                        <input type="password" class="form-control form-control-xl" placeholder="Masukan Password"
                            id="password" name="password">
                        <div class="form-control-icon">
                            <label for="password">
                                <i class="bi bi-shield-lock"></i>
                            </label>
                        </div>
                        @error('password')
                            <div class="text-danger mt-1 d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg">Log in</button>
                </form>
                <div class="col-12 text-center mt-5">
                    <p>Belum punya akun ? <a href="{{ route('register') }}"
                            class="text-decoration-none fw-medium">Register</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
