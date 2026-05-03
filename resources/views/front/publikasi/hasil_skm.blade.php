@extends('layouts.front')

@section('title', 'Hasil Survey Kepuasan Masyarakat')

@section('page_hero')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a>
            </li>
            <li class="breadcrumb-item">Publikasi</li>
            <li class="breadcrumb-item active" aria-current="page">Hasil Survey</li>
        </ol>
    </nav>
    <h1>Hasil Survey Kepuasan</h1>
    <p class="mb-0 opacity-75 small">Laporan transparansi indeks kepuasan masyarakat terhadap layanan kami.</p>
@endsection

@section('content')
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    {{-- Accordion Container --}}
                    <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden border"
                        id="accordionHasilSurvey">

                        @forelse($hasilSurveys as $index => $hasil)
                            <div class="accordion-item">
                                {{-- Header Accordion (Hanya Judul) --}}
                                <h2 class="accordion-header" id="heading{{ $hasil->id }}">
                                    <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }} fw-bold py-3 px-4"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $hasil->id }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $hasil->id }}">
                                        <i class="fas fa-chart-line me-3 text-primary opacity-50"></i>
                                        {{ $hasil->title }}
                                    </button>
                                </h2>

                                {{-- Konten Accordion (Deskripsi & Gambar) --}}
                                <div id="collapse{{ $hasil->id }}"
                                    class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                    aria-labelledby="heading{{ $hasil->id }}" data-bs-parent="#accordionHasilSurvey">
                                    <div class="accordion-body p-4 p-md-5 bg-light">

                                        <div class="row align-items-center">
                                            {{-- Kolom Teks Deskripsi --}}
                                            <div class="col-md-6 mb-4 mb-md-0">
                                                <span class="section-label mb-3">Detail Laporan</span>
                                                <div class="text-muted lh-lg">
                                                    {!! nl2br(e($hasil->description)) !!}
                                                </div>
                                            </div>

                                            {{-- Kolom Gambar/Infografis --}}
                                            <div class="col-md-6 text-center">
                                                @if ($hasil->image)
                                                    <div class="hasil-img-wrapper shadow-sm rounded-3 bg-white p-2">
                                                        <img src="{{ asset('storage/' . $hasil->image) }}"
                                                            alt="{{ $hasil->title }}" class="img-fluid rounded-2 w-100">
                                                        <a href="{{ asset('storage/' . $hasil->image) }}" target="_blank"
                                                            class="btn btn-sm btn-light mt-2 w-100 border">
                                                            <i class="fas fa-search-plus me-1"></i> Lihat Gambar Penuh
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="p-5 border border-dashed rounded-3 text-muted">
                                                        <i class="fas fa-image fa-3x mb-2 opacity-25"></i>
                                                        <p class="small mb-0">Infografis belum tersedia.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-folder-open fa-4x text-light mb-3"></i>
                                <h5 class="text-muted">Data hasil survei belum tersedia.</h5>
                            </div>
                        @endforelse

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Custom Accordion Styling agar selaras dengan UI KGTK */
        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
            color: var(--kemdikbud-blue);
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .125);
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 51, 102, 0.1);
        }

        .accordion-button::after {
            background-size: 1rem;
        }

        .hasil-img-wrapper {
            border: 1px solid var(--border-light);
            transition: transform 0.3s ease;
        }

        .hasil-img-wrapper:hover {
            transform: scale(1.02);
        }

        .section-label {
            display: inline-block;
            background: rgba(0, 51, 102, 0.08);
            color: var(--kemdikbud-blue);
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 50px;
        }

        .border-dashed {
            border-style: dashed !important;
        }
    </style>
@endpush
