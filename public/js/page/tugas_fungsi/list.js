let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "tugas_fungsi/data",
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

    // VALIDASI UKURAN FILE (2MB)
    $(document).on("change", 'input[type="file"]', function () {
        if (this.files.length > 0 && this.files[0].size > 2 * 1024 * 1024) {
            App.showToastr.error("File Terlalu Besar", "File melebihi 2MB.");
            $(this).val("");
            return false;
        }
    });

    $(".btn-tambah").on("click", function () {
        $("#form-tugas-fungsi")[0].reset();
        $("#id").val("");
        $('input[type="file"]').val("");
        $("#existing-image").html("");
        $("#modal-tugas-fungsi").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $("#form-tugas-fungsi")[0].reset();
        $('input[type="file"]').val("");

        $.get(BASE_URL + "tugas_fungsi/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#title").val(data.title);
                $("#description").val(data.description);

                if (data.image) {
                    $("#existing-image").html(
                        `<div class="mt-2 border p-2 text-center rounded shadow-sm">
                            <label class="d-block font-weight-bold">Gambar Saat Ini:</label>
                            <img src="${BASE_URL}storage/${data.image}" class="img-thumbnail" style="height: 150px;">
                        </div>`,
                    );
                } else {
                    $("#existing-image").html("");
                }
                $("#modal-tugas-fungsi").modal("show");
            }
        });
    });

    $("#form-tugas-fungsi").on("submit", function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let url = id
            ? BASE_URL + "tugas_fungsi/update"
            : BASE_URL + "tugas_fungsi/store";
        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-tugas-fungsi .modal-content").LoadingOverlay("show");
                $("#form-tugas-fungsi button[type='submit']").attr(
                    "disabled",
                    true,
                );
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-tugas-fungsi").modal("hide");
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
                $("#modal-tugas-fungsi .modal-content").LoadingOverlay("hide");
                $("#form-tugas-fungsi button[type='submit']").attr(
                    "disabled",
                    false,
                );
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Tugas Fungsi?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "tugas_fungsi/delete",
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
                        res ? res.message : "Gagal menghapus data.",
                    );
                });
            }
        });
    });
});
