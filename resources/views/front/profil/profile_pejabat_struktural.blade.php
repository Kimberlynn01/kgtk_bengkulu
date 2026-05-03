@extends('layouts.front')

@section('title', 'Profil Pejabat Struktural')

@section('page_hero')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a>
            </li>
            <li class="breadcrumb-item">Profil</li>
            <li class="breadcrumb-item active" aria-current="page">Pejabat Struktural</li>
        </ol>
    </nav>
    <h1>Profil Pejabat Struktural</h1>
    <p class="mb-0 opacity-75 small">Unsur pimpinan dan pejabat fungsional di lingkungan KGTK Bengkulu.</p>
@endsection

@section('content')
    <section class="py-5 bg-white">
        <div class="container">

            @forelse($profilPejabat as $item)
                {{-- Setiap kelompok jabatan ditampilkan satu per satu secara vertikal --}}
                <div class="group-pejabat mb-5">
                    <div class="text-center mb-5">
                        <span class="section-label">Struktur Organisasi</span>
                        <h2 class="fw-bold mt-2 text-dark">{{ $item->title }}</h2>
                        <div class="mx-auto mt-2" style="width: 50px; height: 3px; background: var(--kemdikbud-accent)">
                        </div>
                    </div>

                    {{-- Baris Horizontal untuk Foto Pejabat --}}
                    <div class="row g-4 justify-content-center">
                        @foreach ($item->images as $img)
                            {{-- Col menentukan berapa banyak foto yang berjajar ke samping (Horizontal) --}}
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="pejabat-card-v2">
                                    <div class="pejabat-photo shadow-sm">
                                        <img src="{{ asset('storage/' . $img->image) }}" alt="Foto Pejabat"
                                            class="img-fluid">
                                    </div>
                                    <div class="pejabat-decorator">
                                        <div class="line-gold"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if (!$loop->last)
                    <hr class="my-5 opacity-5">
                @endif

            @empty
                <div class="text-center py-5">
                    <h5 class="text-muted">Data pejabat belum tersedia.</h5>
                </div>
            @endforelse

        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Container kartu pejabat */
        .pejabat-card-v2 {
            text-align: center;
            transition: transform 0.3s ease;
        }

        .pejabat-card-v2:hover {
            transform: translateY(-8px);
        }

        /* Frame foto rasio 3:4 (Pas Foto Formal) */
        .pejabat-photo {
            width: 100%;
            aspect-ratio: 3/4;
            overflow: hidden;
            border-radius: 12px;
            border: 5px solid #fff;
            background: #f8f9fa;
        }

        .pejabat-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .pejabat-card-v2:hover .pejabat-photo img {
            transform: scale(1.1);
        }

        /* Dekorasi garis emas di bawah foto */
        .pejabat-decorator {
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }

        .line-gold {
            width: 30px;
            height: 3px;
            background: var(--kemdikbud-accent);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .pejabat-card-v2:hover .line-gold {
            width: 60px;
        }

        .section-label {
            display: inline-block;
            background: rgba(0, 51, 102, 0.05);
            color: var(--kemdikbud-blue);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
@endpush
