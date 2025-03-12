@extends('layouts.guest')

@push('styles')
    <style>
        .logout-link {
            all: unset;
            /* Menghapus semua gaya tombol */
            color: #0d6efd;
            /* Warna biru seperti link */
            text-decoration: underline;
            /* Garis bawah seperti link */
            cursor: pointer;
            /* Menjadikan kursor seperti link */
        }

        .logout-link:hover {
            color: #0a58ca;
            /* Efek hover seperti link */
        }
    </style>
@endpush

@section('contents')
    <div class="login-card">
        <form action="{{ route('select-role') }}" method="post" class="theme-form login-form">
            @csrf

            <h4>Pilih Otoritas</h4>
            <h6>Anda terdaftar memiliki lebih dari 1 hak akses disistem. Pilih salah satu untuk melanjutkan.</h6>
            @if (session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
            @endif
            <div class="form-group">
                <label for="role_id">{{ __('Otoritas') }}</label>
                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror" required
                    autofocus>
                    <option value="" selected disabled>{{ __('Pilih Otoritas') }}</option>
                    @foreach ($user->roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Lanjut</button>
            </div>
            <p class="text-center mt-3">
                Bukan Anda?
                <a href="#" class="logout-link ms-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Kembali Login
                </a>
            </p>
        </form>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </div>
@endsection
