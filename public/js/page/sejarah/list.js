let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "sejarah/data",
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

    // Validasi Ukuran File
    $(document).on("change", 'input[type="file"]', function () {
        if (this.files[0] && this.files[0].size > 2048 * 1024) {
            App.showToastr.error("Error", "Ukuran file melebihi batas maksimum.");
            $(this).val("");
            return false;
        }
    });

    $(".btn-tambah").on("click", function () {
        $("#form-sejarah")[0].reset();
        $("#id").val("");
        $('input[type="file"]').val("");
        $("#existing-image").html("");
        $("#image").attr("required", true);
        $("#modal-sejarah").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $("#form-sejarah")[0].reset();
        $('input[type="file"]').val("");
        $("#image").attr("required", false);

        $.get(BASE_URL + "sejarah/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#title").val(data.title);
                $("#description").val(data.description);

                if (data.image) {
                    $("#existing-image").html(`<div class="d-flex align-items-center gap-2 p-2 border rounded">
                        <img src="/storage/${data.image}" alt="image" style="max-height:80px;border-radius:4px;">
                        <span class="text-muted" style="font-size:12px;">File saat ini (upload baru untuk mengganti)</span>
                    </div>`);
                } else {
                    $("#existing-image").html("");
                }

                $("#modal-sejarah").modal("show");
            }
        });
    });

    $("#form-sejarah").on("submit", function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let url = id
            ? BASE_URL + "sejarah/update"
            : BASE_URL + "sejarah/store";
        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-sejarah .modal-content").LoadingOverlay("show");
                $("#form-sejarah button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-sejarah").modal("hide");
                    table.ajax.reload();
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
                $("#modal-sejarah .modal-content").LoadingOverlay("hide");
                $("#form-sejarah button[type='submit']").attr("disabled", false);
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Sejarah?",
            text: "Data akan dihapus permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "sejarah/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        if (res.status) {
                            App.showToastr.success("Sukses", res.message);
                            table.ajax.reload();
                        }
                    },
                ).fail((err) => {
                    let res = err.responseJSON;
                    App.showToastr.error("Error", res ? res.message : "Gagal menghapus.");
                });
            }
        });
    });
});
