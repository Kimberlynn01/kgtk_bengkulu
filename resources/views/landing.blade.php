<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KGTK Bengkulu - Profesional Landing Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --kemdikbud-blue: #003366;
            --kemdikbud-accent: #FFCC00;
            --light-gray: #f4f7f9;
            --text-dark: #333333;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            color: var(--text-dark);
            background-color: #ffffff;
        }

        /* Top Bar Informasi */
        .top-bar {
            background-color: #002347;
            color: white;
            padding: 8px 0;
            font-size: 0.85rem;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            color: var(--kemdikbud-blue) !important;
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--kemdikbud-blue) !important;
            font-weight: 600;
            margin: 0 5px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: var(--kemdikbud-accent) !important;
        }

        /* Dropdown Customization */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-top: 3px solid var(--kemdikbud-blue);
        }

        .dropdown-item:hover {
            background-color: var(--light-gray);
            color: var(--kemdikbud-blue);
        }

        /* Hero Section - Khas Instansi */
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

        /* Section Titles */
        .section-title {
            color: var(--kemdikbud-blue);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 40px;
        }

        /* Article Cards */
        .card-article {
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            transition: 0.3s;
        }

        .card-article:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .badge-category {
            background-color: var(--kemdikbud-blue);
            color: white;
            font-size: 0.7rem;
            padding: 5px 10px;
            border-radius: 4px;
        }

        /* Footer */
        .main-footer {
            background-color: var(--kemdikbud-blue);
            color: white;
            padding: 60px 0 20px;
        }

        .footer-logo {
            filter: brightness(0) invert(1);
            max-width: 200px;
        }

        .btn-kemdikbud {
            background-color: var(--kemdikbud-accent);
            color: var(--kemdikbud-blue);
            font-weight: bold;
            border: none;
        }

        .btn-kemdikbud:hover {
            background-color: #e6b800;
        }
    </style>
</head>

