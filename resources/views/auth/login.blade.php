@extends('layouts.guest')

@section('contents')
<div class="login-card">
    <form class="theme-form login-form" action="{{ route('login') }}" method="post">
        @csrf
        <h4>Masuk</h4>
        <h6>Selamat datang, masuk menggunakan akun anda.</h6>
        @if (session('message'))
        <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
        <div class="form-group">
            <label for="email">{{__('Email')}}</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" placeholder="Masukkan email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            {{-- <div class="float-right">
                <a href="auth-recoverpw-2.html" class="text-muted">Forgot
                    password?</a>
            </div> --}}
            <label for="password">{{__('Kata Sandi')}}</label>
            <div class="input-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" value="{{ old('password') }}" placeholder="Masukkan Kata Sandi">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="show"><i
                            class="icofont icofont-eye-alt"></i></button>
                </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Sign in</button>
        </div>
    </form>
</div>
@endsection