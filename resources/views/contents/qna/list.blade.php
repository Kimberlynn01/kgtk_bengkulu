@extends('layouts.app')

@php
    $plugins = ['datatable'];
@endphp

@section('contents')
    {{-- Bookmark / Tombol Aksi --}}
    <div class="row">
        <div class="col-sm-12 text-right mb-2">
            <div class="bookmark">
                <ul class="list-unstyled m-0 d-flex justify-content-end gap-2">
                    @if (rbacCheck('qna', 1))
                    <li>
                        <a href="{{ route('qna-category') }}" class="btn btn-secondary btn-sm d-inline-flex align-items-center px-3" style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="tag" style="width: 16px; height: 16px;"></i>
                            <span>Kelola Kategori</span>
                        </a>
                    </li>
                    @endif
                    
                    @if (rbacCheck('qna', 4))
                    <li>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-user-pic">
                            <i data-feather="user-plus" style="width:16px;height:16px;"></i> Tambah PIC
                        </button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-info btn-sm btn-show-answered d-inline-flex align-items-center px-3"
                            style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="list" style="width: 16px; height: 16px;"></i>
                            <span>Jawaban</span>
                            </button>
                    </li>
                    <li>
                        <a href="{{ route('qna.export') }}" class="btn btn-success btn-sm d-inline-flex align-items-center px-3" style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="file-text" style="width: 16px; height: 16px;" class="text-white"></i>
                            <span class="text-white">Export Excel</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{-- Tabel Utama --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card b-r-0 border-primary">
                <div class="card-header pb-0">
                    <h5>Daftar Pertanyaan & Jawaban</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 4%;">#</th>
                                    <th>Nama Penanya</th>
                                    <th>Instansi</th>
                                    <th>Kategori</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th>Waktu Bertanya</th>
                                    <th>Waktu Dijawab</th>
                                    <th>Status</th>
                                    <th style="width: 12%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Jawab --}}
    <div id="modal-qna" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-qnaLabel" aria-hidden="true">
        <form action="#" method="post" id="form-qna">
            @csrf
            @method('PATCH')
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-qnaLabel">Form Jawab Pertanyaan</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <label class="fw-bold">Penanya:</label>
                                <p id="show-name" class="text-muted mb-0"></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="fw-bold">Email:</label>
                                <p id="show-email" class="text-muted mb-0"></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="fw-bold">Instansi:</label>
                                <p id="show-instansi" class="text-muted mb-0"></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="fw-bold">No. Telepon:</label>
                                <p id="show-phone" class="text-muted mb-0"></p>
                            </div>
                            <div class="col-md-12 mb-2">
                            <label class="fw-bold">Kategori:</label>
                            <select name="category_id" id="show-category" class="form-control form-control-sm">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="col-12 mt-2">
                                <label class="fw-bold">Isi Pertanyaan:</label>
                                <div class="p-3 rounded" id="show-question"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group mb-3">
                            <label for="answer" class="fw-bold">Jawaban Admin</label>
                            <textarea name="answer" id="answer" class="form-control" rows="6"
                                placeholder="Masukkan jawaban resmi..." required></textarea>
                            <div id="error-answer"></div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_published" checked disabled>
                            <label class="form-check-label text-muted" for="is_published">
                                <small>Pertanyaan yang dijawab akan otomatis tampil di Landing Page.</small>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="modal-user-pic" class="modal fade" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-user-pic" method="POST" action="javascript:void(0);" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User PIC</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" id="pic-name" class="form-control" required>
                        <div id="error-name" class="invalid-feedback d-block"></div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" id="pic-username" class="form-control" required>
                        <div id="error-username" class="invalid-feedback d-block"></div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="pic-email" class="form-control" required>
                        <div id="error-email" class="invalid-feedback d-block"></div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" id="pic-password" class="form-control" required>
                        <div id="error-password" class="invalid-feedback d-block"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

    {{-- Modal Daftar Jawaban --}}
    <div id="modal-answered" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-answeredLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-answeredLabel">Daftar Jawaban</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-answered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Instansi</th>
                                    <th>Kategori</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th>Waktu Bertanya</th>
                                    <th>Waktu Dijawab</th>
                                    <th>Nama PIC</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/page/qna/list.js?v=' . time()) }}"></script>
    
@endpush