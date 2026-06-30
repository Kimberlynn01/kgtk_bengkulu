let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "data_sasaran/data",
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            { data: "title" },
            {
                data: "id",
                render: (data) => {
                    return `
                        <div class="btn-group">
                            <button class="btn btn-primary btn-update" data-id="${data}"><i class="icofont icofont-ui-edit"></i></button>
                            <button class="btn btn-danger btn-delete" data-id="${data}"><i class="icofont icofont-trash"></i></button>
                        </div>
                    `;
                },
                searchable: false,
                orderable: false,
            },
        ],
    });

    $(document).on("change", 'input[type="file"]', function () {
        if (this.files.length > 0 && this.files[0].size > 20 * 1024 * 1024) {
            App.showToastr.error("File Terlalu Besar", "File melebihi 20MB.");
            $(this).val("");
            return false;
        }
    });

    $(".btn-tambah").on("click", function () {
        $("#form-data-sasaran")[0].reset();
        $("#id").val("");
        $('input[type="file"]').val("");
        $("#existing-file").html("");
        $("#modal-data-sasaran").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $("#form-data-sasaran")[0].reset();
        $('input[type="file"]').val("");

        $.get(BASE_URL + "data_sasaran/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#title").val(data.title);
                $("#description").val(data.description);

                if (data.file) {
                    let filename = data.file.split("/").pop();
                    $("#existing-file").html(
                        `<div class="mt-2 border p-2 rounded shadow-sm">
                            <label class="d-block font-weight-bold">File Saat Ini:</label>
                            <a href="${BASE_URL}storage/${data.file}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                <i class="icofont icofont-file-document"></i> ${filename}
                            </a>
                        </div>`,
                    );
                } else {
                    $("#existing-file").html("");
                }
                $("#modal-data-sasaran").modal("show");
            }
        });
    });

    $("#form-data-sasaran").on("submit", function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let url = id
            ? BASE_URL + "data_sasaran/update"
            : BASE_URL + "data_sasaran/store";
        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-data-sasaran .modal-content").LoadingOverlay("show");
                $("#form-data-sasaran button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-data-sasaran").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                let res = err.responseJSON;
                if (err.status == 422 && res && res.errors) {
                    App.handleErrors.generate(res);
                } else {
                    App.showToastr.error("Error", res ? res.message : "Sistem error");
                }
            },
            complete: () => {
                $("#modal-data-sasaran .modal-content").LoadingOverlay("hide");
                $("#form-data-sasaran button[type='submit']").attr("disabled", false);
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Data Sasaran?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "data_sasaran/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        if (res.status) {
                            App.showToastr.success("Sukses", res.message);
                            table.ajax.reload();
                        }
                    },
                ).fail((err) => {
                    let res = err.responseJSON;
                    App.showToastr.error("Error", res ? res.message : "Gagal menghapus data.");
                });
            }
        });
    });
});
