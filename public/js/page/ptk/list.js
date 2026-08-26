let ptkTable;

$(() => {
    const fieldKeys = $(".field-input").map(function () {
        return $(this).data("key");
    }).get();

    // ── DataTable Utama ──────────────────────────────────────────────
    let columns = [{ data: "DT_RowIndex", searchable: false, orderable: false }];
    fieldKeys.forEach((key) => columns.push({ data: key }));
    columns.push({ data: "jumlah", orderable: false, searchable: false });
    columns.push({ data: "action", searchable: false, orderable: false });

    ptkTable = $("#table-ptk").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "ptk/data",
            type: "get",
            dataType: "json",
        },
        columns: columns,
    });

    // ── Buka Modal: Tambah ───────────────────────────────────────────
    $(".btn-add").on("click", function () {
        resetForm();
        $("#modal-ptk-title").text("Tambah Data");
        $("#modal-ptk").modal("show");
    });

    // ── Buka Modal: Edit ─────────────────────────────────────────────
    $("#table-ptk").on("click", ".btn-edit", function () {
        resetForm();
        let id = $(this).data("id");

        $.get(BASE_URL + "ptk/edit/" + id, (res) => {
            if (res) {
                $("#ptk-id").val(res.id);
                $("#ptk-jumlah").val(res.jumlah);

                Object.entries(res.data || {}).forEach(([key, val]) => {
                    $(`.field-input[data-key="${key}"]`).val(val);
                });

                $("#modal-ptk-title").text("Edit Data");
                $("#modal-ptk").modal("show");
            }
        }).fail(() => {
            App.showToastr.error("Error", "Gagal mengambil data");
        });
    });

    // ── Reset Form ───────────────────────────────────────────────────
    function resetForm() {
        $("#form-ptk")[0].reset();
        $("#ptk-id").val("");
        $(".field-input").val("");
        if (window.App && App.handleErrors && typeof App.handleErrors.clear === "function") {
            App.handleErrors.clear($("#form-ptk"));
        }
    }

    // ── Submit Tambah / Edit ─────────────────────────────────────────
    $("#form-ptk").on("submit", function (e) {
        e.preventDefault();

        const id = $("#ptk-id").val();
        const url = id ? BASE_URL + "ptk/update/" + id : BASE_URL + "ptk/store";

        const fields = {};
        $(".field-input").each(function () {
            fields[$(this).data("key")] = $(this).val();
        });

        $.ajax({
            url: url,
            type: "POST",
            data: {
                fields: fields,
                jumlah: $("#ptk-jumlah").val(),
                _token: $('input[name="_token"]').val(),
            },
            beforeSend: () => {
                if (window.App && App.handleErrors && typeof App.handleErrors.clear === "function") {
                    App.handleErrors.clear($("#form-ptk"));
                }
                $("#modal-ptk .modal-content").LoadingOverlay("show");
                $("#form-ptk button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                $("#modal-ptk .modal-content").LoadingOverlay("hide");
                App.showToastr.success("Sukses", res.message || "Data berhasil disimpan");
                $("#modal-ptk").modal("hide");
                ptkTable.ajax.reload(null, false);
            },
            error: (err) => {
                $("#modal-ptk .modal-content").LoadingOverlay("hide");

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
                    App.showToastr.error("Error", err.responseJSON?.message || "Gagal menyimpan data");
                }
            },
            complete: () => {
                $("#form-ptk button[type='submit']").attr("disabled", false);
            },
        });
    });

    // ── Hapus ────────────────────────────────────────────────────────
    $("#table-ptk").on("click", ".btn-delete", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "Hapus Data?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "ptk/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        App.showToastr.success("Sukses", res.message || "Data berhasil dihapus");
                        ptkTable.ajax.reload(null, false);
                    },
                ).fail((err) => {
                    App.showToastr.error("Error", err.responseJSON?.message || "Gagal menghapus data");
                });
            }
        });
    });
    $(".btn-import").on("click", function () {
    $("#form-import")[0].reset();
    $("#import-result").hide();
    $("#import-error-list").empty();
    if (window.App?.handleErrors?.clear) App.handleErrors.clear($("#form-import"));
    $("#modal-import").modal("show");
});

    $("#form-import").on("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: BASE_URL + "ptk/import",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                if (window.App?.handleErrors?.clear) App.handleErrors.clear($("#form-import"));
                $("#modal-import .modal-content").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-import .modal-content").LoadingOverlay("hide");
                App.showToastr.success("Sukses", res.message);

                $("#import-result").show();
                $("#import-alert")
                    .removeClass("alert-danger alert-success")
                    .addClass(res.errors.length ? "alert-warning" : "alert-success")
                    .text(res.message);

                $("#import-error-list").empty();
                res.errors.forEach((err) => {
                    $("#import-error-list").append(`<li>${err}</li>`);
                });

                ptkTable.ajax.reload(null, false);
            },
            error: (err) => {
                $("#modal-import .modal-content").LoadingOverlay("hide");
                if (err.status === 422) {
                    App.handleErrors.generate(err.responseJSON, true);
                } else {
                    App.showToastr.error("Error", err.responseJSON?.message || "Gagal mengimport data");
                }
            },
        });
    });
});