@extends('layouts.app')

@php
    $plugins = ['datatable'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-sm-12 text-right mb-2">
            <div class="bookmark">
                <ul class="list-unstyled m-0 d-flex justify-content-end gap-2">
                    <li>
                        <a href="{{ route('qna') }}" class="btn btn-secondary btn-sm d-inline-flex align-items-center px-3" style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="arrow-left" style="width: 16px; height: 16px;"></i>
                            <span>Kembali ke QnA</span>
                        </a>
                    </li>
                    @if (rbacCheck('qna', 2))
                    <li>
                        <button type="button" class="btn btn-primary btn-sm d-inline-flex align-items-center px-3 btn-add-session"
                            style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="plus" style="width:16px;height:16px;"></i>
                            <span>Tambah Sesi</span>
                        </button>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card b-r-0 border-primary">
                <div class="card-header pb-0">
                    <h5>Daftar Sesi Konsultasi (Gmeet)</h5>
                    <p id="session-limit-note" class="text-muted small mb-0" style="display:none;">
                        <i data-feather="info" style="width:14px;height:14px;"></i>
                        Hanya boleh ada 1 sesi konsultasi. Edit data yang sudah ada jika ingin mengganti link atau informasi.
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-session" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 8%;">Gambar</th>
                                    <th>Judul</th>
                                    <th>Slug</th>
                                    <th style="width: 10%;">Status</th>
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

    <div id="modal-session" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-sessionLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="form-session" method="POST" action="javascript:void(0);" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-sessionLabel">Tambah Sesi Konsultasi</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="session-id">

                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="session-title">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="session-title" class="form-control" placeholder="Contoh: Sesi Konsultasi PPG Batch 1" required>
                            <div id="error-title" class="invalid-feedback d-block"></div>
                        </div>

                        

                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="session-description">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="description" id="session-description" class="form-control" rows="4" placeholder="Jelaskan tujuan/topik sesi konsultasi ini..." required></textarea>
                            <div id="error-description" class="invalid-feedback d-block"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="session-gmeet">Link Google Meet <span class="text-danger">*</span></label>
                            <input type="url" name="gmeet_link" id="session-gmeet" class="form-control" placeholder="https://meet.google.com/xxx-xxxx-xxx" required>
                            <div id="error-gmeet_link" class="invalid-feedback d-block"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="session-image">Gambar <small class="text-muted">(opsional, maks 2MB)</small></label>
                            <input type="file" name="image" id="session-image" class="form-control" accept="image/*">
                            <div id="error-image" class="invalid-feedback d-block"></div>
                            <img id="session-image-preview" src="" style="display:none;margin-top:10px;max-width:150px;border-radius:8px;">
                        </div>

                        <div class="form-check form-switch" id="session-active-wrapper" style="display:none;">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="session-is-active" checked>
                            <label class="form-check-label" for="session-is-active">
                                Aktif
                                <br><small class="text-muted">Sesi nonaktif tidak akan ditampilkan ke publik.</small>
                            </label>
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
@endsection

@push('scripts')
    <script src="{{ asset('js/page/consultation-session/list.js?v=' . time()) }}"></script>
@endpush