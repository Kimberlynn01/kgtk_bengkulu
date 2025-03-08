@extends('layouts.guest')

@section('contents')
    <div class="login-card shadow-lg p-4 rounded bg-white" style="width: 400px;">
        <form class="theme-form login-form" action="{{ route('password.email') }}" method="POST">
            @csrf
            <h4 class="text-center">Lupa Password</h4>
            <h6 class="text-center text-muted">Masukkan email Anda untuk mendapatkan tautan reset password.</h6>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group mt-3">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-4">
                <button class="btn btn-primary w-100 mb-3 d-flex align-items-center justify-content-center position-relative py-2" type="submit">
                    Kirim Link Reset Password
                </button>
            </div>

            <p><a class="ms-2" href="{{ route('login') }}">Kembali ke halaman Login</a></p>
        </form>
    </div>
@endsection
