@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-lg-6 col-md-10 col-12">
            <div id="auth-left">
                <h1 class="auth-title mb-4">Register</h1>
                <form action="{{ route('register.register-user') }}" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Masukan Nama" id="username"
                            value="{{ old('username') }}" name="username">
                        <div class="form-control-icon">
                            <label for="username">
                                <i class="bi bi-person-dash"></i>
                            </label>
                        </div>
                        @error('username')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Masukan Email"
                            id="email" value="{{ old('email') }}" name="email">
                        <div class="form-control-icon">
                            <label for="email">
                                <i class="bi bi-person"></i>
                            </label>
                        </div>
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Masukan Password"
                            id="password" name="password">
                        <div class="form-control-icon">
                            <label for="password">
                                <i class="bi bi-shield-lock"></i>
                            </label>
                        </div>
                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Confirm Password"
                            id="password_confirmation" name="password_confirmation">
                        <div class="form-control-icon">
                            <label for="password_confirmation">
                                <i class="bi bi-shield-check"></i>
                            </label>
                        </div>
                        @error('password_confirmation')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Register</button>
                </form>
                <div class="col-12 text-center mt-5">
                    <p>Sudah punya akun ? <a href="{{ route('login') }}" class="text-decoration-none fw-medium">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
