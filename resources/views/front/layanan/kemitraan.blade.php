@extends('layouts.front')

@section('title', 'Kemitraan')

@section('page_hero')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a>
            </li>
            <li class="breadcrumb-item">Layanan</li>
            <li class="breadcrumb-item active" aria-current="page">Kemitraan</li>
        </ol>
    </nav>
    <h1>Kemitraan</h1>
    <p class="mb-0 opacity-75 small">Dokumen kerja sama dan kolaborasi strategis KGTK Bengkulu.</p>
@endsection

@section('content')
    <section class="py-5 bg-white">
        <div class="container">

            @forelse($kemitraans as $item)
                <div class="row mb-5">
                    {{-- Informasi Kemitraan --}}
                    <div class="col-12 mb-4">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="icon-shape bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h2 class="h4 fw-bold mb-0" style="color: var(--kemdikbud-blue)">{{ $item->title }}</h2>
                        </div>
                        <p class="text-muted ms-5 ps-2">{{ $item->description }}</p>
                        <hr class="ms-5 opacity-5">
                    </div>

                    {{-- List Multiple Files (Berjajar Horizontal) --}}
                    <div class="col-12">
                        <div class="row g-3 ms-md-5">
                            @foreach ($item->files as $file)
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div
                                        class="file-card p-3 rounded-3 border bg-light d-flex align-items-center shadow-sm">
                                        <div class="file-icon me-3">
                                            <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                        </div>
                                        <div class="file-info overflow-hidden">
                                            <p class="mb-1 fw-bold small text-truncate" title="Unduh Dokumen">
                                                Berkas Kerjasama
                                            </p>
                                            <a href="{{ asset('storage/' . $file->file) }}" target="_blank"
                                                class="btn btn-link p-0 btn-sm text-decoration-none fw-bold">
                                                <i class="fas fa-download me-1"></i> Unduh File
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-project-diagram fa-4x text-light mb-3"></i>
                    <h5 class="text-muted">Data kemitraan belum tersedia.</h5>
                </div>
            @endforelse

        </div>
    </section>
@endsection

@push('styles')
    <style>
        .file-card {
            transition: all 0.3s ease;
            border: 1px solid var(--border-light) !important;
        }

        .file-card:hover {
            transform: translateY(-3px);
            background-color: #fff !important;
            border-color: var(--kemdikbud-accent) !important;
            box-shadow: 0 8px 20px rgba(0, 51, 102, 0.08) !important;
        }

        .file-icon {
            flex-shrink: 0;
        }

        .btn-link {
            font-size: 0.75rem;
            color: var(--kemdikbud-blue);
        }

        .btn-link:hover {
            color: var(--kemdikbud-accent-dark);
        }

        .icon-shape {
            background-color: var(--kemdikbud-blue) !important;
        }
    </style>
@endpush
