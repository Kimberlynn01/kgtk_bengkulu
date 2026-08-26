let fieldTable;

$(() => {
    fieldTable = $("#table-field").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: { url: BASE_URL + "ptk-field/data", type: "get" },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            { data: "label" },
            { data: "type_label" },
            { data: "options_preview" },
            { data: "filter_badge", searchable: false, orderable: false },
            { data: "action", searchable: false, orderable: false },
        ],
    });

    $("#field-type").on("change", function () {
        $("#field-options-wrapper").toggle($(this).val() === "select");
    });

    $(".btn-add-field").on("click", function () {
        resetForm();
        $("#modal-field-title").text("Tambah Field");
        $("#modal-field").modal("show");
    });

    $("#table-field").on("click", ".btn-edit", function () {
        resetForm();
        const d = $(this).data();
        $("#field-id").val(d.id);
        $("#field-label").val(d.label);
        $("#field-type").val(d.type).trigger("change");
        $("#field-options").val(d.options);
        $("#field-required").prop("checked", d.required == 1);
        $("#field-filterable").prop("checked", d.filterable == 1);
        $("#modal-field-title").text("Edit Field");
        $("#modal-field").modal("show");
    });

    function resetForm() {
        $("#form-field")[0].reset();
        $("#field-id").val("");
        $("#field-options-wrapper").hide();
        if (window.App?.handleErrors?.clear) App.handleErrors.clear($("#form-field"));
    }

    $("#form-field").on("submit", function (e) {
        e.preventDefault();
        const id = $("#field-id").val();
        const url = id ? BASE_URL + "ptk-field/update" : BASE_URL + "ptk-field/store";

        $.ajax({
            url, type: "POST", data: $(this).serialize(),
            beforeSend: () => {
                if (window.App?.handleErrors?.clear) App.handleErrors.clear($("#form-field"));
                $("#modal-field .modal-content").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-field .modal-content").LoadingOverlay("hide");
                App.showToastr.success("Sukses", res.message);
                $("#modal-field").modal("hide");
                fieldTable.ajax.reload(null, false);
            },
            error: (err) => {
                $("#modal-field .modal-content").LoadingOverlay("hide");
                if (err.status === 422) {
                    App.handleErrors.generate(err.responseJSON, true);
                } else {
                    App.showToastr.error("Error", err.responseJSON?.message || "Gagal menyimpan field");
                }
            },
        });
    });

    $("#table-field").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Field?",
            text: "Field ini akan hilang dari form input, data lama tidak otomatis terhapus.",
            icon: "warning", showCancelButton: true,
            confirmButtonText: "Ya, Hapus!", cancelButtonText: "Batal",
        }).then((r) => {
            if (r.isConfirmed) {
                $.post(BASE_URL + "ptk-field/delete", { id, _method: "DELETE" }, (res) => {
                    App.showToastr.success("Sukses", res.message);
                    fieldTable.ajax.reload(null, false);
                }).fail((err) => App.showToastr.error("Error", err.responseJSON?.message));
            }
        });
    });
});