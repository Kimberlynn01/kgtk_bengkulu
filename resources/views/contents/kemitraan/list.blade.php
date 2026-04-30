@extends('layouts.app')

@php
    $plugins = ['datatable'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-sm-12 text-right mb-2">
            <div class="bookmark">
                <ul class="list-unstyled m-0 d-flex justify-content-end">
                    <li>
                        <a href="javascript:void(0)" class="btn-tambah btn btn-sm  d-inline-flex align-items-center px-3"
                            style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="plus" style="width: 16px; height: 16px;"></i>
                            <span>Tambah Data</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card b-1-primary">
                <div class="card-header pb-0">
                    <h5>Daftar Kemitraan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Store/Update -->
    <div id="modal-kemitraan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-kemitraanLabel"
        aria-hidden="true">
        <form action="{{ route('kemitraan.store') }}" method="post" id="form-kemitraan" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-kemitraanLabel">Form Kemitraan</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label for="title">Judul Kemitraan</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Masukkan Judul" required>
                            <div id="error-title"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            <div id="error-description"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="files">File Pendukung (Multiple)</label>
                            <input type="file" name="files[]" id="files" class="form-control" multiple
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                            <div id="error-files"></div>
                        </div>
                        <div id="existing-files" class="mt-2 row"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/kemitraan/list.js') }}"></script>
@endpush