<body>
    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between">
            <div>
                <i class="fas fa-envelope me-2"></i> kgtkbengkulu@kemdikbud.go.id
                <i class="fas fa-phone ms-3 me-2"></i> (0736) 123456
            </div>
            <div>
                <a href="#" class="text-white text-decoration-none me-3">Webmail</a>
                <a href="#" class="text-white text-decoration-none">Kontak Kami</a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_Kemdikbud.png" alt="Logo"
                    width="40" class="me-2">
                KGTK BENGKULU
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilDrop" role="button"
                            data-bs-toggle="dropdown">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="#">Tugas Dan Fungsi</a></li>
                            <li><a class="dropdown-item" href="#">Tim Kerja</a></li>
                            <li><a class="dropdown-item" href="#">Janji & Maklumat Layanan</a></li>
                            <li><a class="dropdown-item" href="#">Profil Pejabat Struktural</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pubDrop" role="button"
                            data-bs-toggle="dropdown">Publikasi</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#articles">Artikel</a></li>
                            <li><a class="dropdown-item" href="#news">Berita</a></li>
                            <li><a class="dropdown-item" href="#">Survey Kepuasan Masyarakat</a></li>
                            <li><a class="dropdown-item" href="#">Hasil Survey</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="layananDrop" role="button"
                            data-bs-toggle="dropdown">Layanan</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Kemitraan</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="#qna">Q&A</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-kemdikbud btn-sm px-4 shadow-sm" href="{{ route('login') }}">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container text-start">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="text-uppercase fw-bold mb-3" style="color: var(--kemdikbud-accent);">Selamat Datang</h5>
                    <h1 class="display-4 fw-bold mb-4">Balai Guru Dan Tenaga Kependidikan <br> Provinsi Bengkulu</h1>
                    <p class="lead mb-5 opacity-90">Meningkatkan kualitas pendidikan melalui pemberdayaan dan
                        transformasi kompetensi pendidik di seluruh wilayah Bengkulu.</p>
                    <a href="#articles" class="btn btn-kemdikbud btn-lg px-5 py-3">Jelajahi Program</a>
                </div>
            </div>
        </div>
    </header>

    <section id="articles" class="py-5 bg-white">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <h2 class="section-title mb-0">Artikel Terbaru</h2>
                <a href="#" class="text-primary fw-bold text-decoration-none">Lihat Semua <i
                        class="fas fa-chevron-right ms-2"></i></a>
            </div>
            <div class="row g-4">
                @forelse($articles as $item)
                    <div class="col-md-4">
                        <div class="card-article h-100 bg-white shadow-sm">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $item->images->first()->image ?? 'https://via.placeholder.com/400x250') }}"
                                    class="w-100" style="height: 220px; object-fit: cover;">
                                <span class="badge-category position-absolute top-0 start-0 m-3">ARTIKEL</span>
                            </div>
                            <div class="p-4">
                                <small class="text-muted d-block mb-2"><i
                                        class="far fa-calendar-alt me-2"></i>{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</small>
                                <h5 class="fw-bold mb-3" style="color: var(--kemdikbud-blue);">
                                    {{ Str::limit($item->title, 60) }}</h5>
                                <p class="text-secondary small">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">Belum ada artikel.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="qna" class="py-5 bg-light">
        <div class="container py-5">
            <h2 class="text-center section-title">Pusat Informasi & Tanya Jawab</h2>
            <div class="row g-5 mt-2">
                <div class="col-lg-5">
                    <div class="p-4 bg-white rounded shadow-sm border-top border-4 border-warning">
                        <h4 class="fw-bold mb-4" style="color: var(--kemdikbud-blue);">Ada Pertanyaan?</h4>
                        <form action="{{ route('qna.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                <input type="text" class="form-control bg-light border-0"
                                    placeholder="Masukkan nama..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Kategori Layanan</label>
                                <select class="form-select bg-light border-0">
                                    <option>Program Guru Penggerak</option>
                                    <option>Sertifikasi & Diklat</option>
                                    <option>Informasi Umum</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Pesan Pertanyaan</label>
                                <textarea class="form-control bg-light border-0" rows="4" placeholder="Tuliskan detail pertanyaan..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-kemdikbud w-100 py-2">Kirim Sekarang</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="accordion" id="qnaAccordion">
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#q1">
                                    Bagaimana prosedur pendaftaran pelatihan kompetensi tahun 2026?
                                </button>
                            </h2>
                            <div id="q1" class="accordion-collapse collapse show">
                                <div class="accordion-body text-secondary">
                                    Anda dapat mengakses menu Layanan > Pelatihan atau memantau publikasi berita terbaru
                                    kami untuk jadwal pendaftaran secara berkala.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4 class="fw-bold mb-4">KGTK BENGKULU</h4>
                    <p class="opacity-75">Unit Pelaksana Teknis Kementerian Pendidikan, Kebudayaan, Riset, dan
                        Teknologi di bidang pengembangan dan pemberdayaan guru dan tenaga kependidikan.</p>
                </div>
                <div class="col-lg-4 px-lg-5">
                    <h5 class="fw-bold mb-4">Link Cepat</h5>
                    <ul class="list-unstyled opacity-75">
                        <li class="mb-2"><a href="#"
                                class="text-white text-decoration-none">Kemdikbudristek</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Dirjen GTK</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">SIMPKB</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Merdeka
                                Belajar</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-4">Kontak Kami</h5>
                    <p class="opacity-75 mb-1"><i class="fas fa-map-marker-alt me-2"></i> Jl. Jend. A. Yani No. 12,
                        Bengkulu</p>
                    <p class="opacity-75 mb-1"><i class="fas fa-phone me-2"></i> (0736) 123456</p>
                    <div class="mt-4">
                        <a href="#" class="text-white fs-5 me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white fs-5 me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-5 opacity-25">
            <div class="text-center small opacity-50">
                &copy; 2026 KGTK Bengkulu - Kementerian Pendidikan Dasar dan Menengah.
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
