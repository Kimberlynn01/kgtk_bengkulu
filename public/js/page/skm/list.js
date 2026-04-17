let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "skm/data",
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            { data: "title" },
            {
                data: "link",
                render: (data) =>
                    `<a href="${data}" target="_blank">${data}</a>`,
            },
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

    $(".btn-tambah").on("click", function () {
        $("#form-skm")[0].reset();
        $("#id").val("");
        $("#modal-skm").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $.get(BASE_URL + "skm/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#title").val(data.title);
                $("#description").val(data.description);
                $("#link").val(data.link);
                $("#modal-skm").modal("show");
            }
        });
    });

    $("#form-skm").on("submit", function (e) {
        e.preventDefault();

        let id = $("#id").val();
        let url = id ? BASE_URL + "skm/update" : BASE_URL + "skm/store";

        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-skm .modal-content").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-skm .modal-content").LoadingOverlay("hide");
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-skm").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                $("#modal-skm .modal-content").LoadingOverlay("hide");
                if (err.status == 422) {
                    App.handleErrors.generate(err.responseJSON);
                } else {
                    App.showToastr.error("Error", err.responseJSON.message);
                }
            },
        });
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus SKM?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "skm/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        if (res.status) {
                            App.showToastr.success("Sukses", res.message);
                            table.ajax.reload();
                        }
                    },
                ).fail((err) => {
                    App.showToastr.error("Error", err.responseJSON.message);
                });
            }
        });
    });
});
