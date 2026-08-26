@extends('layouts.app')
@php $plugins = ['datatable']; @endphp

@section('contents')
<div class="row">
    <div class="col-sm-12 text-right mb-2">
        <div class="bookmark">
            <ul class="list-unstyled m-0 d-flex justify-content-end gap-2">
                <li><a href="{{ route('ptk') }}" class="btn btn-secondary btn-sm">Kembali ke Data PTK</a></li>
                <li><button type="button" class="btn btn-primary btn-sm btn-add-field">+ Tambah Field</button></li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card b-r-0 border-primary">
            <div class="card-header pb-0"><h5>Struktur Field Data PTK</h5></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-field" style="width:100%;">
                        <thead>
                            <tr>
                                <th>#</th><th>Label</th><th>Tipe</th><th>Pilihan</th><th>Filter Rekap</th><th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-field" class="modal fade" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-field" action="javascript:void(0);">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-field-title">Tambah Field</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="field-id">
                    <div class="form-group mb-3">
                        <label class="fw-bold">Nama Field</label>
                        <input type="text" name="label" id="field-label" class="form-control" placeholder="Contoh: Jenjang, Instansi, No. HP" required>
                        <div id="error-label" class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold">Tipe Field</label>
                        <select name="type" id="field-type" class="form-control">
                            <option value="text">Teks</option>
                            <option value="number">Angka</option>
                            <option value="select">Pilihan (Dropdown)</option>
                            <option value="date">Tanggal</option>
                        </select>
                    </div>
                    <div class="form-group mb-3" id="field-options-wrapper" style="display:none;">
                        <label class="fw-bold">Daftar Pilihan (satu per baris)</label>
                        <textarea name="options" id="field-options" class="form-control" rows="5" placeholder="PAUD&#10;SD&#10;SMP&#10;SMA"></textarea>
                        <div id="error-options" class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="1" name="is_required" id="field-required">
                        <label class="form-check-label" for="field-required">Wajib diisi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_filterable" id="field-filterable">
                        <label class="form-check-label" for="field-filterable">Bisa dipakai untuk Rekap Pivot <small class="text-muted">(khusus tipe Pilihan)</small></label>
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
<script src="{{ asset('js/page/ptk-field/list.js?v=' . time()) }}"></script>
@endpush