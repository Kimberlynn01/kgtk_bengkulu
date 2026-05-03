@extends('layouts.front')

@section('title', 'Beranda')
@section('meta_description',
    'Meningkatkan kualitas pendidikan melalui pemberdayaan dan transformasi kompetensi pendidik
    di seluruh wilayah Bengkulu.')
@section('content')

    {{-- ===========================
         HERO SECTION
    =========================== --}}
    <header class="hero">
        <div class="container text-start">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="text-uppercase fw-bold mb-3" style="color: var(--kemdikbud-accent);">
                        Selamat Datang
                    </h5>
                    <h1 class="display-4 fw-bold mb-4">
                        Balai Guru Dan Tenaga Kependidikan <br> Provinsi Bengkulu
                    </h1>
                    <p class="lead mb-5 opacity-90">
                        Meningkatkan kualitas pendidikan melalui pemberdayaan dan
                        transformasi kompetensi pendidik di seluruh wilayah Bengkulu.
                    </p>
                    <a href="#articles" class="btn btn-kemdikbud btn-lg px-5 py-3">
                        Jelajahi Program
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- ===========================
         ARTIKEL TERBARU
    =========================== --}}
    <section id="articles" class="py-5 bg-white">
        <div class="container py-4">

            <div class="d-flex justify-content-between align-items-end mb-5">
                <h2 class="section-title mb-0">Artikel Terbaru</h2>
                <a href="{{ url('artikel') }}" class="text-primary fw-bold text-decoration-none">
                    Lihat Semua <i class="fas fa-chevron-right ms-2"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse($articles as $item)
                    <div class="col-md-4">
                        <div class="card-article h-100 bg-white shadow-sm">
                            <div class="position-relative overflow-hidden" style="height: 220px;">
                                @if ($item->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $item->images->first()->image) }}" class="w-100 h-100"
                                        style="object-fit: cover;" alt="{{ $item->title }}">
                                @else
                                    <img src="https://via.placeholder.com/400x220?text=KGTK+Bengkulu" class="w-100 h-100"
                                        style="object-fit: cover;" alt="{{ $item->title }}">
                                @endif
                                <span class="badge-category position-absolute top-0 start-0 m-3">ARTIKEL</span>
                            </div>
                            <div class="p-4">
                                <small class="text-muted d-block mb-2">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                                </small>
                                <h5 class="fw-bold mb-3" style="color: var(--kemdikbud-blue);">
                                    {{ Str::limit($item->title, 60) }}
                                </h5>
                                <p class="text-secondary small mb-0">
                                    {{ Str::limit(strip_tags($item->content), 100) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-4">
                        <i class="fas fa-newspaper fa-3x mb-3 opacity-25"></i>
                        <p>Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    {{-- ===========================
         Q&A SECTION
    =========================== --}}
    <section id="qna" class="py-5 bg-light">
        <div class="container py-5">

            <h2 class="text-center section-title">Pusat Informasi &amp; Tanya Jawab</h2>

            <div class="row g-5 mt-2">

                {{-- Form Pertanyaan --}}
                <div class="col-lg-5">
                    <div class="p-4 bg-white rounded shadow-sm border-top border-4 border-warning">
                        <h4 class="fw-bold mb-4" style="color: var(--kemdikbud-blue);">Ada Pertanyaan?</h4>

                        <form action="{{ route('qna.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control bg-light border-0"
                                    placeholder="Masukkan nama..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Kategori Layanan</label>
                                <select name="category" class="form-select bg-light border-0">
                                    <option value="guru_penggerak">Program Guru Penggerak</option>
                                    <option value="sertifikasi">Sertifikasi &amp; Diklat</option>
                                    <option value="umum">Informasi Umum</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Pesan Pertanyaan</label>
                                <textarea name="message" class="form-control bg-light border-0" rows="4"
                                    placeholder="Tuliskan detail pertanyaan..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-kemdikbud w-100 py-2">
                                Kirim Sekarang
                            </button>
                        </form>
                    </div>
                </div>

                {{-- FAQ Accordion --}}
                <div class="col-lg-7">
                    <div class="accordion" id="qnaAccordion">

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#q1">
                                    Bagaimana prosedur pendaftaran pelatihan kompetensi tahun 2026?
                                </button>
                            </h2>
                            <div id="q1" class="accordion-collapse collapse show" data-bs-parent="#qnaAccordion">
                                <div class="accordion-body text-secondary">
                                    Anda dapat mengakses menu Layanan &gt; Pelatihan atau memantau
                                    publikasi berita terbaru kami untuk jadwal pendaftaran secara berkala.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#q2">
                                    Siapa yang bisa mengikuti program Guru Penggerak?
                                </button>
                            </h2>
                            <div id="q2" class="accordion-collapse collapse" data-bs-parent="#qnaAccordion">
                                <div class="accordion-body text-secondary">
                                    Program Guru Penggerak terbuka bagi guru aktif di semua jenjang pendidikan
                                    yang memenuhi persyaratan yang ditetapkan oleh Kemdikbudristek.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#q3">
                                    Bagaimana cara mendapatkan sertifikat pelatihan?
                                </button>
                            </h2>
                            <div id="q3" class="accordion-collapse collapse" data-bs-parent="#qnaAccordion">
                                <div class="accordion-body text-secondary">
                                    Sertifikat diterbitkan secara digital setelah peserta menyelesaikan
                                    seluruh rangkaian pelatihan dan memenuhi nilai minimum kelulusan.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#q4">
                                    Apakah ada biaya untuk mengikuti program pelatihan?
                                </button>
                            </h2>
                            <div id="q4" class="accordion-collapse collapse" data-bs-parent="#qnaAccordion">
                                <div class="accordion-body text-secondary">
                                    Seluruh program pelatihan yang diselenggarakan oleh KGTK Bengkulu
                                    <strong>tidak dipungut biaya</strong> (gratis).
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

{{-- ============================================================
     PER-PAGE STYLES
============================================================ --}}
@push('styles')
    <style>
        /* Hero */
        .hero {
            background: linear-gradient(rgba(0, 51, 102, 0.7), rgba(0, 51, 102, 0.7)),
                url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
            padding: 120px 0;
            color: white;
        }

        .hero h1 {
            border-left: 5px solid var(--kemdikbud-accent);
            padding-left: 20px;
        }
    </style>
@endpush
