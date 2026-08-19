$(() => {
    $("#btn-edit").on("click", function () {
        $("#form-peningkatan-kompetensi-pengawas-sekolah")[0].reset();
        let hasData = $("#data-state").is(":visible");
        $("#image").attr("required", hasData ? false : true);
        if (hasData) {
            $("#deskripsi").val($("#preview-deskripsi").text().trim());
        }
        $("#modal-peningkatan-kompetensi-pengawas-sekolah").modal("show");
    });

    $(document).on("change", '#image', function () {
        if (this.files[0] && this.files[0].size > 20480 * 1024) {
            App.showToastr.error("Error", "Ukuran gambar melebihi 2MB.");
            $(this).val("");
        }
    });

    $("#form-peningkatan-kompetensi-pengawas-sekolah").on("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: BASE_URL + "peningkatan-kompetensi-pengawas-sekolah/save",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-peningkatan-kompetensi-pengawas-sekolah .modal-content").LoadingOverlay("show");
                $("#form-peningkatan-kompetensi-pengawas-sekolah button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-peningkatan-kompetensi-pengawas-sekolah").modal("hide");
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
                $("#modal-peningkatan-kompetensi-pengawas-sekolah .modal-content").LoadingOverlay("hide");
                $("#form-peningkatan-kompetensi-pengawas-sekolah button[type='submit']").attr("disabled", false);
            },
        });
    });
});
