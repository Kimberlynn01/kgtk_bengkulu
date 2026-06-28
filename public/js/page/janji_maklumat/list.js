let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "janji_maklumat/data",
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


    $(document).on("change", 'input[type="file"]', function () {
        const files = this.files;
        const maxSize = 20 * 1024 * 1024;

        for (let i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                App.showToastr.error(
                    "File Terlalu Besar",
                    `File "${files[i].name}" melebihi 20MB.`,
                );
                $(this).val(""); // Reset input agar file tidak terkirim
                return false;
            }
        }
    });

    $(".btn-tambah").on("click", function () {
        $("#form-janji-maklumat")[0].reset();
        $("#id").val("");
        $("#images").val(""); // Pastikan input file bersih
        $("#existing-images").html("");
        $("#preview-images").html("");
        $("#modal-janji-maklumat").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");

        // Reset form dan input file sebelum load data untuk mencegah duplikasi state
        $("#form-janji-maklumat")[0].reset();
        $("#images").val("");
        $("#preview-images").html("");

        $.get(BASE_URL + "janji_maklumat/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#title").val(data.title);

                let existingHtml = "";
                data.images.forEach((img) => {
                    existingHtml += `
                        <div class="col-md-3 mb-3 text-center" id="img-container-${img.id}">
                            <div class="border p-2 rounded shadow-sm">
                                <img src="${BASE_URL}storage/${img.image}" class="img-thumbnail mb-2" style="height: 100px; width: 100%; object-fit: cover;">
                                <div class="form-check d-flex justify-content-center align-items-center m-0" style="gap: 5px;">
                                    <input class="form-check-input" type="checkbox" name="deleted_images[]" value="${img.id}" id="del-img-${img.id}" style="cursor: pointer;">
                                    <label class="form-check-label text-danger mb-0" for="del-img-${img.id}" style="cursor: pointer; font-size: 12px; font-weight: bold;">
                                        Hapus
                                    </label>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $("#existing-images").html(existingHtml);
                $("#modal-janji-maklumat").modal("show");
            }
        });
    });

    $("#form-janji-maklumat").on("submit", function (e) {
        e.preventDefault();

        let id = $("#id").val();
        let url = id
            ? BASE_URL + "janji_maklumat/update"
            : BASE_URL + "janji_maklumat/store";

        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-janji-maklumat .modal-content").LoadingOverlay(
                    "show",
                );
                $("#form-janji-maklumat button[type='submit']").attr(
                    "disabled",
                    true,
                ); // Anti double-click
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-janji-maklumat").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                let res = err.responseJSON;
                if (err.status === 413) {
                    App.showToastr.error(
                        "Error",
                        "Ukuran total file terlalu besar.",
                    );
                } else if (err.status == 422 && res && res.errors) {
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
                $("#modal-janji-maklumat .modal-content").LoadingOverlay(
                    "hide",
                );
                $("#form-janji-maklumat button[type='submit']").attr(
                    "disabled",
                    false,
                );
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Janji & Maklumat?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "janji_maklumat/delete",
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
