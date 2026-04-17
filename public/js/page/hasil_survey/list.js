let table;

$(() => {
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "hasil_survey/data",
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

    $(".btn-tambah").on("click", function () {
        $("#form-hasil-survey")[0].reset();
        $("#id").val("");
        $("#existing-image").html("");
        $("#modal-hasil-survey").modal("show");
    });

    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $.get(BASE_URL + "hasil_survey/edit/" + id, (res) => {
            if (res.status) {
                let data = res.data;
                $("#id").val(data.id);
                $("#title").val(data.title);
                $("#description").val(data.description);

                if (data.image) {
                    $("#existing-image").html(
                        `<img src="${BASE_URL}storage/${data.image}" class="img-thumbnail" style="height: 150px;">`,
                    );
                } else {
                    $("#existing-image").html("");
                }
                $("#modal-hasil-survey").modal("show");
            }
        });
    });

    $("#form-hasil-survey").on("submit", function (e) {
        e.preventDefault();

        let id = $("#id").val();
        let url = id
            ? BASE_URL + "hasil_survey/update"
            : BASE_URL + "hasil_survey/store";

        let formData = new FormData(this);
        if (id) formData.append("_method", "PATCH");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-hasil-survey .modal-content").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-hasil-survey .modal-content").LoadingOverlay("hide");
                if (res.status) {
                    App.showToastr.success("Sukses", res.message);
                    $("#modal-hasil-survey").modal("hide");
                    table.ajax.reload();
                }
            },
            error: (err) => {
                $("#modal-hasil-survey .modal-content").LoadingOverlay("hide");
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
            title: "Hapus Hasil Survey?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "hasil_survey/delete",
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
