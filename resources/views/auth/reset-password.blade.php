@extends('layouts.guest')

@section('contents')
    <div class="login-card shadow-lg p-4 rounded bg-white" style="width: 400px;">
        <form class="theme-form login-form" action="{{ route('password.store') }}" method="POST">
            @csrf
            <h4 class="text-center">Reset Password</h4>
            <h6 class="text-center text-muted">Masukkan password baru untuk akun Anda.</h6>

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

            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <div class="form-group mt-3">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ request()->email }}" required readonly>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password">{{ __('Password Baru') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Masukkan password baru" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password_confirmation">{{ __('Konfirmasi Password') }}</label>
                <input type="password" class="form-control" id="password_confirmation"
                    name="password_confirmation" placeholder="Masukkan kembali password baru" required>
            </div>

            <div class="form-group mt-4">
                <button class="btn btn-primary w-100 mb-3 d-flex align-items-center justify-content-center position-relative py-2" type="submit">
                    Reset Password
                </button>
            </div>

            {{-- <p><a class="ms-2" href="{{ route('login') }}">Kembali ke halaman Login</a></p> --}}
        </form>
    </div>
@endsection
