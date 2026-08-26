@extends('layouts.app')

@section('contents')
<div class="row">
    <div class="col-sm-12">
        <div class="card b-r-0 border-primary">
            <div class="card-header pb-0">
                <h5>Kelola Navbar Front-End</h5>
                <p class="text-muted small mb-0">Anda hanya bisa mengubah <strong>nama tampilan</strong> dan <strong>status aktif/nonaktif</strong> menu. Tautan (link) tidak dapat diubah di sini.</p>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($menus as $menu)
                        @include('contents.navbar-menu._item', ['menu' => $menu, 'level' => 0])
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="modal-navbar" class="modal fade" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-navbar" action="javascript:void(0);">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Menu Navbar</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="navbar-id">
                    <div class="form-group mb-3">
                        <label class="fw-bold">Nama Menu</label>
                        <input type="text" name="name" id="navbar-name" class="form-control" required>
                        <div id="error-name" class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="navbar-is-active">
                        <label class="form-check-label" for="navbar-is-active">
                            Tampilkan di navbar
                            <br><small class="text-muted">Nonaktifkan untuk menyembunyikan menu ini beserta sub-menunya dari website publik.</small>
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
<script src="{{ asset('js/page/navbar-menu/list.js?v=' . time()) }}"></script>
@endpush