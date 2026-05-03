@extends('layouts.front')

@section('title', $artikel->title)

@section('page_hero')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('front.article') }}">Artikel</a></li>
            <li class="breadcrumb-item active text-truncate" style="max-width: 200px;">{{ $artikel->title }}</li>
        </ol>
    </nav>
    <h1 class="h2">{{ $artikel->title }}</h1>
    <div class="d-flex align-items-center mt-3 opacity-75 small">
        <span class="me-3"><i class="far fa-calendar-alt me-1"></i>
            {{ \Carbon\Carbon::parse($artikel->date)->translatedFormat('l, d F Y') }}</span>
        <span><i class="far fa-user me-1"></i> Admin KGTK</span>
    </div>
@endsection

@section('content')
    <article class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    {{-- Galeri Gambar (Carousel jika lebih dari 1) --}}
                    @if ($artikel->images->count() > 0)
                        <div id="artikelCarousel" class="carousel slide mb-5 shadow-sm rounded-4 overflow-hidden"
                            data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($artikel->images as $index => $img)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $img->image) }}" class="d-block w-100"
                                            alt="Gambar Artikel" style="max-height: 500px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            @if ($artikel->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#artikelCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#artikelCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            @endif
                        </div>
                    @endif

                    {{-- Konten Artikel --}}
                    <div class="content-area lh-lg fs-6 text-dark mb-5" style="text-align: justify;">
                        {!! $artikel->content !!}
                    </div>

                    <hr class="my-5 opacity-5">

                    {{-- Tombol Kembali --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('front.article') }}" class="btn btn-light px-4">
                            <i class="fas fa-chevron-left me-2"></i> Kembali ke Daftar
                        </a>
                        <div class="share-links">
                            <span class="small text-muted me-2">Bagikan:</span>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-circle"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-info rounded-circle"><i
                                    class="fab fa-twitter"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </article>
@endsection
