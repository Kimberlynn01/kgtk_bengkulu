// public/js/page/ppid/layanan_informasi/list.js
let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "ppid/layanan-informasi/data",
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

    $(document).on("change", 'input[name="file"]', function () {
        const file = this.files[0];
        if (!file) return;

        const maxSize = 20 * 1024 * 1024;
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

    $(".btn-tambah").on("click", function () {
        $("#form-layanan-informasi")[0].reset();
        $("#id").val("");
        $('input[name="file"]').val("").attr("required", true);
        $("#existing-file").html("");
        $("#modal-layanan-informasi").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $("#form-layanan-informasi")[0].reset();
        $('input[name="file"]').val("").attr("required", false);

        $.get(BASE_URL + "ppid/layanan-informasi/edit/" + id, (res) => {
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
                $("#modal-layanan-informasi").modal("show");
            }
        });
    });

    $("#form-layanan-informasi").on("submit", function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let url = id ? BASE_URL + "ppid/layanan-informasi/update" : BASE_URL + "ppid/layanan-informasi/store";
        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-layanan-informasi .modal-content").LoadingOverlay("show");
                $("#form-layanan-informasi button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-layanan-informasi").modal("hide");
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
                    App.showToastr.error("Error", res ? res.message : "Terjadi kesalahan sistem.");
                }
            },
            complete: () => {
                $("#modal-layanan-informasi .modal-content").LoadingOverlay("hide");
                $("#form-layanan-informasi button[type='submit']").attr("disabled", false);
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Layanan Informasi?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "ppid/layanan-informasi/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        if (res.status) {
                            App.showToastr.success("Sukses", res.message);
                            table.ajax.reload();
                        }
                    }
                ).fail((err) => {
                    let res = err.responseJSON;
                    App.showToastr.error("Error", res ? res.message : "Gagal menghapus data.");
                });
            }
        });
    });
});