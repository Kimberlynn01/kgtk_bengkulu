@extends('layouts.app')

@section('contents')
<div class="row">
    <div class="col-sm-12 text-right mb-2">
        <a href="{{ route('ptk') }}" class="btn btn-secondary btn-sm">Kembali ke Data PTK</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card b-r-0 border-primary">
            <div class="card-header pb-0"><h5>Rekapitulasi Data PTK</h5></div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="fw-bold">Baris (contoh: Jenjang)</label>
                        <select id="row-field" class="form-control">
                            @foreach ($filterFields as $f)
                                <option value="{{ $f->key }}" {{ $f->key === 'jenjang' ? 'selected' : '' }}>{{ $f->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Kolom (contoh: Jabatan)</label>
                        <select id="col-field" class="form-control">
                            @foreach ($filterFields as $f)
                                <option value="{{ $f->key }}" {{ $f->key === 'jabatan' ? 'selected' : '' }}>{{ $f->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button id="btn-generate" class="btn btn-primary">Tampilkan Rekap</button>
                        @if (rbacCheck('ptk', 5))
                        <button id="btn-export" class="btn btn-success">Export Excel</button>
                        @endif
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="table-recap">
                        <thead id="recap-thead"></thead>
                        <tbody id="recap-tbody"></tbody>
                        <tfoot id="recap-tfoot"></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/page/ptk-recap/list.js?v=' . time()) }}"></script>
@endpush