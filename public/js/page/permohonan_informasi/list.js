let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "permohonan_informasi/data",
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            {
                data: "link",
                render: (data) => {
                    return `<a href="${data}" target="_blank" class="text-primary">${data}</a>`;
                },
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

    $(".btn-tambah").on("click", function () {
        $("#form-permohonan-informasi")[0].reset();
        $("#id").val("");
        $("#modal-permohonan-informasi").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $("#form-permohonan-informasi")[0].reset();

        $.get(BASE_URL + "permohonan_informasi/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#link").val(data.link);
                $("#modal-permohonan-informasi").modal("show");
            }
        });
    });

    $("#form-permohonan-informasi").on("submit", function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let url = id
            ? BASE_URL + "permohonan_informasi/update"
            : BASE_URL + "permohonan_informasi/store";
        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-permohonan-informasi .modal-content").LoadingOverlay("show");
                $("#form-permohonan-informasi button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-permohonan-informasi").modal("hide");
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
                $("#modal-permohonan-informasi .modal-content").LoadingOverlay("hide");
                $("#form-permohonan-informasi button[type='submit']").attr("disabled", false);
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Permohonan Informasi?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "permohonan_informasi/delete",
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
