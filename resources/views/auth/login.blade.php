@extends('layouts.guest')

@section('contents')
    <div class="login-card">
        <form class="theme-form login-form" action="{{ route('login') }}" method="post">
            @csrf
            <h4 class="text-center">Masuk</h4>
            <h6 class="text-center text-muted">Selamat datang, masuk menggunakan akun Anda.</h6>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
            @endif

            <div class="form-group mt-3">
                <label for="login">{{ __('Username atau Email') }}</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="login"
                    name="username" value="{{ old('username') }}" placeholder="Masukkan username atau email" autofocus>

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password">{{ __('Kata Sandi') }}</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Masukkan Kata Sandi">
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
                <div class="mt-3">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa password?</a>
                </div>
            </div>

            <div class="form-group mt-4">
                <button
                    class="btn btn-primary w-100 mb-3 d-flex align-items-center justify-content-center position-relative py-2"
                    type="submit">Masuk</button>
            </div>

            <div class="text-center mt-3">
                <a href=""
                    class="btn btn-primary w-100 mb-3 d-flex align-items-center justify-content-center position-relative py-2">
                    <div class="bg-white p-2 d-flex rounded position-absolute top-2" style="left: 4px;">
                        <img src="{{ asset('assets/images/google-logo.png') }}" alt="google-logo" width="16">
                        {{-- <img src="https://kurikulum.gtk.kemdikbud.go.id/assets_login/img/google-logo.png"
                            alt="google-logo" width="16"> --}}
                    </div>
                    <span class="fw-semibold">
                        Masuk dengan Google
                    </span>
                </a>
            </div>
            <p>Belum memiliki akun?<a class="ms-2" href="{{ route('register') }}">Buat Akun</a></p>
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
        });
    </script>
@endsection
