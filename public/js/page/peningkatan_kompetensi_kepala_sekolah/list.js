$(() => {
    $("#btn-edit").on("click", function () {
        $("#form-peningkatan-kompetensi-kepala-sekolah")[0].reset();
        let hasData = $("#data-state").is(":visible");
        $("#image").attr("required", hasData ? false : true);
        if (hasData) {
            $("#deskripsi").val($("#preview-deskripsi").text().trim());
        }
        $("#modal-peningkatan-kompetensi-kepala-sekolah").modal("show");
    });

    $(document).on("change", '#image', function () {
        if (this.files[0] && this.files[0].size > 20480 * 1024) {
            App.showToastr.error("Error", "Ukuran gambar melebihi 20MB.");
            $(this).val("");
        }
    });

    $("#form-peningkatan-kompetensi-kepala-sekolah").on("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: BASE_URL + "peningkatan-kompetensi-kepala-sekolah/save",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-peningkatan-kompetensi-kepala-sekolah .modal-content").LoadingOverlay("show");
                $("#form-peningkatan-kompetensi-kepala-sekolah button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-peningkatan-kompetensi-kepala-sekolah").modal("hide");
                    setTimeout(() => location.reload(), 600);
                }
            },
            error: (err) => {
                let res = err.responseJSON;
                if (err.status == 422 && res && res.errors) {
                    App.handleErrors.generate(res);
                } else {
                    App.showToastr.error("Error", res ? res.message : "Sistem error");
                }
            },
            complete: () => {
                $("#modal-peningkatan-kompetensi-kepala-sekolah .modal-content").LoadingOverlay("hide");
                $("#form-peningkatan-kompetensi-kepala-sekolah button[type='submit']").attr("disabled", false);
            },
        });
    });
});
