@extends('layouts.front')

@section('title', 'Artikel')

@section('page_hero')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
            <li class="breadcrumb-item active">Artikel</li>
        </ol>
    </nav>
    <h1>Artikel Terbaru</h1>
    <p class="mb-0 opacity-75 small">Wawasan dan literasi pendidikan untuk tenaga kependidikan di Bengkulu.</p>
@endsection

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                @forelse($artikels as $artikel)
                    <div class="col-md-6 col-lg-4 d-flex">
                        <article class="card-article shadow-sm w-100">
                            <div class="position-relative overflow-hidden">
                                {{-- Mengambil gambar pertama dari relasi images --}}
                                @if ($artikel->images->count() > 0)
                                    <img src="{{ asset('storage/' . $artikel->images->first()->image) }}"
                                        class="card-img-top" alt="{{ $artikel->title }}"
                                        style="height: 220px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center"
                                        style="height: 220px;">
                                        <i class="fas fa-image fa-3x text-white-50"></i>
                                    </div>
                                @endif
                                <div class="badge-category position-absolute top-0 start-0 m-3">
                                    {{ \Carbon\Carbon::parse($artikel->date)->translatedFormat('d M Y') }}
                                </div>
                            </div>

                            <div class="card-body p-4 d-flex flex-column">
                                <h2 class="h5 fw-bold mb-3">
                                    <a href="{{ route('front.article.detail', $artikel->slug) }}"
                                        class="text-decoration-none text-dark">
                                        {{ Str::limit($artikel->title, 60) }}
                                    </a>
                                </h2>
                                <div class="text-muted small mb-4 flex-grow-1">
                                    {!! Str::limit(strip_tags($artikel->content), 120) !!}
                                </div>
                                <a href="{{ route('front.article.detail', $artikel->slug) }}"
                                    class="btn btn-outline-primary btn-sm mt-auto w-fit">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $artikels->links() }}
            </div>
        </div>
    </section>
@endsection
