@extends('layouts.front')

@section('title', 'Tugas Dan Fungsi')
@section('meta_description',
    'Tugas dan Fungsi KGTK Bengkulu dalam penyelenggaraan pendidikan dan pelatihan guru dan
    tenaga kependidikan.')

    {{-- ============================================================
     PAGE HERO / BREADCRUMB
============================================================ --}}
@section('page_hero')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a>
            </li>
            <li class="breadcrumb-item">Profil</li>
            <li class="breadcrumb-item active" aria-current="page">Tugas Dan Fungsi</li>
        </ol>
    </nav>
    <h1>Tugas Dan Fungsi</h1>
    <p class="mb-0 opacity-75 small">Peran dan tanggung jawab KGTK Bengkulu dalam ekosistem pendidikan.</p>
@endsection

{{-- ============================================================
     CONTENT
============================================================ --}}
@section('content')

    <section class="py-5 bg-white">
        <div class="container py-4">

            @forelse($tugasFungsi as $index => $item)
                {{-- ===========================
                 KARTU TUGAS FUNGSI
                 Gambar kiri/kanan selang-seling
            =========================== --}}
                <div class="tf-card mb-5 {{ $index % 2 !== 0 ? 'tf-card--reverse' : '' }}">
                    <div class="row g-0 align-items-stretch">

                        {{-- Kolom Gambar --}}
                        @if ($item->image)
                            <div class="col-md-4 {{ $index % 2 !== 0 ? 'order-md-2' : '' }} tf-media">
                                <img src="{{ asset('storage/' . $item->image) }}" class="tf-img" alt="{{ $item->title }}">

                                {{-- Badge nomor urut --}}
                                <div class="tf-badge">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                        @else
                            {{-- Placeholder jika tidak ada gambar --}}
                            <div class="col-md-4 {{ $index % 2 !== 0 ? 'order-md-2' : '' }} tf-media tf-media--empty">
                                <i class="fas fa-tasks tf-empty-icon"></i>
                                <div class="tf-badge">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                        @endif

                        {{-- Kolom Konten --}}
                        <div class="col-md-8 {{ $index % 2 !== 0 ? 'order-md-1' : '' }} tf-body">
                            <div class="tf-body-inner">

                                {{-- Dekorasi latar --}}
                                <span class="tf-bg-number">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                <span class="section-label mb-3">
                                    {{ $index === 0 ? 'Tugas Pokok' : 'Fungsi ' . $index }}
                                </span>

                                <h2 class="tf-title">{{ $item->title }}</h2>

                                <div class="tf-divider"></div>

                                <div class="tf-desc">
                                    {!! nl2br(e($item->description)) !!}
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            @empty

                <div class="text-center py-5">
                    <i class="fas fa-tasks fa-4x mb-4" style="color: var(--kemdikbud-blue); opacity: 0.1;"></i>
                    <h5 class="text-muted fw-semibold">Data Tugas dan Fungsi belum tersedia.</h5>
                    <p class="text-muted small">Silakan periksa kembali nanti.</p>
                </div>
            @endforelse

        </div>
    </section>

@endsection

{{-- ============================================================
     PER-PAGE STYLES
============================================================ --}}
@push('styles')
    <style>
        /* =====================
               CARD WRAPPER
            ===================== */
        .tf-card {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 24px rgba(0, 51, 102, 0.07);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .tf-card:hover {
            box-shadow: 0 16px 48px rgba(0, 51, 102, 0.13);
            transform: translateY(-3px);
        }

        /* =====================
               MEDIA KOLOM (gambar)
            ===================== */
        .tf-media {
            position: relative;
            overflow: hidden;
            min-height: 260px;
            background: var(--light-gray);
        }

        .tf-media--empty {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--kemdikbud-blue) 0%, var(--kemdikbud-blue-light) 100%);
        }

        .tf-empty-icon {
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.2);
        }

        .tf-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .tf-card:hover .tf-img {
            transform: scale(1.05);
        }

        /* Badge nomor urut di atas gambar */
        .tf-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--kemdikbud-accent);
            color: var(--kemdikbud-blue);
            font-weight: 900;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 2;
        }

        /* =====================
               KONTEN BODY
            ===================== */
        .tf-body {
            background: #fff;
            display: flex;
            align-items: center;
        }

        .tf-body-inner {
            position: relative;
            padding: 36px 44px;
            overflow: hidden;
            width: 100%;
        }

        /* Nomor dekoratif latar */
        .tf-bg-number {
            position: absolute;
            top: -15px;
            right: 16px;
            font-size: 8rem;
            font-weight: 900;
            color: var(--kemdikbud-blue);
            opacity: 0.04;
            line-height: 1;
            pointer-events: none;
            user-select: none;
            font-family: 'Lora', serif;
        }

        .tf-title {
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--kemdikbud-blue);
            line-height: 1.35;
            margin-bottom: 0;
            position: relative;
            z-index: 1;
        }

        .tf-divider {
            width: 48px;
            height: 3px;
            background: var(--kemdikbud-accent);
            border-radius: 2px;
            margin: 14px 0 18px;
        }

        .tf-desc {
            color: #555;
            line-height: 1.85;
            font-size: 0.95rem;
            position: relative;
            z-index: 1;
        }

        /* =====================
               RESPONSIVE
            ===================== */
        @media (max-width: 767.98px) {
            .tf-body-inner {
                padding: 26px 22px;
            }

            .tf-bg-number {
                font-size: 5.5rem;
                top: -8px;
                right: 10px;
            }

            .tf-title {
                font-size: 1.2rem;
            }

            .tf-media {
                min-height: 200px;
            }

            .tf-card:hover {
                transform: none;
            }
        }
    </style>
@endpush
