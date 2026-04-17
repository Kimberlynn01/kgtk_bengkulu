@extends('layouts.app')

@php
    $plugins = ['datatable', 'ckeditor'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-sm-12 text-right mb-2">
            <div class="bookmark">
                <ul>
                    <li><a href="javascript:void(0)" class="btn-tambah" title="Tambah Berita"><i
                                data-feather="plus-square"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card b-1-primary">
                <div class="card-header pb-0">
                    <h5>Daftar Berita KGTK</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Tanggal</th>
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
    <div id="modal-berita" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-beritaLabel"
        aria-hidden="true">
        <form action="{{ route('berita.store') }}" method="post" id="form-berita" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-beritaLabel">Form Berita</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label for="date">Tanggal</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                            <div id="error-date"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="title">Judul Berita</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Masukkan Judul Berita" required>
                            <div id="error-title"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="content">Konten</label>
                            <textarea name="content" id="content" class="form-control ckeditor-content"></textarea>
                            <div id="error-content"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="images">Gambar (Multiple)</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple
                                accept="image/*">
                            <div id="error-images"></div>
                            <div id="preview-images" class="mt-2 row"></div>
                        </div>
                        <div id="existing-images" class="mt-2 row"></div>
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
    <script src="{{ asset('js/page/berita/list.js') }}"></script>
@endpush
