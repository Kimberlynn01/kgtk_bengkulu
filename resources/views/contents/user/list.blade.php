@extends('layouts.app')

@php
    $plugins = ['datatable'];
@endphp

@section('contents')
    <div class="row">
        @if (rbacCheck('pengguna', 2))
            <div class="col-sm-12 text-right mb-2">
                <div class="bookmark">
                    <ul>
                        <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                                title="Tambah Pengguna" data-original-title="Tables" class="btn-tambah"><i
                                    data-feather="plus-square"></i></a></li>

                    </ul>
                </div>
            </div>
        @endif
        <div class="col-sm-12">
            <div class="card b-1-primary">
                <div class="card-header pb-0">
                    <h5>Daftar pengguna yang terdaftar dalam sistem</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>Status Keaktifan</th>
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
    <div id="modal-pengguna" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-penggunaLabel"
        aria-hidden="true">
        <form action="{{ route('users.store') }}" method="post" id="form-pengguna" autocomplete="off">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-penggunaLabel">Form Pengguna</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email Pengguna</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Masukkan Nama Pengguna" required>
                            <div id="error-email"></div>
                        </div>
                        <div class="form-group">
                            <label for="username">Nama Pengguna</label>
                            <input type="username" name="username" id="username" class="form-control"
                                placeholder="Masukkan Nama Pengguna" required>
                            <div id="error-username"></div>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Masukkan Nama Lengkap" required>
                            <div id="error-name"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan Kata Sandi" required>
                            <div id="error-password"></div>
                        </div>
                        <div class="form-group">
                            <label for="confirmation_password">Konfirmasi Kata Sandi</label>
                            <input type="password" name="confirmation_password" id="confirmation_password"
                                class="form-control" placeholder="Masukkan Konfirmasi Kata Sandi" required>
                            <div id="error-confirmation_password"></div>
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
    <div id="modal-pengguna-update" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-pengguna-updateLabel" aria-hidden="true">
        <form action="{{ route('users.update') }}" method="post" id="form-pengguna-update" autocomplete="off">
            @method('PATCH')
            <input type="hidden" name="id" id="update-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-pengguna-updateLabel">Form Pengguna</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="update-email">Email Pengguna</label>
                            <input type="text" name="email" id="update-email" class="form-control"
                                placeholder="Masukkan Nama Pengguna" required>
                            <div id="error-update-email"></div>
                        </div>
                        <div class="form-group">
                            <label for="update-username">Nama Pengguna</label>
                            <input type="text" name="username" id="update-username" class="form-control"
                                placeholder="Masukkan Nama Pengguna" required>
                            <div id="error-update-username"></div>
                        </div>
                        <div class="form-group">
                            <label for="update-name">Nama Lengkap</label>
                            <input type="text" name="name" id="update-name" class="form-control"
                                placeholder="Masukkan Nama Lengkap" required>
                            <div id="error-update-name"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->

    <!-- sample modal content -->
    <div id="modal-update-role" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-update-roleLabel" aria-hidden="true">
        <form action="{{ route('users.update.roles') }}" method="post" id="form-update-role" autocomplete="off">
            @method('PATCH')
            <input type="hidden" name="id" id="update-role-user-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-update-roleLabel">Peran Pengguna : <b
                                class="user-name"></b>
                        </h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                @foreach ($roles as $role)
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkbox-role"
                                                name="role_id[]" id="role-{{ $role->id }}"
                                                value="{{ $role->id }}">
                                            <label class="custom-control-label"
                                                for="role-{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->
@endsection

@push('scripts')
    @jsScript(js/page/pengguna/list.js)
@endpush
