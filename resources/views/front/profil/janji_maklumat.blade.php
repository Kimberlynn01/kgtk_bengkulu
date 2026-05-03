@extends('layouts.front')

@section('title', 'Janji & Maklumat Layanan')

@section('page_hero')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a>
            </li>
            <li class="breadcrumb-item">Profil</li>
            <li class="breadcrumb-item active" aria-current="page">Janji & Maklumat Layanan</li>
        </ol>
    </nav>
    <h1>Janji & Maklumat Layanan</h1>
    <p class="mb-0 opacity-75 small">Komitmen kami dalam memberikan pelayanan publik yang transparan dan akuntabel.</p>
@endsection

@section('content')
    <section class="py-5 bg-white">
        <div class="container">

            @forelse($janjiMaklumat as $item)
                <div class="row mb-5 justify-content-center">
                    <div class="col-lg-10">

                        {{-- Judul Janji/Maklumat --}}
                        <div class="text-center mb-4">
                            <span class="section-label">Komitmen Layanan</span>
                            <h2 class="fw-bold mt-2" style="color: var(--kemdikbud-blue)">{{ $item->title }}</h2>
                            <div class="mx-auto mt-2" style="width: 50px; height: 3px; background: var(--kemdikbud-accent)">
                            </div>
                        </div>

                        {{-- Galeri Gambar Dokumen --}}
                        <div class="row g-4 justify-content-center">
                            @foreach ($item->images as $img)
                                <div class="col-md-10">
                                    <div class="document-container shadow-sm">
                                        <div class="document-header d-flex justify-content-between align-items-center">
                                            <span class="small fw-bold text-white-50"><i
                                                    class="fas fa-file-signature me-2"></i>DOKUMEN RESMI</span>
                                            <a href="{{ asset('storage/' . $img->image) }}" target="_blank"
                                                class="btn-zoom">
                                                <i class="fas fa-search-plus"></i> Perbesar
                                            </a>
                                        </div>
                                        <div class="document-body">
                                            <img src="{{ asset('storage/' . $img->image) }}" alt="Dokumen Janji Maklumat"
                                                class="img-fluid w-100">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-scroll fa-4x mb-3 opacity-10"></i>
                    <h5 class="text-muted">Informasi Janji & Maklumat Layanan belum tersedia.</h5>
                </div>
            @endforelse

            {{-- Footer Info --}}
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <div class="alert alert-light border-0 shadow-sm p-4 text-center">
                        <i class="fas fa-info-circle text-primary mb-2 d-block fs-4"></i>
                        <p class="small text-muted mb-0">
                            Segala bentuk pelanggaran terhadap standar pelayanan yang telah ditetapkan dapat dilaporkan
                            melalui saluran pengaduan resmi kami. Kami berkomitmen untuk menindaklanjuti setiap masukan demi
                            kualitas pelayanan yang lebih baik.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('styles')
    <style>
        .document-container {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-light);
            background: #fff;
        }

        .document-header {
            background: var(--kemdikbud-blue);
            padding: 12px 20px;
        }

        .btn-zoom {
            color: #fff;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.1);
            padding: 4px 12px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .btn-zoom:hover {
            background: var(--kemdikbud-accent);
            color: var(--kemdikbud-blue);
        }

        .document-body {
            padding: 10px;
            background: #f8f9fa;
        }

        .document-body img {
            border-radius: 4px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .section-label {
            display: inline-block;
            background: rgba(0, 51, 102, 0.05);
            color: var(--kemdikbud-blue);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
@endpush
