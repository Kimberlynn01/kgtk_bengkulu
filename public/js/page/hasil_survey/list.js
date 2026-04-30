let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "hasil_survey/data",
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
        const files = this.files;
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (files.length > 0) {
            if (files[0].size > maxSize) {
                App.showToastr.error(
                    "File Terlalu Besar",
                    `File "${files[0].name}" melebihi 2MB.`,
                );
                $(this).val(""); // Reset input file
                return false;
            }
        }
    });

    $(".btn-tambah").on("click", function () {
        $("#form-hasil-survey")[0].reset();
        $("#id").val("");
        $('input[type="file"]').val(""); // Reset input file anti-duplikat
        $("#existing-image").html("");
        $("#modal-hasil-survey").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");

        // Reset form & input file sebelum load data baru
        $("#form-hasil-survey")[0].reset();
        $('input[type="file"]').val("");

        $.get(BASE_URL + "hasil_survey/edit/" + id, (res) => {
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
                $("#modal-hasil-survey").modal("show");
            }
        });
    });

    $("#form-hasil-survey").on("submit", function (e) {
        e.preventDefault();

        let id = $("#id").val();
        let url = id
            ? BASE_URL + "hasil_survey/update"
            : BASE_URL + "hasil_survey/store";

        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-hasil-survey .modal-content").LoadingOverlay("show");
                $("#form-hasil-survey button[type='submit']").attr(
                    "disabled",
                    true,
                ); // Anti double-click
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-hasil-survey").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                let res = err.responseJSON;

                // Handle Error 413 (File terlalu besar dari limit server)
                if (err.status === 413) {
                    App.showToastr.error(
                        "Error",
                        "Ukuran file terlalu besar untuk diproses server.",
                    );
                    return;
                }

                // Handle Error 422 (Validation Error dari Laravel)
                if (err.status == 422 && res && res.errors) {
                    App.handleErrors.generate(res);
                } else {
                    let msg =
                        res && res.message
                            ? res.message
                            : "Terjadi kesalahan sistem.";
                    App.showToastr.error("Error", msg);
                }
            },
            complete: () => {
                $("#modal-hasil-survey .modal-content").LoadingOverlay("hide");
                $("#form-hasil-survey button[type='submit']").attr(
                    "disabled",
                    false,
                );
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Hasil Survey?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "hasil_survey/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        if (res.status) {
                            App.showToastr.success("Sukses", res.message);
                            table.ajax.reload();
                        }
                    },
                ).fail((err) => {
                    let res = err.responseJSON;
                    let msg =
                        res && res.message
                            ? res.message
                            : "Gagal menghapus data.";
                    App.showToastr.error("Error", msg);
                });
            }
        });
    });
});
