let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "visi_misi/data",
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
        const maxSize = 20 * 1024 * 1024; // 2MB
        for (let i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                App.showToastr.error(
                    "File Terlalu Besar",
                    `File "${files[i].name}" melebihi 20MB.`,
                );
                $(this).val("");
                return false;
            }
        }
    });

    $(".btn-tambah").on("click", function () {
        $("#form-visi-misi")[0].reset();
        $("#id").val("");
        $("#images").val(""); // Reset input file
        $("#existing-images").html("");
        $("#preview-images").html("");
        $("#modal-visi-misi").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $("#form-visi-misi")[0].reset(); // Reset form state
        $("#images").val(""); // Bersihkan input file agar tidak duplikat

        $.get(BASE_URL + "visi_misi/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#title").val(data.title);
                $("#description").val(data.description);

                let existingHtml = "";
                data.images.forEach((img) => {
                    existingHtml += `
                        <div class="col-md-3 mb-3 text-center" id="img-container-${img.id}">
                            <div class="border p-2 rounded shadow-sm">
                                <img src="${BASE_URL}storage/${img.image}" class="img-thumbnail mb-2" style="height: 100px; width: 100%; object-fit: cover;">
                                <div class="form-check d-flex justify-content-center align-items-center m-0" style="gap: 5px;">
                                    <input class="form-check-input" type="checkbox" name="deleted_images[]" value="${img.id}" id="del-img-vm-${img.id}" style="cursor: pointer;">
                                    <label class="form-check-label text-danger mb-0" for="del-img-vm-${img.id}" style="cursor: pointer; font-size: 12px; font-weight: bold;">Hapus</label>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $("#existing-images").html(existingHtml);
                $("#preview-images").html("");
                $("#modal-visi-misi").modal("show");
            }
        });
    });

    $("#form-visi-misi").on("submit", function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let url = id
            ? BASE_URL + "visi_misi/update"
            : BASE_URL + "visi_misi/store";
        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-visi-misi .modal-content").LoadingOverlay("show");
                $("#form-visi-misi button[type='submit']").attr(
                    "disabled",
                    true,
                );
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-visi-misi").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                let res = err.responseJSON;
                if (err.status === 413) {
                    App.showToastr.error("Error", "Ukuran file terlalu besar.");
                } else if (err.status == 422 && res && res.errors) {
                    App.handleErrors.generate(res);
                } else {
                    App.showToastr.error(
                        "Error",
                        res ? res.message : "Sistem error",
                    );
                }
            },
            complete: () => {
                $("#modal-visi-misi .modal-content").LoadingOverlay("hide");
                $("#form-visi-misi button[type='submit']").attr(
                    "disabled",
                    false,
                );
            },
        });
    });
    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Visi Misi?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "visi_misi/delete",
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
