let table;
let editor;

$(() => {
    // Initialize CKEditor
    if ($("#content").length > 0) {
        CKEDITOR.replace("content");
        editor = CKEDITOR.instances.content;
    }

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

    $(document).on("change", 'input[type="file"]', function () {
        const maxSize = 20 * 1024 * 1024;
        for (let i = 0; i < this.files.length; i++) {
            if (this.files[i].size > maxSize) {
                App.showToastr.error(
                    "Error",
                    `File "${this.files[i].name}" melebihi 20MB.`,
                );
                $(this).val("");
                return false;
            }
        }
    });

    $(".btn-tambah").on("click", function () {
        $("#form-artikel")[0].reset();
        $("#id").val("");
        if (editor) editor.setData("");

        $('input[type="file"]').val("");
        $("#existing-images").html("");
        $("#preview-images").html("");

        $("#modal-artikel").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");

        // Reset state
        $("#form-artikel")[0].reset();
        $('input[type="file"]').val("");
        $("#preview-images").html("");

        $.get(BASE_URL + "artikel/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);

                // --- PERBAIKAN TANGGAL ---
                // Jika input type="date", formatnya HARUS YYYY-MM-DD
                if (data.date) {
                    let dateVal = data.date.split(" ")[0]; // Mengambil YYYY-MM-DD jika dari DB ada jamnya
                    $("#date").val(dateVal);
                }

                $("#title").val(data.title);
                if (editor) editor.setData(data.content);

                let existingHtml = "";
                if (data.images && data.images.length > 0) {
                    data.images.forEach((img) => {
                        existingHtml += `
                            <div class="col-md-3 mb-3 text-center" id="img-container-${img.id}">
                                <div class="border p-2 rounded shadow-sm">
                                    <img src="${BASE_URL}storage/${img.image}" class="img-thumbnail mb-2" style="height: 100px; width: 100%; object-fit: cover;">
                                    <div class="form-check d-flex justify-content-center align-items-center m-0" style="gap: 5px;">
                                        <input class="form-check-input" type="checkbox" name="deleted_images[]" value="${img.id}" id="del-art-img-${img.id}" style="cursor: pointer;">
                                        <label class="form-check-label text-danger mb-0" for="del-art-img-${img.id}" style="cursor: pointer; font-size: 12px; font-weight: bold;">Hapus</label>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                }

                $("#existing-images").html(existingHtml);
                $("#modal-artikel").modal("show");
            }
        });
    });

    $("#form-artikel").on("submit", function (e) {
        e.preventDefault();
        if (editor) editor.updateElement();

        let id = $("#id").val();
        let url = id ? BASE_URL + "artikel/update" : BASE_URL + "artikel/store";
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
                $("#form-artikel button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-artikel").modal("hide");
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
                        res ? res.message : "Terjadi kesalahan.",
                    );
                }
            },
            complete: () => {
                $("#modal-artikel .modal-content").LoadingOverlay("hide");
                $("#form-artikel button[type='submit']").attr(
                    "disabled",
                    false,
                );
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Artikel?",
            text: "Data akan dihapus permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
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
                    App.showToastr.error("Error", "Gagal menghapus data.");
                });
            }
        });
    });
});
