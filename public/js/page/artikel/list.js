let table;
let editor;

$(() => {
    // Initialize CKEditor
    CKEDITOR.replace("content");
    editor = CKEDITOR.instances.content;

    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "artikel/data",
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            { data: "date" },
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
        $("#form-artikel")[0].reset();
        $("#id").val("");
        editor.setData("");
        $("#existing-images").html("");
        $("#preview-images").html("");
        $("#modal-artikel").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $.get(BASE_URL + "artikel/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#date").val(data.date);
                $("#title").val(data.title);
                editor.setData(data.content);

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
                $("#modal-artikel").modal("show");
            }
        });
    });

    $("#form-artikel").on("submit", function (e) {
        e.preventDefault();
        editor.updateElement();

        let id = $("#id").val();
        let url = id ? BASE_URL + "artikel/update" : BASE_URL + "artikel/store";
        let method = "POST"; // Both store and update use POST (update uses _method PATCH if needed, but I'll use POST with payload if my controller supports it or specify it in form)

        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-artikel .modal-content").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-artikel .modal-content").LoadingOverlay("hide");
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-artikel").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                $("#modal-artikel .modal-content").LoadingOverlay("hide");
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
            title: "Hapus Artikel?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "artikel/delete",
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
