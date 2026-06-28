let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "informasi_program/data",
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            { data: "title" },
            {
                data: "id",
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

    // Validasi Ukuran File
    $(document).on("change", 'input[type="file"]', function () {
        for (let i = 0; i < this.files.length; i++) {
            if (this.files[i].size > 20 * 1024 * 1024) {
                App.showToastr.error("Error", "File melebihi 20MB.");
                $(this).val("");
                return false;
            }
        }
    });

    $(".btn-tambah").on("click", function () {
        $("#form-informasi-program")[0].reset();
        $("#id").val("");
        $('input[type="file"]').val("");
        $("#existing-files").html("");
        $("#modal-informasi-program").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $("#form-informasi-program")[0].reset();
        $('input[type="file"]').val("");

        $.get(BASE_URL + "informasi_program/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#title").val(data.title);

                let existingHtml = "";
                data.files.forEach((f) => {
                    existingHtml += `
                        <div class="col-md-12 mb-2 p-2 border rounded d-flex align-items-center justify-content-between" id="file-container-${f.id}">
                            <span><i class="icofont icofont-file-document"></i> ${f.file.split("/").pop()}</span>
                            <div class="form-check d-flex align-items-center m-0">
                                <input class="form-check-input" type="checkbox" name="deleted_files[]" value="${f.id}" id="del-file-ip-${f.id}" style="cursor: pointer;">
                                <label class="form-check-label text-danger mb-0 ms-2" for="del-file-ip-${f.id}" style="cursor: pointer; font-size: 13px; font-weight: bold;">Hapus</label>
                            </div>
                        </div>
                    `;
                });
                $("#existing-files").html(existingHtml);
                $("#modal-informasi-program").modal("show");
            }
        });
    });

    $("#form-informasi-program").on("submit", function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let url = id
            ? BASE_URL + "informasi_program/update"
            : BASE_URL + "informasi_program/store";
        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-informasi-program .modal-content").LoadingOverlay(
                    "show",
                );
                $("#form-informasi-program button[type='submit']").attr(
                    "disabled",
                    true,
                );
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-informasi-program").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                let res = err.responseJSON;
                if (err.status == 422 && res && res.errors) {
                    App.handleErrors.generate(res);
                } else {
                    App.showToastr.error(
                        "Error",
                        res ? res.message : "Sistem error",
                    );
                }
            },
            complete: () => {
                $("#modal-informasi-program .modal-content").LoadingOverlay(
                    "hide",
                );
                $("#form-informasi-program button[type='submit']").attr(
                    "disabled",
                    false,
                );
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Data?",
            text: "Data akan dihapus permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "informasi_program/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        if (res.status) {
                            App.showToastr.success("Sukses", res.message);
                            table.ajax.reload();
                        }
                    },
                ).fail((err) => {
                    let res = err.responseJSON;
                    App.showToastr.error(
                        "Error",
                        res ? res.message : "Gagal menghapus.",
                    );
                });
            }
        });
    });
});
