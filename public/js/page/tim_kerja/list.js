let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "tim_kerja/data",
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
        $("#form-tim-kerja")[0].reset();
        $("#id").val("");
        $("#existing-images").html("");
        $("#preview-images").html("");
        $("#modal-tim-kerja").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $.get(BASE_URL + "tim_kerja/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#title").val(data.title);
                $("#description").val(data.description);

                let existingHtml = "";
                data.images.forEach((img) => {
                    existingHtml += `
                        <div class="col-md-3 mb-2 text-center" id="img-container-${img.id}">
                            <img src="${BASE_URL}storage/${img.image}" class="img-thumbnail" style="height: 100px;">
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" name="deleted_images[]" value="${img.id}">
                                <label class="form-check-label text-danger">Hapus</label>
                            </div>
                        </div>
                    `;
                });
                $("#existing-images").html(existingHtml);
                $("#preview-images").html("");
                $("#modal-tim-kerja").modal("show");
            }
        });
    });

    $("#form-tim-kerja").on("submit", function (e) {
        e.preventDefault();

        let id = $("#id").val();
        let url = id
            ? BASE_URL + "tim_kerja/update"
            : BASE_URL + "tim_kerja/store";

        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-tim-kerja .modal-content").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-tim-kerja .modal-content").LoadingOverlay("hide");
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-tim-kerja").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                $("#modal-tim-kerja .modal-content").LoadingOverlay("hide");
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
            title: "Hapus Tim Kerja?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "tim_kerja/delete",
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
