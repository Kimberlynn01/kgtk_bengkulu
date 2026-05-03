@extends('layouts.front')

@section('title', 'Visi & Misi')
@section('meta_description', 'Visi dan Misi KGTK Bengkulu dalam memberdayakan pendidik dan tenaga kependidikan.')

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
            <li class="breadcrumb-item active" aria-current="page">Visi &amp; Misi</li>
        </ol>
    </nav>
    <h1>Visi &amp; Misi</h1>
    <p class="mb-0 opacity-75 small">Arah dan tujuan KGTK Bengkulu dalam memberdayakan pendidik.</p>
@endsection

{{-- ============================================================
     CONTENT
============================================================ --}}
@section('content')

    <section class="py-5 bg-white">
        <div class="container py-4">

            @forelse($visiMisi as $index => $item)

                <div class="vm-card mb-5 {{ $index % 2 !== 0 ? 'vm-card--reverse' : '' }}">
                    <div class="row g-0 align-items-stretch">

                        {{-- Gambar --}}
                        @if ($item->images->isNotEmpty())
                            <div class="col-md-5 {{ $index % 2 !== 0 ? 'order-md-2' : '' }} vm-media">
                                @if ($item->images->count() === 1)
                                    <img src="{{ asset('storage/' . $item->images->first()->image) }}"
                                        class="w-100 h-100 vm-single-img" alt="{{ $item->title }}">
                                @else
                                    <div class="vm-grid p-2">
                                        @foreach ($item->images->take(4) as $img)
                                            <div class="vm-grid-item">
                                                <img src="{{ asset('storage/' . $img->image) }}"
                                                    class="w-100 h-100 rounded-2" style="object-fit: cover;"
                                                    alt="{{ $item->title }}">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- Konten --}}
                        <div
                            class="{{ $item->images->isNotEmpty() ? 'col-md-7' : 'col-12' }}
                                {{ $index % 2 !== 0 ? 'order-md-1' : '' }}
                                vm-body">
                            <div class="vm-body-inner">

                                {{-- Nomor dekoratif latar --}}
                                <span class="vm-bg-number">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                {{-- Label --}}
                                <span class="section-label mb-3">
                                    @if ($index === 0)
                                        Visi
                                    @elseif($index === 1)
                                        Misi
                                    @else
                                        Tujuan
                                    @endif
                                </span>

                                <h2 class="vm-title">{{ $item->title }}</h2>

                                <div class="vm-divider"></div>

                                <div class="vm-desc">
                                    {!! nl2br(e($item->description)) !!}
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            @empty

                <div class="text-center py-5">
                    <i class="fas fa-bullseye fa-4x mb-4" style="color: var(--kemdikbud-blue); opacity: 0.12;"></i>
                    <h5 class="text-muted fw-semibold">Data Visi &amp; Misi belum tersedia.</h5>
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
        .vm-card {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 24px rgba(0, 51, 102, 0.07);
            transition: box-shadow 0.3s ease;
        }

        .vm-card:hover {
            box-shadow: 0 12px 40px rgba(0, 51, 102, 0.13);
        }

        /* =====================
               MEDIA KOLOM (gambar)
            ===================== */
        .vm-media {
            background: var(--light-gray);
            overflow: hidden;
            min-height: 280px;
        }

        .vm-single-img {
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .vm-card:hover .vm-single-img {
            transform: scale(1.04);
        }

        /* Grid gambar lebih dari 1 */
        .vm-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            height: 100%;
            min-height: 280px;
        }

        .vm-grid-item {
            overflow: hidden;
            border-radius: 8px;
        }

        .vm-grid-item img {
            transition: transform 0.4s ease;
            min-height: 120px;
        }

        .vm-card:hover .vm-grid-item img {
            transform: scale(1.06);
        }

        /* =====================
               KONTEN BODY
            ===================== */
        .vm-body {
            background: #fff;
            display: flex;
            align-items: center;
        }

        .vm-body-inner {
            position: relative;
            padding: 40px 44px;
            overflow: hidden;
            width: 100%;
        }

        /* Nomor dekoratif latar */
        .vm-bg-number {
            position: absolute;
            top: -10px;
            right: 20px;
            font-size: 7rem;
            font-weight: 900;
            color: var(--kemdikbud-blue);
            opacity: 0.05;
            line-height: 1;
            pointer-events: none;
            user-select: none;
            font-family: 'Lora', serif;
        }

        .vm-title {
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--kemdikbud-blue);
            line-height: 1.3;
            margin-bottom: 0;
        }

        .vm-divider {
            width: 48px;
            height: 3px;
            background: var(--kemdikbud-accent);
            border-radius: 2px;
            margin: 16px 0 20px;
        }

        .vm-desc {
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
            .vm-body-inner {
                padding: 28px 24px;
            }

            .vm-bg-number {
                font-size: 5rem;
                top: -5px;
                right: 12px;
            }

            .vm-title {
                font-size: 1.3rem;
            }

            .vm-media {
                min-height: 220px;
            }

            .vm-grid {
                min-height: 220px;
            }
        }
    </style>
@endpush
