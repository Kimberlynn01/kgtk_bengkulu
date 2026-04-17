<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KGTK Bengkulu - Landing Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #242934;
            --secondary-color: #2b313c;
            --accent-color: #7366ff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: var(--primary-color);
        }

        .hero {
            background: linear-gradient(rgba(36, 41, 52, 0.8), rgba(36, 41, 52, 0.8)), url('https://source.unsplash.com/random/1920x1080?indonesia,education') no-repeat center center/cover;
            height: 60vh;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
        }

        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .section-title {
            position: relative;
            margin-bottom: 3rem;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: var(--accent-color);
        }

        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 3rem 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">KGTK BENGKULU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Publikasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Layanan</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-light" href="{{ route('login') }}">Login Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4">Pusat Layanan Transformasi Pendidikan Bengkulu</h1>
            <p class="lead mb-5">Mewujudkan Sumber Daya Manusia Unggul melalui Peningkatan Kompetensi Guru dan Tenaga
                Kependidikan</p>
            <a href="#articles" class="btn btn-primary btn-lg px-5">Lihat Publikasi</a>
        </div>
    </header>

    <section id="articles" class="py-5">
        <div class="container py-5">
            <h2 class="text-center section-title">Artikel Terbaru</h2>
            <div class="row g-4">
                @forelse($articles as $item)
                    <div class="col-md-4">
                        <div class="card h-100">
                            @if ($item->images->count() > 0)
                                <img src="{{ asset('storage/' . $item->images->first()->image) }}" class="card-img-top"
                                    alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://source.unsplash.com/random/800x600?education,article&sig={{ $item->id }}"
                                    class="card-img-top" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <p class="text-muted small mb-2"><i class="far fa-calendar-alt me-1"></i>
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</p>
                                <h5 class="card-title fw-bold">{{ $item->title }}</h5>
                                <p class="card-text text-truncate-3">{{ Str::limit(strip_tags($item->content), 120) }}
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 pb-3">
                                <a href="#" class="btn btn-link p-0 text-decoration-none fw-bold">Baca
                                    Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada artikel publikasi.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="news" class="bg-light py-5">
        <div class="container py-5">
            <h2 class="text-center section-title">Berita KGTK</h2>
            <div class="row g-4">
                @forelse($news as $item)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            @if ($item->images->count() > 0)
                                <img src="{{ asset('storage/' . $item->images->first()->image) }}" class="card-img-top"
                                    alt="{{ $item->title }}" style="height: 150px; object-fit: cover;">
                            @else
                                <img src="https://source.unsplash.com/random/800x600?news,office&sig={{ $item->id }}"
                                    class="card-img-top" style="height: 150px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <p class="text-muted small mb-2">
                                    {{ \Carbon\Carbon::parse($item->date)->diffForHumans() }}</p>
                                <h6 class="card-title fw-bold">{{ Str::limit($item->title, 60) }}</h6>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada berita terbaru.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-primary px-5">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <h3 class="fw-bold mb-4">KGTK BENGKULU</h3>
            <p class="mb-4">Alamat Kantor: Jl. Jend. A. Yani No. 12, Kota Bengkulu, Bengkulu</p>
            <div class="mb-5">
                <a href="#" class="text-white mx-3 fs-4"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white mx-3 fs-4"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white mx-3 fs-4"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white mx-3 fs-4"><i class="fab fa-youtube"></i></a>
            </div>
            <p class="small text-muted">&copy; 2026 KGTK Bengkulu. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
