let sessionTable;

$(() => {

    checkSessionAvailability();

    sessionTable = $("#table-session").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "consultation-session/data",
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            { data: "image_preview", searchable: false, orderable: false },
            { data: "title" },
            { data: "slug" },
            { data: "status", searchable: false, orderable: false },
            { data: "action", searchable: false, orderable: false },
        ],
        drawCallback: function () {
            checkSessionAvailability();
        },
    });

    function checkSessionAvailability() {
        $.get(BASE_URL + "consultation-session/check", (res) => {
            if (res.exists) {
                $(".btn-add-session").hide();
                $("#session-limit-note").show();
            } else {
                $(".btn-add-session").show();
                $("#session-limit-note").hide();
            }
        });
    }

    $(".btn-add-session").on("click", function () {
        resetFormSession();
        $("#modal-sessionLabel").text("Tambah Sesi Konsultasi");
        $("#session-active-wrapper").hide();
        $("#modal-session").modal("show");
    });

    $("#table-session").on("click", ".btn-edit", function () {
        resetFormSession();
        const d = $(this).data();

        $("#session-id").val(d.id);
        $("#session-title").val(d.title);
        $("#session-slug").val(d.slug);
        $("#session-description").val(d.description);
        $("#session-gmeet").val(d.gmeet);
        $("#session-is-active").prop("checked", d.active == 1);
        $("#session-active-wrapper").show();

        if (d.image) {
            $("#session-image-preview").attr("src", d.image).show();
        }

        $("#modal-sessionLabel").text("Edit Sesi Konsultasi");
        $("#modal-session").modal("show");
    });

    function resetFormSession() {
        $("#form-session")[0].reset();
        $("#session-id").val("");
        $("#session-image-preview").hide().attr("src", "");
        if (window.App && App.handleErrors && typeof App.handleErrors.clear === "function") {
            App.handleErrors.clear($("#form-session"));
        }
    }

    $("#form-session").on("submit", function (e) {
        e.preventDefault();

        const id  = $("#session-id").val();
        const url = id ? BASE_URL + "consultation-session/update" : BASE_URL + "consultation-session/store";

        const formData = new FormData(this);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                if (window.App && App.handleErrors && typeof App.handleErrors.clear === "function") {
                    App.handleErrors.clear($("#form-session"));
                }
                $("#modal-session .modal-content").LoadingOverlay("show");
                $("#form-session button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                $("#modal-session .modal-content").LoadingOverlay("hide");
                App.showToastr.success("Sukses", res.message || "Sesi berhasil disimpan");
                $("#modal-session").modal("hide");
                sessionTable.ajax.reload(null, false);
            },
            error: (err) => {
                $("#modal-session .modal-content").LoadingOverlay("hide");

                if (err.status === 422) {
                    let errorData = err.responseJSON;

                    if (!errorData && err.responseText) {
                        try {
                            errorData = JSON.parse(err.responseText);
                        } catch (e) {
                            console.error("Gagal parse JSON manual:", e);
                        }
                    }

                    if (errorData?.errors) {
                        try {
                            App.handleErrors.generate(errorData, true);
                        } catch (e) {
                            console.error("App.handleErrors.generate gagal:", e);
                            let msg = Object.values(errorData.errors).map(el => el[0]).join("<br>");
                            App.showToastr.error("Validasi Gagal", msg);
                        }
                    } else {
                        // Kasus limit 1 data — message tanpa "errors" object
                        App.showToastr.error("Tidak Bisa Menambah", errorData?.message || "Terjadi kesalahan validasi data.");
                    }
                } else {
                    App.showToastr.error("Error", err.responseJSON?.message || "Gagal menyimpan sesi");
                }
            },
            complete: () => {
                $("#form-session button[type='submit']").attr("disabled", false);
            },
        });
    });

    $("#table-session").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Sesi Konsultasi?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "consultation-session/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        App.showToastr.success("Sukses", res.message || "Sesi berhasil dihapus");
                        sessionTable.ajax.reload(null, false);
                    },
                ).fail((err) => {
                    App.showToastr.error("Error", err.responseJSON?.message || "Gagal menghapus sesi");
                });
            }
        });
    });
});