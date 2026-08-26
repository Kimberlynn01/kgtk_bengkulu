$(() => {
    $(document).on("click", ".btn-edit-navbar", function () {
        const d = $(this).data();
        $("#navbar-id").val(d.id);
        $("#navbar-name").val(d.name);
        $("#navbar-is-active").prop("checked", d.active == 1);
        if (window.App?.handleErrors?.clear) App.handleErrors.clear($("#form-navbar"));
        $("#modal-navbar").modal("show");
    });

    $("#form-navbar").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: BASE_URL + "navbar-menu/update",
            type: "POST",
            data: $(this).serialize(),
            beforeSend: () => {
                if (window.App?.handleErrors?.clear) App.handleErrors.clear($("#form-navbar"));
                $("#modal-navbar .modal-content").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-navbar .modal-content").LoadingOverlay("hide");
                App.showToastr.success("Sukses", res.message);
                $("#modal-navbar").modal("hide");
                setTimeout(() => location.reload(), 600);
            },
            error: (err) => {
                $("#modal-navbar .modal-content").LoadingOverlay("hide");
                if (err.status === 422) {
                    App.handleErrors.generate(err.responseJSON, true);
                } else {
                    App.showToastr.error("Error", err.responseJSON?.message || "Gagal menyimpan");
                }
            },
        });
    });
});