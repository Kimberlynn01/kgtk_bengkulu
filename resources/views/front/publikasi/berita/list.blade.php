@extends('layouts.front')

@section('title', 'Berita Terbaru')

@section('page_hero')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
            <li class="breadcrumb-item active">Berita</li>
        </ol>
    </nav>
    <h1>Berita & Kegiatan</h1>
    <p class="mb-0 opacity-75 small">Informasi terkini mengenai aktivitas dan kebijakan di lingkungan KGTK Bengkulu.</p>
@endsection

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                @forelse($beritas as $berita)
                    <div class="col-md-6 col-lg-4">
                        <article class="card-article h-100 shadow-sm border-0">
                            <div class="position-relative overflow-hidden" style="height: 200px;">
                                @if ($berita->images->count() > 0)
                                    <img src="{{ asset('storage/' . $berita->images->first()->image) }}"
                                        class="img-fluid w-100 h-100" alt="{{ $berita->title }}" style="object-fit: cover;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-newspaper fa-3x text-white-50"></i>
                                    </div>
                                @endif
                                <div class="position-absolute bottom-0 start-0 m-3">
                                    <span class="badge-category bg-warning text-dark shadow-sm">
                                        {{ \Carbon\Carbon::parse($berita->date)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body p-4">
                                <h2 class="h5 fw-bold mb-3">
                                    <a href="{{ route('front.berita.detail', $berita->slug) }}"
                                        class="text-decoration-none text-dark">
                                        {{ Str::limit($berita->title, 70) }}
                                    </a>
                                </h2>
                                <div class="text-muted small mb-4">
                                    {!! Str::limit(strip_tags($berita->content), 100) !!}
                                </div>
                                <a href="{{ route('front.berita.detail', $berita->slug) }}"
                                    class="fw-bold small text-decoration-none text-primary">
                                    Selengkapnya <i class="fas fa-arrow-right ms-1" style="font-size: 0.7rem"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-newspaper fa-4x mb-3 opacity-10"></i>
                        <h5 class="text-muted">Belum ada berita yang diterbitkan.</h5>
                    </div>
                @endforelse
            </div>

            {{-- Pastikan di Controller menggunakan ->paginate() agar links() tersedia --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $beritas->links() }}
            </div>
        </div>
    </section>
@endsection
