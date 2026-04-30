@extends('layouts.app')

@php
$plugins = ['datatable'];
@endphp

@section('contents')
<div class="row">
    @if (rbacCheck('pengguna', 2))
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
    @endif
    <div class="col-sm-12">
        <div class="card b-1-primary">
            <div class="card-header pb-0">
                <h5>Daftar otoritas yang terdaftar dalam sistem</h5>
            </div>
            <div class="card-body">
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('affected'))
                <div class="alert alert-success" role="alert">
                    Data berhasil disimpan!
                </div>
                @endif
                <div class="table-responsive" data-pattern="priority-columns">
                    <table class="table table-striped" id="table-data" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>Nama Otoritas</th>
                                <th>Aksi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- sample modal content -->
<div id="modal-otoritas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-otoritasLabel"
    aria-hidden="true">
    <form action="{{ route('otoritas.store') }}" method="post" id="form-otoritas" autocomplete="off">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="modal-otoritasLabel">Form Otoritas</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Otoritas</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Masukkan Nama Otoritas" required>
                        <div id="error-name"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

<!-- sample modal content -->
<div id="modal-otoritas-update" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="modal-otoritas-updateLabel" aria-hidden="true">
    <form action="{{ route('otoritas.update') }}" method="post" id="form-otoritas-update" autocomplete="off">
        <input type="hidden" name="id" id="update-id">
        @method('PATCH')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="modal-otoritas-updateLabel">Form Otoritas</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="update-name">Nama Otoritas</label>
                        <input type="text" name="name" id="update-name" class="form-control"
                            placeholder="Masukkan Nama Otoritas" required>
                        <div id="error-update-name"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->
@endsection

@push('scripts')
@jsScript(js/page/otoritas/list.js)
@endpush
