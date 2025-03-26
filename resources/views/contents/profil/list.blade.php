@extends('layouts.app')

@php
    $plugins = ['select2'];
@endphp

@section('contents')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-12">
                    <form class="card" id="form-profil" action="{{ route('profil.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ encrypt($user->id) }}">

                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Profil Akun</h4>
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                data-bs-target="#modalChangePassword">
                                <i class="icofont icofont-key"></i> Ubah Password
                            </button>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input class="form-control @error('nama_lengkap') is-invalid @enderror"
                                            type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan nama"
                                            value="{{ old('nama_lengkap', @$user->name) }}" >
                                        <div class="invalid-feedback">
                                            @error('nama_lengkap')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            type="text" name="tempat_lahir" id="tempat_lahir"
                                            placeholder="Masukkan tempat lahir"
                                            value="{{ old('tempat_lahir', @$profil->tempat_lahir) }}" >
                                        <div class="invalid-feedback">
                                            @error('tempat_lahir')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            type="date" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', @$profil->tanggal_lahir) }}" id="tanggal_lahir"
                                            >
                                        <div class="invalid-feedback">
                                            @error('tanggal_lahir')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="text"
                                            placeholder="Masukkan email" name="email" id="email"
                                            value="{{ old('email', @$profil->email) }}" >
                                        <div class="invalid-feedback">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">No HP</label>
                                        <input class="form-control @error('no_hp') is-invalid @enderror" type="text"
                                            placeholder="Masukkan no hp" name="no_hp" id="no_hp"
                                            value="{{ old('no_hp', @$profil->no_hp) }}" >
                                        <div class="invalid-feedback">
                                            @error('no_hp')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" rows="5" placeholder="Masukkan alamat"
                                            name="alamat" id="alamat" >{{ old('alamat', @$profil->alamat) }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('alamat')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Change Password -->
    <div class="modal fade" id="modalChangePassword" tabindex="-1" aria-labelledby="modalChangePasswordLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalChangePasswordLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formChangePassword">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Lama</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password"
                                    name="current_password" placeholder="Masukkan Password Lama" >
                                <button class="btn btn-outline-primary toggle-password" type="button"
                                    data-target="#current_password">
                                    <i class="icofont icofont-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="Masukkan Password Baru" >
                                <button class="btn btn-outline-primary toggle-password" type="button"
                                    data-target="#new_password">
                                    <i class="icofont icofont-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" placeholder="Masukkan Konfirmasi Password Baru" >
                                <button class="btn btn-outline-primary toggle-password" type="button"
                                    data-target="#confirm_password">
                                    <i class="icofont icofont-eye"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/profil/list.js') }}?v={{ time() }}"></script>
@endpush
