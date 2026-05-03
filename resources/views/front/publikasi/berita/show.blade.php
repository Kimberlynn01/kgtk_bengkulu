@extends('layouts.front')

@section('title', $berita->title)

@section('page_hero')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('front.berita') }}">Berita</a></li>
            <li class="breadcrumb-item active text-truncate" style="max-width: 200px;">Detail</li>
        </ol>
    </nav>
    <h1 class="h2 lh-base">{{ $berita->title }}</h1>
    <div class="mt-3 small opacity-75">
        <i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($berita->date)->translatedFormat('l, d F Y') }}
        <span class="mx-2">|</span>
        <i class="far fa-user me-1"></i> Admin KGTK
    </div>
@endsection

@section('content')
    <article class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    {{-- Galeri Gambar --}}
                    @if ($berita->images->count() > 0)
                        <div id="beritaCarousel" class="carousel slide mb-5 shadow rounded-4 overflow-hidden"
                            data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($berita->images as $index => $img)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $img->image) }}" class="d-block w-100"
                                            alt="Gambar Berita" style="max-height: 500px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            @if ($berita->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#beritaCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#beritaCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            @endif
                        </div>
                    @endif

                    {{-- Konten Utama --}}
                    <div class="content-text fs-6 lh-lg text-dark" style="text-align: justify">
                        {!! $berita->content !!}
                    </div>

                    <hr class="my-5 opacity-5">

                    {{-- Footer Konten --}}
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <a href="{{ route('front.berita') }}" class="btn btn-light border btn-sm px-4">
                            <i class="fas fa-chevron-left me-2"></i> Kembali ke Berita
                        </a>
                        <div class="share-box">
                            <span class="small text-muted me-2">Bagikan berita ini:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"
                                class="text-primary me-3"><i class="fab fa-facebook fa-lg"></i></a>
                            <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank"
                                class="text-success"><i class="fab fa-whatsapp fa-lg"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </article>
@endsection
