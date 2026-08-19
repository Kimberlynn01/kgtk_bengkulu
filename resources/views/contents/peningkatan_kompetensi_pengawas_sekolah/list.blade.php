@extends('layouts.app')

@section('contents')
    <div class="row">
        <div class="col-sm-12">
            <div class="card b-1-primary">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5>Peningkatan Kompetensi Pengawas Sekolah</h5>
                    <a href="javascript:void(0)" id="btn-edit" class="btn btn-primary btn-sm">
                        <i data-feather="edit-2" style="width:16px;height:16px;"></i>
                        <span id="btn-edit-label">{{ $peningkatan_kompetensi_pengawas_sekolah ? 'Edit Data' : 'Tambah Data' }}</span>
                    </a>
                </div>
                <div class="card-body">
                    <div id="empty-state" style="{{ $peningkatan_kompetensi_pengawas_sekolah ? 'display:none;' : '' }}">
                        <p class="text-muted mb-0">Belum ada data. Klik "Tambah Data" untuk mengisi.</p>
                    </div>
                    <div id="data-state" style="{{ $peningkatan_kompetensi_pengawas_sekolah ? '' : 'display:none;' }}">
                        <img id="preview-image" src="{{ $peningkatan_kompetensi_pengawas_sekolah ? $peningkatan_kompetensi_pengawas_sekolah->image_url : '' }}" alt="Peningkatan Kompetensi Pengawas Sekolah"
                            class="img-fluid rounded mb-3" style="max-height:280px;">
                        <p id="preview-deskripsi" class="mb-0">{{ $peningkatan_kompetensi_pengawas_sekolah ? $peningkatan_kompetensi_pengawas_sekolah->deskripsi : '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div id="modal-peningkatan-kompetensi-pengawas-sekolah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-peningkatan-kompetensi-pengawas-sekolahLabel"
        aria-hidden="true">
        <form action="{{ route('peningkatan_kompetensi_pengawas_sekolah.save') }}" method="post" id="form-peningkatan-kompetensi-pengawas-sekolah" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-peningkatan-kompetensi-pengawas-sekolahLabel">Form Peningkatan Kompetensi Pengawas Sekolah</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="image">Gambar <span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <small class="text-muted">Maks 2MB. Kosongkan jika tidak ingin mengganti gambar.</small>
                            <div id="error-image"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required></textarea>
                            <div id="error-deskripsi"></div>
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
    <script src="{{ asset('js/page/peningkatan_kompetensi_pengawas_sekolah/list.js') }}"></script>
@endpush
