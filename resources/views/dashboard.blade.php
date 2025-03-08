@extends('layouts.app')

@section('contents')
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded">
                <div class="card-body text-center p-5">
                    <h3 class="display-7 fw-bold">Selamat Datang, {{ Auth::user()->name }} !</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
