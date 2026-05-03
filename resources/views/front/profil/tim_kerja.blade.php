@extends('layouts.front')

@section('title', 'Tim Kerja')

@section('page_hero')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
            <li class="breadcrumb-item">Profil</li>
            <li class="breadcrumb-item active">Tim Kerja</li>
        </ol>
    </nav>
    <h1>Struktur Tim Kerja</h1>
    <p class="mb-0 opacity-75 small">Sinergi dan kolaborasi profesional KGTK Bengkulu.</p>
@endsection

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            @forelse($timKerja as $item)
                <div class="row mb-5">
                    <div class="col-12 text-center mb-4">
                        <span class="section-label">Kelompok Kerja</span>
                        <h2 class="fw-bold text-dark">{{ $item->title }}</h2>
                        <div class="mx-auto" style="width: 60px; height: 3px; background: var(--kemdikbud-accent);"></div>
                        <p class="mt-3 text-muted mx-auto" style="max-width: 800px;">{{ $item->description }}</p>
                    </div>

                    {{-- Menampilkan seluruh gambar/personil dalam tim ini --}}
                    <div class="col-12">
                        <div class="row g-4 justify-content-center">
                            @foreach ($item->images as $img)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="team-member-card">
                                        <div class="member-img-wrapper">
                                            <img src="{{ asset('storage/' . $img->image) }}" alt="Anggota Tim"
                                                class="member-img">
                                        </div>
                                        {{-- Jika nanti ada nama di tabel images, bisa ditaruh di sini --}}
                                        <div class="member-info">
                                            <div class="member-line"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr class="my-5 opacity-5">
            @empty
                <div class="text-center py-5">
                    <h5 class="text-muted">Data struktur tim belum tersedia.</h5>
                </div>
            @endforelse
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .team-member-card {
            background: #fff;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-align: center;
            height: 100%;
        }

        .team-member-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 51, 102, 0.1);
        }

        .member-img-wrapper {
            width: 100%;
            aspect-ratio: 3/4;
            /* Rasio pas foto standar */
            overflow: hidden;
            border-radius: 10px;
            background: #f8f9fa;
            margin-bottom: 15px;
        }

        .member-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .team-member-card:hover .member-img {
            transform: scale(1.1);
        }

        .member-line {
            width: 30px;
            height: 2px;
            background: var(--kemdikbud-accent);
            margin: 0 auto;
        }

        .section-label {
            background: rgba(0, 51, 102, 0.05);
            color: var(--kemdikbud-blue);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: inline-block;
        }
    </style>
@endpush
