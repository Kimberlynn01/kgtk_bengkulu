$(() => {
    $('#kode_prodi').select2({
        width: '100%'
    })

    $('#form-profil').on('submit', function (e) {
        e.preventDefault(); // Mencegah pengiriman form secara default

        var formData = new FormData(this);

        // Hapus error sebelumnya
        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');

        Swal.fire({
            title: 'Memuat...',
            text: 'Sistem sedang memproses penyimpanan...',
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                Swal.close();
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Profil berhasil disimpan!'
                    }).then(() => {
                        window.location.href = BASE_URL + 'profil';
                    });
                }
            },
            error: function (xhr) {
                Swal.close();
                if (xhr.status === 422) { // Jika error validasi
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        let input = $('[name="' + key + '"]');
                        input.addClass('is-invalid');
                        input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan dalam mengirim data.'
                    });
                }
            }
        });
    });


    // Hide Show Password
    $(".toggle-password").click(function () {
        let input = $($(this).attr("data-target"));
        let icon = $(this).find("i");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icon.removeClass("icofont icofont-eye").addClass("icofont-eye-blocked");
        } else {
            input.attr("type", "password");
            icon.removeClass("icofont-eye-blocked").addClass("icofont icofont-eye");
        }
    });

    // Change Password
    $("#formChangePassword").submit(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Memproses...",
            text: "Mohon tunggu sebentar",
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: BASE_URL + "profil/change-password",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: response.success,
                    confirmButtonText: "OK"
                }).then(() => {
                    location.reload();
                });

                $("#modalChangePassword").modal("hide");
                $("#formChangePassword")[0].reset();
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.error;
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: Object.values(errors).join("\n"),
                    confirmButtonText: "OK"
                });
            }
        });
    });

})
