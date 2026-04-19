@extends('layouts.app')

@php
    $plugins = ['datatable'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-sm-12">
            <div class="card b-r-0 border-primary">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5>Daftar Pertanyaan & Jawaban (QnA)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Nama Penanya</th>
                                    <th>Kategori</th>
                                    <th>Pertanyaan</th>
                                    <th>Status</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-qna" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-qnaLabel"
        aria-hidden="true">
        <form action="#" method="post" id="form-qna">
            @csrf
            @method('PATCH')
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-qnaLabel">Form Jawab Pertanyaan</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fw-bold">Penanya:</label>
                                <p id="show-name" class="text-muted"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Kategori:</label>
                                <p id="show-category" class="text-muted"></p>
                            </div>
                            <div class="col-12">
                                <label class="fw-bold">Isi Pertanyaan:</label>
                                <div class="p-3 bg-light rounded" id="show-question"></div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group mb-3">
                            <label for="answer" class="fw-bold text-primary">Jawaban Admin</label>
                            <textarea name="answer" id="answer" class="form-control" rows="6" placeholder="Masukkan jawaban resmi..."
                                required></textarea>
                            <div id="error-answer"></div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_published" checked
                                disabled>
                            <label class="form-check-label text-muted" for="is_published small">
                                Pertanyaan yang dijawab akan otomatis tampil di Landing Page.
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    {{-- Pastikan folder dan file js ini sudah kamu buat --}}
    <script src="{{ asset('js/page/qna/list.js') }}"></script>
@endpush
