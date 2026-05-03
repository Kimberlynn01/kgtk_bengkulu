@extends('layouts.front')

@section('title', 'Survei Kepuasan Masyarakat')

@section('content')
    <section class="skm-wrapper py-5">
        <div class="container py-4">

            @if ($skm)
                {{-- Bagian Header Deskripsi --}}
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-3 p-4">
                            <h2 class="h5 fw-bold" style="color: var(--kemdikbud-blue)">Survey Kepuasan Masyarakat</h2>
                            <div class="skm-content-text text-muted small">
                                <p class="mb-2">{{ $skm->description }}</p>
                                <p class="mb-0">Ayo ikut serta mengisi Survey Kepuasan Masyarakat dengan mengisi tautan
                                    berikut :</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Embed Google Form Langsung Nampak --}}
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="form-container shadow-lg bg-white rounded-4 overflow-hidden">
                            <div class="google-form-wrapper">
                                <iframe src="{{ $skm->link }}" width="100%" height="800" frameborder="0"
                                    marginheight="0" marginwidth="0" style="border: none;">
                                    Memuat…
                                </iframe>
                            </div>
                        </div>

                        {{-- Navigasi Tombol Bawah sesuai Gambar --}}
                        <div class="d-flex justify-content-between mt-4">
                            <button class="btn btn-primary rounded-pill px-4 btn-sm shadow-sm">
                                <i class="fas fa-exclamation-circle me-2"></i> Lapor
                            </button>
                            <button class="btn btn-primary rounded-pill px-4 btn-sm shadow-sm">
                                <i class="fas fa-check-circle me-2"></i> Beri Kami Penilaian
                                </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="card d-inline-block p-5 border-0 shadow-sm">
                        <i class="fas fa-clipboard-list fa-3x mb-3 opacity-25"></i>
                        <h5 class="text-muted">Belum ada survei aktif saat ini.</h5>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection

@push('styles')
    <style>
        .skm-wrapper {
            background-color: #e9f4ff;
            /* Latar biru muda sesuai gambar */
            min-height: 100vh;
            position: relative;
        }

        /* Dekorasi Ikon Thumbs Up & Smile di Background */
        .skm-wrapper::before {
            content: '\f164';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: fixed;
            top: 15%;
            left: 5%;
            font-size: 12rem;
            color: rgba(255, 255, 255, 0.5);
            z-index: 0;
            transform: rotate(-15deg);
            pointer-events: none;
        }

        .skm-wrapper::after {
            content: '\f118';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: fixed;
            bottom: 15%;
            right: 5%;
            font-size: 10rem;
            color: rgba(255, 255, 255, 0.5);
            z-index: 0;
            transform: rotate(15deg);
            pointer-events: none;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .form-container {
            border: 1px solid rgba(0, 51, 102, 0.1);
        }

        .btn-primary {
            background-color: #004a99;
            border: none;
        }

        .btn-primary:hover {
            background-color: #003366;
        }
    </style>
@endpush
