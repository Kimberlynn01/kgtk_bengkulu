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
                    @if (rbacCheck('ptk', 5))
                    <li>
                        <a href="{{ route('ptk.import-template') }}" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center px-3" style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="download" style="width:16px;height:16px;"></i>
                            <span>Download Template</span>
                        </a>
                    </li>
                    @endif

                    @if (rbacCheck('ptk', 1))
                    <li>
                        <a href="{{ route('ptk-field') }}" class="btn btn-secondary btn-sm d-inline-flex align-items-center px-3" style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="settings" style="width:16px;height:16px;"></i>
                            <span>Kelola Field</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ptk.recap') }}" class="btn btn-info btn-sm d-inline-flex align-items-center px-3" style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="pie-chart" style="width:16px;height:16px;"></i>
                            <span class="text-white">Rekapitulasi</span>
                        </a>
                    </li>
                    @endif

                    @if (rbacCheck('ptk', 2))
                    <li>
                        <button type="button" class="btn btn-success btn-sm btn-import d-inline-flex align-items-center px-3" style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="upload" style="width:16px;height:16px;"></i>
                            <span>Import Excel</span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-primary btn-sm btn-add d-inline-flex align-items-center px-3" style="height: 34px; border-radius: 6px; font-weight: 500; font-size: 13px; gap: 8px;">
                            <i data-feather="plus" style="width:16px;height:16px;"></i>
                            <span>Tambah Data</span>
                        </button>
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
                    <h5>Data Pendidik & Tenaga Kependidikan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-ptk" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 4%;">#</th>
                                    @foreach ($fields as $field)
                                        <th>{{ $field->label }}</th>
                                    @endforeach
                                    <th>Jumlah</th>
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

    {{-- Modal Tambah / Edit Data --}}
    <div id="modal-ptk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-ptkLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-ptk" method="POST" action="javascript:void(0);" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-ptk-title">Tambah Data</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="ptk-id">

                        @foreach ($fields as $field)
                            <div class="form-group mb-3">
                                <label class="fw-bold">
                                    {{ $field->label }}
                                    @if ($field->is_required)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>

                                @if ($field->type === 'select')
                                    <select class="form-control field-input" data-key="{{ $field->key }}" {{ $field->is_required ? 'required' : '' }}>
                                        <option value="">-- Pilih {{ $field->label }} --</option>
                                        @foreach ($field->options ?? [] as $opt)
                                            <option value="{{ $opt }}">{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                @elseif ($field->type === 'date')
                                    <input type="date" class="form-control field-input" data-key="{{ $field->key }}" {{ $field->is_required ? 'required' : '' }}>
                                @elseif ($field->type === 'number')
                                    <input type="number" class="form-control field-input" data-key="{{ $field->key }}" {{ $field->is_required ? 'required' : '' }}>
                                @else
                                    <input type="text" class="form-control field-input" data-key="{{ $field->key }}" {{ $field->is_required ? 'required' : '' }}>
                                @endif

                                <div id="error-fields.{{ $field->key }}" class="invalid-feedback d-block"></div>
                            </div>
                        @endforeach

                        <div class="form-group mb-3">
                            <label class="fw-bold">Jumlah <span class="text-danger">*</span></label>
                            <input type="number" id="ptk-jumlah" class="form-control" min="0" placeholder="Contoh: 15709" required>
                            <div id="error-jumlah" class="invalid-feedback d-block"></div>
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

    <div id="modal-import" class="modal fade" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-import" method="POST" action="javascript:void(0);" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Import Data dari Excel</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted small">
                            Gunakan template resmi agar kolom sesuai.
                            <a href="{{ route('ptk.import-template') }}">Download template di sini</a>.
                        </p>
                        <div class="form-group mb-3">
                            <label class="fw-bold">File Excel (.xlsx)</label>
                            <input type="file" name="file" id="import-file" class="form-control" accept=".xlsx,.xls" required>
                            <div id="error-file" class="invalid-feedback d-block"></div>
                        </div>
                        <div id="import-result" class="mt-3" style="display:none;">
                            <div class="alert" id="import-alert"></div>
                            <ul id="import-error-list" class="small text-danger mb-0"></ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Upload & Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/ptk/list.js?v=' . time()) }}"></script>
@endpush