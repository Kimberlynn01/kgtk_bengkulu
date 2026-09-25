{{-- resources/views/contents/ppid/informasi_dikecualikan/list.blade.php --}}
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
                    <h5>Daftar Informasi Dikecualikan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Nama Dokumen</th>
                                    <th>Tahun</th>
                                    <th>File</th>
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
    <div id="modal-informasi-dikecualikan" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-informasi-dikecualikanLabel" aria-hidden="true">
        <form action="{{ route('ppid-informasi-dikecualikan.store') }}" method="post" id="form-informasi-dikecualikan"
            enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-informasi-dikecualikanLabel">Form Informasi Dikecualikan</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label for="nama_dokumen">Nama Dokumen</label>
                            <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control"
                                placeholder="Masukkan Nama Dokumen" required>
                            <div id="error-nama_dokumen"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tahun">Tahun</label>
                            <input type="number" name="tahun" id="tahun" class="form-control" min="1900"
                                max="{{ date('Y') + 1 }}" placeholder="Masukkan Tahun" required>
                            <div id="error-tahun"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="file">File (docx / pdf)</label>
                            <input type="file" name="file" id="file" class="form-control" accept=".docx,.pdf">
                            <div id="error-file"></div>
                            <div id="existing-file" class="mt-2"></div>
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
    <script src="{{ asset('js/page/ppid/informasi_dikecualikan/list.js') }}"></script>
@endpush