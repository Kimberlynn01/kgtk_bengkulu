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
            url: BASE_URL + "berita/data",
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

    $(document).on("change", 'input[name="images[]"]', function () {
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
        $("#form-berita")[0].reset();
        $("#id").val("");
        editor.setData("");
        $('input[name="images[]"]').val(""); // Reset input file anti-duplikat
        $("#existing-images").html("");
        $("#preview-images").html("");
        $("#modal-berita").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");

        // Reset state form sebelum load data baru
        $("#form-berita")[0].reset();
        $('input[name="images[]"]').val("");
        $("#preview-images").html("");

        $.get(BASE_URL + "berita/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);

                // FIX FORMAT TANGGAL (Agar tampil di input type="date")
                if (data.date) {
                    let dateVal = data.date.split(" ")[0];
                    $("#date").val(dateVal);
                }

                $("#title").val(data.title);
                editor.setData(data.content);

                let existingHtml = "";
                data.images.forEach((img) => {
                    // FIX AREA KLIK CHECKBOX (ID & Label For)
                    existingHtml += `
                        <div class="col-md-3 mb-3 text-center" id="img-container-${img.id}">
                            <div class="border p-2 rounded shadow-sm">
                                <img src="${BASE_URL}storage/${img.image}" class="img-thumbnail mb-2" style="height: 100px; width: 100%; object-fit: cover;">
                                <div class="form-check d-flex justify-content-center align-items-center m-0" style="gap: 5px;">
                                    <input class="form-check-input" type="checkbox" name="deleted_images[]" value="${img.id}" id="del-news-img-${img.id}" style="cursor: pointer;">
                                    <label class="form-check-label text-danger mb-0" for="del-news-img-${img.id}" style="cursor: pointer; font-size: 12px; font-weight: bold;">
                                        Hapus
                                    </label>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $("#existing-images").html(existingHtml);
                $("#modal-berita").modal("show");
            }
        });
    });

    $("#form-berita").on("submit", function (e) {
        e.preventDefault();

        // Sinkronisasi CKEditor
        for (var instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

        let id = $("#id").val();
        let url = id ? BASE_URL + "berita/update" : BASE_URL + "berita/store";

        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-berita .modal-content").LoadingOverlay("show");
                $("#form-berita button[type='submit']").attr("disabled", true); // Anti-duplicate submit
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-berita").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                let res = err.responseJSON;
                if (err.status === 413) {
                    App.showToastr.error("Error", "Ukuran file terlalu besar.");
                } else if (err.status === 422 && res && res.errors) {
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
                $("#modal-berita .modal-content").LoadingOverlay("hide");
                $("#form-berita button[type='submit']").attr("disabled", false);
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Berita?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "berita/delete",
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
