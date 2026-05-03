<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KGTK Bengkulu') - Balai Guru Dan Tenaga Kependidikan</title>
    <meta name="description" content="@yield('meta_description', 'Meningkatkan kualitas pendidikan melalui pemberdayaan dan transformasi kompetensi pendidik di seluruh wilayah Bengkulu.')">

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --kemdikbud-blue: #003366;
            --kemdikbud-blue-dark: #002347;
            --kemdikbud-blue-light: #0a4a8f;
            --kemdikbud-accent: #FFCC00;
            --kemdikbud-accent-dark: #e6b800;
            --light-gray: #f4f7f9;
            --text-dark: #1a1a2e;
            --text-muted: #6c757d;
            --border-light: #e8ecf0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif;
            color: var(--text-dark);
            background-color: #ffffff;
            line-height: 1.7;
        }

        /* =====================
           TOP BAR
        ===================== */
        .top-bar {
            background-color: var(--kemdikbud-blue-dark);
            color: rgba(255, 255, 255, 0.85);
            padding: 8px 0;
            font-size: 0.82rem;
            letter-spacing: 0.2px;
        }

        .top-bar a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: color 0.2s;
        }

        .top-bar a:hover {
            color: var(--kemdikbud-accent);
        }

        /* =====================
           NAVBAR
        ===================== */
        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 16px rgba(0, 51, 102, 0.08);
            padding: 12px 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 8px 0;
            box-shadow: 0 4px 20px rgba(0, 51, 102, 0.15);
        }

        .navbar-brand {
            color: var(--kemdikbud-blue) !important;
            font-weight: 800;
            font-size: 1.15rem;
            letter-spacing: -0.3px;
        }

        .navbar-brand img {
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: rotate(-5deg);
        }

        .nav-link {
            color: var(--kemdikbud-blue) !important;
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0 3px;
            padding: 6px 12px !important;
            border-radius: 6px;
            transition: all 0.2s;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--kemdikbud-blue) !important;
            background-color: var(--light-gray);
        }

        /* Active underline indicator */
        .nav-item .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 12px;
            right: 12px;
            height: 2px;
            background: var(--kemdikbud-accent);
            border-radius: 2px;
        }

        /* =====================
           DROPDOWN
        ===================== */
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 30px rgba(0, 51, 102, 0.12);
            border-top: 3px solid var(--kemdikbud-blue);
            border-radius: 0 0 10px 10px;
            padding: 8px;
            min-width: 220px;
            animation: dropdownFade 0.2s ease;
        }

        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            border-radius: 6px;
            padding: 8px 14px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-dark);
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background-color: var(--light-gray);
            color: var(--kemdikbud-blue);
            padding-left: 20px;
        }

        /* =====================
           BUTTONS
        ===================== */
        .btn-kemdikbud {
            background-color: var(--kemdikbud-accent);
            color: var(--kemdikbud-blue);
            font-weight: 700;
            border: none;
            border-radius: 8px;
            transition: all 0.25s;
            letter-spacing: 0.3px;
        }

        .btn-kemdikbud:hover {
            background-color: var(--kemdikbud-accent-dark);
            color: var(--kemdikbud-blue);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(255, 204, 0, 0.4);
        }

        .btn-kemdikbud:active {
            transform: translateY(0);
        }

        /* =====================
           SECTION UTILITIES
        ===================== */
        .section-title {
            color: var(--kemdikbud-blue);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 1.4rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 48px;
            height: 4px;
            background: var(--kemdikbud-accent);
            border-radius: 2px;
            margin-top: 10px;
        }

        .section-title.text-center::after {
            margin: 10px auto 0;
        }

        .section-label {
            display: inline-block;
            background: rgba(0, 51, 102, 0.08);
            color: var(--kemdikbud-blue);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 50px;
            margin-bottom: 12px;
        }

        /* =====================
           CARD ARTICLE
        ===================== */
        .card-article {
            border: 1px solid var(--border-light);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: #fff;
        }

        .card-article:hover {
            box-shadow: 0 12px 32px rgba(0, 51, 102, 0.12);
            transform: translateY(-4px);
            border-color: transparent;
        }

        .card-article img {
            transition: transform 0.4s ease;
        }

        .card-article:hover img {
            transform: scale(1.05);
        }

        .badge-category {
            background-color: var(--kemdikbud-blue);
            color: white;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 4px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* =====================
           FOOTER
        ===================== */
        .main-footer {
            background-color: var(--kemdikbud-blue);
            color: white;
            padding: 64px 0 0;
            position: relative;
            overflow: hidden;
        }

        .main-footer::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
            pointer-events: none;
        }

        .main-footer::after {
            content: '';
            position: absolute;
            bottom: 60px;
            left: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 204, 0, 0.04);
            pointer-events: none;
        }

        .footer-heading {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--kemdikbud-accent);
            margin-bottom: 20px;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
            display: inline-block;
        }

        .footer-link:hover {
            color: var(--kemdikbud-accent);
            transform: translateX(4px);
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 40px 0 0;
        }

        .footer-bottom {
            background: rgba(0, 0, 0, 0.15);
            padding: 16px 0;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.45);
        }

        .social-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: all 0.25s;
            margin-right: 8px;
        }

        .social-btn:hover {
            background: var(--kemdikbud-accent);
            color: var(--kemdikbud-blue);
            transform: translateY(-2px);
        }

        /* =====================
           SCROLL TO TOP
        ===================== */
        #scrollTop {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--kemdikbud-blue);
            color: #fff;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(0, 51, 102, 0.3);
            z-index: 999;
        }

        #scrollTop.show {
            opacity: 1;
            pointer-events: auto;
        }

        #scrollTop:hover {
            background: var(--kemdikbud-accent);
            color: var(--kemdikbud-blue);
            transform: translateY(-2px);
        }

        /* =====================
           PAGE CONTENT AREA
        ===================== */
        .page-hero {
            background: linear-gradient(135deg, var(--kemdikbud-blue) 0%, var(--kemdikbud-blue-light) 100%);
            padding: 52px 0 48px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 40px;
            background: #fff;
            clip-path: ellipse(55% 100% at 50% 100%);
        }

        .page-hero h1 {
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--kemdikbud-accent);
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.35);
        }

        /* =====================
           ACCORDION STYLING
        ===================== */
        .accordion-button {
            font-weight: 600;
            color: var(--kemdikbud-blue);
            font-size: 0.9rem;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--light-gray);
            color: var(--kemdikbud-blue);
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        /* =====================
           RESPONSIVE
        ===================== */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: #fff;
                padding: 16px;
                border-top: 1px solid var(--border-light);
                margin-top: 8px;
                border-radius: 0 0 12px 12px;
                box-shadow: 0 8px 24px rgba(0, 51, 102, 0.1);
            }

            .dropdown-menu {
                box-shadow: none;
                border-top: none;
                border-left: 3px solid var(--kemdikbud-blue);
                border-radius: 0;
                padding-left: 12px;
            }
        }

        /* =====================
           STACK PLUGINS PER PAGE
        ===================== */
        @stack('styles')
    </style>

    @stack('styles')
