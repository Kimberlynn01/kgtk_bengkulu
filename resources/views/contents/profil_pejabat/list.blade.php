@extends('layouts.app')

@php
    $plugins = ['datatable'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-sm-12 text-right mb-2">
            <div class="bookmark">
                <ul>
                    <li><a href="javascript:void(0)" class="btn-tambah" title="Tambah Profil Pejabat"><i
                                data-feather="plus-square"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card b-1-primary">
                <div class="card-header pb-0">
                    <h5>Daftar Profil Pejabat</h5>
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
    <div id="modal-profil-pejabat" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-profil-pejabatLabel" aria-hidden="true">
        <form action="{{ route('profil_pejabat.store') }}" method="post" id="form-profil-pejabat"
            enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-profil-pejabatLabel">Form Profil Pejabat</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label for="title">Judul/Jabatan</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Masukkan Judul" required>
                            <div id="error-title"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="images">Gambar Profil (Multiple)</label>
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
    <script src="{{ asset('js/page/profil_pejabat/list.js') }}"></script>
@endpush
