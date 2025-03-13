@extends('layouts.guest')

@section('contents')
    <div class="login-card">
        <form class="theme-form login-form" action="{{ route('register') }}" method="post">
            @csrf
            <h4 class="text-center">Daftar</h4>
            <h6 class="text-center text-muted">Silakan buat akun baru Anda.</h6>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if (session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
            @endif

            <div class="form-group mt-3">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" placeholder="Masukkan nama lengkap" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="username">Nama Pengguna</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" value="{{ old('username') }}" placeholder="Masukkan nama pengguna">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" placeholder="Masukkan email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password">Kata Sandi</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Masukkan kata sandi">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-primary" id="showPassword">
                            <i class="icofont icofont-eye-alt"></i>
                        </button>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Masukkan kembali kata sandi">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-primary" id="showPasswordConfirmation">
                            <i class="icofont icofont-eye-alt"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button class="btn btn-primary w-100 py-2" type="submit">Daftar</button>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('google.login') }}"
                    class="btn btn-primary w-100 mb-3 d-flex align-items-center justify-content-center position-relative py-2">
                    <div class="bg-white p-2 d-flex rounded position-absolute top-2" style="left: 4px;">
                        <img src="{{ asset('assets/images/google-logo.png') }}" alt="google-logo" width="16">
                    </div>
                    <span class="fw-semibold">
                        Lanjutkan dengan Google
                    </span>
                </a>
            </div>

            <p class="text-center mt-3">Sudah memiliki akun?<a class="ms-2" href="{{ route('login') }}">Masuk</a></p>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(() => {
            $("#showPassword").click(function() {
                var passwordField = $("#password");
                var icon = $(this).find("i");

                if (passwordField.attr("type") === "password") {
                    passwordField.attr("type", "text");
                    icon.removeClass("icofont-eye-alt").addClass("icofont-eye-blocked");
                } else {
                    passwordField.attr("type", "password");
                    icon.removeClass("icofont-eye-blocked").addClass("icofont-eye-alt");
                }
            });
            $("#showPasswordConfirmation").click(function() {
                var passwordField = $("#password_confirmation");
                var icon = $(this).find("i");

                if (passwordField.attr("type") === "password") {
                    passwordField.attr("type", "text");
                    icon.removeClass("icofont-eye-alt").addClass("icofont-eye-blocked");
                } else {
                    passwordField.attr("type", "password");
                    icon.removeClass("icofont-eye-blocked").addClass("icofont-eye-alt");
                }
            });
        });
    </script>
@endsection
