let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "struktur_organisasi/data",
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            {
                data: "image",
                render: (data) => {
                    return data
                        ? `<img src="${BASE_URL}storage/${data}" class="img-thumbnail" style="height: 60px;">`
                        : '<span class="text-muted">-</span>';
                },
                searchable: false,
                orderable: false,
            },
            {
                data: "id",
                render: (data) => {
                    return `
                        <div class="btn-group">
                            <button class="btn btn-primary btn-update" data-id="${data}"><i class="icofont icofont-ui-edit"></i></button>
                            <button class="btn btn-danger btn-delete" data-id="${data}"><i class="icofont icofont-trash"></i></button>
                        </div>
                    `;
                },
                searchable: false,
                orderable: false,
            },
        ],
    });

    $(document).on("change", 'input[type="file"]', function () {
        if (this.files.length > 0 && this.files[0].size > 20 * 1024 * 1024) {
            App.showToastr.error("File Terlalu Besar", "File melebihi 20MB.");
            $(this).val("");
            return false;
        }
    });

    $(".btn-tambah").on("click", function () {
        $("#form-struktur-organisasi")[0].reset();
        $("#id").val("");
        $('input[type="file"]').val("");
        $("#existing-image").html("");
        $("#modal-struktur-organisasi").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $("#form-struktur-organisasi")[0].reset();
        $('input[type="file"]').val("");

        $.get(BASE_URL + "struktur_organisasi/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);

                if (data.image) {
                    $("#existing-image").html(
                        `<div class="mt-2 border p-2 text-center rounded shadow-sm">
                            <label class="d-block font-weight-bold">Gambar Saat Ini:</label>
                            <img src="${BASE_URL}storage/${data.image}" class="img-thumbnail" style="height: 150px;">
                        </div>`,
                    );
                } else {
                    $("#existing-image").html("");
                }
                $("#modal-struktur-organisasi").modal("show");
            }
        });
    });

    $("#form-struktur-organisasi").on("submit", function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let url = id
            ? BASE_URL + "struktur_organisasi/update"
            : BASE_URL + "struktur_organisasi/store";
        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-struktur-organisasi .modal-content").LoadingOverlay("show");
                $("#form-struktur-organisasi button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-struktur-organisasi").modal("hide");
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
                $("#modal-struktur-organisasi .modal-content").LoadingOverlay("hide");
                $("#form-struktur-organisasi button[type='submit']").attr("disabled", false);
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Struktur Organisasi?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "struktur_organisasi/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        if (res.status) {
                            App.showToastr.success("Sukses", res.message);
                            table.ajax.reload();
                        }
                    },
                ).fail((err) => {
                    let res = err.responseJSON;
                    App.showToastr.error("Error", res ? res.message : "Gagal menghapus data.");
                });
            }
        });
    });
});
