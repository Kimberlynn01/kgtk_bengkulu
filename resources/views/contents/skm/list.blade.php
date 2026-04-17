@extends('layouts.app')

@php
    $plugins = ['datatable'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-sm-12 text-right mb-2">
            <div class="bookmark">
                <ul>
                    <li><a href="javascript:void(0)" class="btn-tambah" title="Tambah SKM"><i
                                data-feather="plus-square"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card b-1-primary">
                <div class="card-header pb-0">
                    <h5>Daftar Survey Kepuasan Masyarakat</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Judul</th>
                                    <th>Link</th>
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
    <div id="modal-skm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-skmLabel"
        aria-hidden="true">
        <form action="{{ route('skm.store') }}" method="post" id="form-skm">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-skmLabel">Form SKM</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label for="title">Judul Survey</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Masukkan Judul Survey" required>
                            <div id="error-title"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                            <div id="error-description"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="link">Link Survey (Google Form, dsb)</label>
                            <input type="url" name="link" id="link" class="form-control"
                                placeholder="https://..." required>
                            <div id="error-link"></div>
                        </div>
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
    <script src="{{ asset('js/page/skm/list.js') }}"></script>
@endpush
