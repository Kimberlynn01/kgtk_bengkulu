let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "kemitraan/data",
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

    $(".btn-tambah").on("click", function () {
        $("#form-kemitraan")[0].reset();
        $("#id").val("");
        $("#existing-files").html("");
        $("#modal-kemitraan").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $.get(BASE_URL + "kemitraan/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#title").val(data.title);
                $("#description").val(data.description);

                let existingHtml = "";
                data.files.forEach((f) => {
                    existingHtml += `
                        <div class="col-md-12 mb-2 d-flex align-items-center justify-content-between" id="file-container-${f.id}">
                            <span><i class="icofont icofont-file-document"></i> ${f.file.split("/").pop()}</span>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="deleted_files[]" value="${f.id}">
                                <label class="form-check-label text-danger">Hapus</label>
                            </div>
                        </div>
                    `;
                });
                $("#existing-files").html(existingHtml);
                $("#modal-kemitraan").modal("show");
            }
        });
    });

    $("#form-kemitraan").on("submit", function (e) {
        e.preventDefault();

        let id = $("#id").val();
        let url = id
            ? BASE_URL + "kemitraan/update"
            : BASE_URL + "kemitraan/store";

        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-kemitraan .modal-content").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-kemitraan .modal-content").LoadingOverlay("hide");
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-kemitraan").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                $("#modal-kemitraan .modal-content").LoadingOverlay("hide");
                if (err.status == 422) {
                    App.handleErrors.generate(err.responseJSON);
                } else {
                    App.showToastr.error("Error", err.responseJSON.message);
                }
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Kemitraan?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "kemitraan/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        if (res.status) {
                            App.showToastr.success("Sukses", res.message);
                            table.ajax.reload();
                        }
                    },
                ).fail((err) => {
                    App.showToastr.error("Error", err.responseJSON.message);
                });
            }
        });
    });
});
