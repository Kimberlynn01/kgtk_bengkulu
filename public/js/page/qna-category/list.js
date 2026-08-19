let categoryTable;

$(() => {

    categoryTable = $("#table-category").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "qna-category/data",
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            { data: "name" },
            { data: "qnas_count", searchable: false, orderable: false },
            { data: "status", searchable: false, orderable: false },
            { data: "action", searchable: false, orderable: false },
        ],
    });

    $(".btn-add-category").on("click", function () {
        resetFormCategory();
        $("#modal-categoryLabel").text("Tambah Kategori");
        $("#modal-category").modal("show");
    });

    $("#table-category").on("click", ".btn-edit", function () {
        resetFormCategory();

        let id     = $(this).data("id");
        let name   = $(this).data("name");
        let active = $(this).data("active");

        $("#modal-categoryLabel").text("Edit Kategori");
        $("#category-id").val(id);
        $("#category-name").val(name);
        $("#category-is-active").prop("checked", active == 1);

        $("#modal-category").modal("show");
    });

    function resetFormCategory() {
        $("#form-category")[0].reset();
        $("#category-id").val("");
        $("#category-is-active").prop("checked", true);
        if (window.App && App.handleErrors && typeof App.handleErrors.clear === "function") {
            App.handleErrors.clear($("#form-category"));
        }
        $("#error-name").text("");
    }

    $("#form-category").on("submit", function (e) {
        e.preventDefault();

        const form = $(this);
        const id   = $("#category-id").val();
        const url  = id ? BASE_URL + "qna-category/update" : BASE_URL + "qna-category/store";

        $.ajax({
            url: url,
            type: "POST",
            data: form.serialize(),
            beforeSend: () => {
                if (window.App && App.handleErrors && typeof App.handleErrors.clear === "function") {
                    App.handleErrors.clear(form);
                }
                $("#modal-category .modal-content").LoadingOverlay("show");
                form.find("button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                $("#modal-category .modal-content").LoadingOverlay("hide");
                App.showToastr.success("Sukses", res.message || "Kategori berhasil disimpan!");
                $("#modal-category").modal("hide");
                categoryTable.ajax.reload(null, false);
            },
            error: (err) => {
                $("#modal-category .modal-content").LoadingOverlay("hide");

                if (err.status === 422) {
                    let errorData = err.responseJSON;

                    if (!errorData && err.responseText) {
                        try {
                            errorData = JSON.parse(err.responseText);
                        } catch (e) {
                            console.error("Gagal parse JSON manual:", e);
                        }
                    }

                    if (errorData) {
                        try {
                            App.handleErrors.generate(errorData, true);
                        } catch (e) {
                            console.error("App.handleErrors.generate gagal:", e);
                            if (errorData.errors) {
                                let msg = Object.values(errorData.errors).map(el => el[0]).join("<br>");
                                App.showToastr.error("Validasi Gagal", msg);
                            } else {
                                App.showToastr.error("Error", errorData.message || "Validasi gagal.");
                            }
                        }
                    } else {
                        App.showToastr.error("Error", "Terjadi kesalahan validasi data.");
                    }
                } else {
                    App.showToastr.error("Error", err.responseJSON?.message || "Gagal menyimpan kategori");
                }
            },
            complete: () => {
                form.find("button[type='submit']").attr("disabled", false);
            },
        });
    });

    $("#table-category").on("click", ".btn-delete", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "Hapus Kategori?",
            text: "Kategori yang masih dipakai di data QnA tidak dapat dihapus.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "qna-category/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        App.showToastr.success("Sukses", res.message || "Kategori berhasil dihapus");
                        categoryTable.ajax.reload(null, false);
                    },
                ).fail((err) => {
                    App.showToastr.error("Error", err.responseJSON?.message || "Gagal menghapus kategori");
                });
            }
        });
    });
});