</head>

<body>

    {{-- ===========================
         TOP BAR
    =========================== --}}
    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-envelope me-2"></i>
                <a href="mailto:kgtkbengkulu@kemdikbud.go.id">kgtkbengkulu@kemdikbud.go.id</a>
                <span class="mx-3 opacity-25">|</span>
                <i class="fas fa-phone me-2"></i>
                <a href="tel:0736123456">(0736) 123456</a>
            </div>
            <div class="d-flex gap-3">
                <a href="#">Webmail</a>
                <a href="#">Kontak Kami</a>
                <span class="opacity-25">|</span>
                <a href="{{ route('login') }}" class="text-warning fw-semibold">
                    <i class="fas fa-sign-in-alt me-1"></i>Panel
                </a>
            </div>
        </div>
    </div>

    {{-- ===========================
         NAVBAR
    =========================== --}}
    <nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_Kemdikbud.png" alt="Logo Kemdikbud"
                    width="36" class="me-2">
                KGTK BENGKULU
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            Beranda
                        </a>
                    </li>

                    {{-- Profil Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('profil*') || request()->is('visi-misi*') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item {{ request()->is('visi-misi') ? 'fw-bold' : '' }}"
                                    href="{{ url('visi-misi') }}">
                                    <i class="fas fa-bullseye me-2 text-primary opacity-50" style="width:16px"></i>
                                    Visi &amp; Misi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('tugas-fungsi') }}">
                                    <i class="fas fa-tasks me-2 text-primary opacity-50" style="width:16px"></i>
                                    Tugas Dan Fungsi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('tim-kerja') }}">
                                    <i class="fas fa-users me-2 text-primary opacity-50" style="width:16px"></i>
                                    Tim Kerja
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('janji-layanan') }}">
                                    <i class="fas fa-handshake me-2 text-primary opacity-50" style="width:16px"></i>
                                    Janji &amp; Maklumat Layanan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('pejabat-struktural') }}">
                                    <i class="fas fa-id-badge me-2 text-primary opacity-50" style="width:16px"></i>
                                    Profil Pejabat Struktural
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Publikasi Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('artikel*') || request()->is('berita*') || request()->is('survey*') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Publikasi
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ url('article') }}">
                                    <i class="fas fa-newspaper me-2 text-primary opacity-50" style="width:16px"></i>
                                    Artikel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('news') }}">
                                    <i class="fas fa-rss me-2 text-primary opacity-50" style="width:16px"></i>
                                    Berita
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('survey') }}">
                                    <i class="fas fa-poll me-2 text-primary opacity-50" style="width:16px"></i>
                                    Survey Kepuasan Masyarakat
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('hasil-survey') }}">
                                    <i class="fas fa-chart-bar me-2 text-primary opacity-50" style="width:16px"></i>
                                    Hasil Survey
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Layanan Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('layanan*') || request()->is('kemitraan*') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Layanan
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ url('partnership') }}">
                                    <i class="fas fa-project-diagram me-2 text-primary opacity-50"
                                        style="width:16px"></i>
                                    Kemitraan
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#qna">
                            Q&amp;A
                        </a>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-kemdikbud btn-sm px-4 py-2 shadow-sm" href="{{ route('login') }}">
                            <i class="fas fa-lock me-1" style="font-size:0.75rem"></i> LOGIN
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    {{-- ===========================
         PAGE HERO / BREADCRUMB
         (hanya muncul di halaman non-beranda)
    =========================== --}}
    @hasSection('page_hero')
        <div class="page-hero">
            <div class="container position-relative" style="z-index:1">
                @yield('page_hero')
            </div>
        </div>
    @endif

    {{-- ===========================
         MAIN CONTENT
    =========================== --}}
    <main>
        @yield('content')
    </main>

    {{-- ===========================
         FOOTER
    =========================== --}}
    <footer class="main-footer">
        <div class="container position-relative" style="z-index:1">
            <div class="row g-5">

                {{-- Brand & Deskripsi --}}
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_Kemdikbud.png"
                            alt="Logo" width="36" class="me-3" style="filter: brightness(0) invert(1);">
                        <span class="fw-bold fs-5 lh-1">KGTK<br><small class="fw-normal opacity-75"
                                style="font-size:0.75rem">BENGKULU</small></span>
                    </div>
                    <p class="opacity-65 small lh-relaxed mb-4" style="color:rgba(255,255,255,0.65)">
                        Unit Pelaksana Teknis Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi di bidang
                        pengembangan dan pemberdayaan guru dan tenaga kependidikan.
                    </p>
                    <div class="d-flex">
                        <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                {{-- Link Cepat --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <p class="footer-heading">Profil</p>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="{{ url('visi-misi') }}" class="footer-link">Visi &amp; Misi</a>
                        </li>
                        <li class="mb-2"><a href="{{ url('tugas-fungsi') }}" class="footer-link">Tugas &amp;
                                Fungsi</a></li>
                        <li class="mb-2"><a href="{{ url('tim-kerja') }}" class="footer-link">Tim Kerja</a></li>
                        <li class="mb-2"><a href="{{ url('pejabat-struktural') }}" class="footer-link">Pejabat
                                Struktural</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <p class="footer-heading">Tautan</p>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="footer-link" target="_blank">Kemdikbudristek</a>
                        </li>
                        <li class="mb-2"><a href="#" class="footer-link" target="_blank">Dirjen GTK</a></li>
                        <li class="mb-2"><a href="#" class="footer-link" target="_blank">SIMPKB</a></li>
                        <li class="mb-2"><a href="#" class="footer-link" target="_blank">Merdeka Belajar</a>
                        </li>
                    </ul>
                </div>

                {{-- Kontak --}}
                <div class="col-lg-4 col-md-6">
                    <p class="footer-heading">Kontak Kami</p>
                    <ul class="list-unstyled" style="color: rgba(255,255,255,0.65)">
                        <li class="mb-3 d-flex gap-3">
                            <i class="fas fa-map-marker-alt mt-1" style="color: var(--kemdikbud-accent)"></i>
                            <span class="small">Jl. Jend. A. Yani No. 12, Bengkulu 38214</span>
                        </li>
                        <li class="mb-3 d-flex gap-3">
                            <i class="fas fa-phone mt-1" style="color: var(--kemdikbud-accent)"></i>
                            <span class="small">(0736) 123456</span>
                        </li>
                        <li class="mb-3 d-flex gap-3">
                            <i class="fas fa-envelope mt-1" style="color: var(--kemdikbud-accent)"></i>
                            <span class="small">kgtkbengkulu@kemdikbud.go.id</span>
                        </li>
                        <li class="d-flex gap-3">
                            <i class="fas fa-clock mt-1" style="color: var(--kemdikbud-accent)"></i>
                            <span class="small">Senin – Jumat: 08.00 – 16.00 WIB</span>
                        </li>
                    </ul>
                </div>

            </div>

            <hr class="footer-divider">
        </div>

        <div class="footer-bottom">
            <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <span>&copy; {{ date('Y') }} KGTK Bengkulu &mdash; Kementerian Pendidikan Dasar dan
                    Menengah.</span>
                <span>Dikembangkan oleh Tim IT KGTK Bengkulu</span>
            </div>
        </div>
    </footer>

    {{-- ===========================
         SCROLL TO TOP BUTTON
    =========================== --}}
    <button id="scrollTop" title="Kembali ke atas">
        <i class="fas fa-chevron-up" style="font-size: 0.85rem"></i>
    </button>

    {{-- Bootstrap JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('mainNavbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });

        // Scroll to top
        const scrollBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            scrollBtn.classList.toggle('show', window.scrollY > 300);
        });
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
