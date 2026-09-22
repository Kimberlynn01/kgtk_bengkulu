// public/js/page/informasi_berkala/list.js
let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "ppid/informasi-berkala/data",
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            { data: "nama_dokumen" },
            { data: "tahun" },
            {
                data: "file",
                orderable: false,
                searchable: false,
                render: (data, type, row) => {
                    if (!data) return "-";
                    let url = row.file_url ? row.file_url : `${BASE_URL}storage/${data}`;
                    return `<a href="${url}" target="_blank" class="btn btn-sm btn-info"><i class="icofont icofont-download"></i> Lihat</a>`;
                },
            },
            {
                data: "id",
                orderable: false,
                searchable: false,
                render: (data, type, row) => {
                    return `
                        <div class="btn-group">
                            <button class="btn btn-primary btn-update" data-id="${data}"><i class="icofont icofont-ui-edit"></i></button>
                            <button class="btn btn-danger btn-delete" data-id="${data}"><i class="icofont icofont-trash"></i></button>
                        </div>
                    `;
                },
            },
        ],
    });

    // Validasi Ukuran & Tipe File (Max 20MB, hanya docx & pdf)
    $(document).on("change", 'input[name="file"]', function () {
        const file = this.files[0];
        if (!file) return;

        const maxSize = 20 * 1024 * 1024; // 20MB
        const allowedExt = ["docx", "pdf"];
        const ext = file.name.split(".").pop().toLowerCase();

        if (!allowedExt.includes(ext)) {
            App.showToastr.error("Format Tidak Didukung", "Hanya file .docx dan .pdf yang diperbolehkan.");
            $(this).val("");
            return false;
        }

        if (file.size > maxSize) {
            App.showToastr.error("File Terlalu Besar", `File "${file.name}" melebihi 20MB.`);
            $(this).val("");
            return false;
        }
    });

    // Reset Form Modal Tambah Data
    $(".btn-tambah").on("click", function () {
        $("#form-informasi-berkala")[0].reset();
        $("#id").val("");
        $('input[name="file"]').val("").attr("required", true);
        $("#existing-file").html("");
        $("#modal-informasi-berkala").modal("show");
    });

    // Load Data untuk Edit
    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");

        $("#form-informasi-berkala")[0].reset();
        $('input[name="file"]').val("").attr("required", false);

        $.get(BASE_URL + "ppid/informasi-berkala/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#nama_dokumen").val(data.nama_dokumen);
                $("#tahun").val(data.tahun);

                let existingHtml = "";
                if (data.file) {
                    let baseUrlClean = BASE_URL.replace(/\/$/, "");
                    let fileUrl = data.file_url ? data.file_url : `${baseUrlClean}/storage/${data.file}`;
                    let fileName = data.file.split("/").pop();

                    existingHtml = `
                        <div class="d-flex align-items-center" style="gap: 10px;">
                            <a href="${fileUrl}" target="_blank" class="btn btn-sm btn-info">
                                <i class="icofont icofont-file-document"></i> ${fileName}
                            </a>
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file</small>
                        </div>
                    `;
                }
                $("#existing-file").html(existingHtml);
                $("#modal-informasi-berkala").modal("show");
            }
        });
    });

    // Submit Form (Store / Update)
    $("#form-informasi-berkala").on("submit", function (e) {
        e.preventDefault();

        let id = $("#id").val();
        let url = id ? BASE_URL + "ppid/informasi-berkala/update" : BASE_URL + "ppid/informasi-berkala/store";

        let formData = new FormData(this);

        // Route update pakai method PATCH -> spoofing lewat _method
        if (id) {
            formData.append("_method", "PATCH");
        }

        $.ajax({
            url: url,
            type: "POST", // WAJIB POST agar PHP mau menangkap file upload multipart; method asli via _method spoofing
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-informasi-berkala .modal-content").LoadingOverlay("show");
                $("#form-informasi-berkala button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-informasi-berkala").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                let res = err.responseJSON;
                if (err.status === 413) {
                    App.showToastr.error("Error", "Ukuran file terlalu besar.");
                } else if (err.status === 422 && res && res.errors) {
                    App.handleErrors.generate(res);
                } else {
                    let msg = res && res.message ? res.message : "Terjadi kesalahan sistem.";
                    App.showToastr.error("Error", msg);
                }
            },
            complete: () => {
                $("#modal-informasi-berkala .modal-content").LoadingOverlay("hide");
                $("#form-informasi-berkala button[type='submit']").attr("disabled", false);
            },
        });
    });

    // Hapus Data
    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Informasi Berkala?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "ppid/informasi-berkala/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        if (res.status) {
                            App.showToastr.success("Sukses", res.message);
                            table.ajax.reload();
                        }
                    }
                ).fail((err) => {
                    let res = err.responseJSON;
                    App.showToastr.error(
                        "Error",
                        res ? res.message : "Gagal menghapus data."
                    );
                });
            }
        });
    });
});