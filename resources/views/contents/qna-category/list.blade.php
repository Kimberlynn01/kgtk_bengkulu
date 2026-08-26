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
                        <button type="button" class="btn btn-primary btn-sm d-inline-flex align-items-center px-3 btn-add-category"
                            style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="plus" style="width:16px;height:16px;"></i>
                            <span>Tambah Kategori</span>
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
                    <h5>Daftar Kategori QnA</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-category" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Nama Kategori</th>
                                    <th>Kepanjangan</th>
                                    <th style="width: 12%;">Jumlah QnA</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-categoryLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-category" method="POST" action="javascript:void(0);" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-categoryLabel">Tambah Kategori</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="category-id">

                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="category-name">Nama Kategori (Singkatan)</label>
                            <input type="text" name="name" id="category-name" class="form-control" placeholder="Contoh: PPG, BCKS, STEM, dst." required>
                            <div id="error-name" class="invalid-feedback d-block"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="category-description">Kepanjangan</label>
                            <input type="text" name="description" id="category-description" class="form-control" placeholder="Contoh: Pendidikan Profesi Guru">
                            <div id="error-description" class="invalid-feedback d-block"></div>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" value="1" name="is_active" id="category-is-active" checked>
                            <label class="form-check-label" for="category-is-active">
                                Aktif
                                <br>
                                <small class="text-muted">Kategori nonaktif tidak akan muncul di form pertanyaan publik.</small>
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
    <script src="{{ asset('js/page/qna-category/list.js?v=' . time()) }}"></script>
@endpush