let table;

$(() => {
    // Inisialisasi DataTable
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "qna/data", // Menuju ke route rbac qna,1
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            { data: "name" },
            { data: "category" },
            { data: "question" },
            {
                data: "status",
                searchable: false,
                orderable: false,
            },
            {
                data: "id",
                searchable: false,
                orderable: false,
                render: (data, type, row) => {
                    return `
                        <div class="btn-group">
                            <button class="btn btn-primary btn-update" data-id="${data}" title="Jawab Pertanyaan">
                                <i class="icofont icofont-ui-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-delete" data-id="${data}" title="Hapus">
                                <i class="icofont icofont-trash"></i>
                            </button>
                        </div>
                    `;
                },
            },
        ],
    });

    // Menampilkan Modal Edit / Jawab
    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $.get(BASE_URL + "qna/edit/" + id, (res) => {
            // Jika res langsung data objek (seperti pada controller sebelumnya)
            if (res) {
                $("#id").val(res.id);
                $("#show-name").text(res.name);
                $("#show-category").text(res.category);
                $("#show-question").text(res.question);
                $("#answer").val(res.answer); // Tampilkan jawaban jika sudah ada

                $("#modal-qna").modal("show");
            }
        }).fail((err) => {
            App.showToastr.error("Error", "Gagal mengambil data pertanyaan");
        });
    });

    // Form Submit (Update Jawaban)
    $("#form-qna").on("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        // Karena kita mengupdate jawaban, gunakan PATCH sesuai route RBAC 3
        formData.append("_method", "PATCH");

        $.ajax({
            url: BASE_URL + "qna/update",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-qna .modal-content").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-qna .modal-content").LoadingOverlay("hide");
                // Sesuaikan pengecekan success (bisa res.status atau res.message)
                App.showToastr.success(
                    "Sukses",
                    res.message || "Jawaban berhasil disimpan",
                );
                $("#modal-qna").modal("hide");
                table.ajax.reload();
            },
            error: (err) => {
                $("#modal-qna .modal-content").LoadingOverlay("hide");
                if (err.status == 422) {
                    App.handleErrors.generate(err.responseJSON);
                } else {
                    App.showToastr.error("Error", err.responseJSON.message);
                }
            },
        });
    });

    // Proses Delete
    $("#table-data").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Hapus Pertanyaan?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    BASE_URL + "qna/delete",
                    { id: id, _method: "DELETE" },
                    (res) => {
                        App.showToastr.success(
                            "Sukses",
                            res.message || "Data berhasil dihapus",
                        );
                        table.ajax.reload();
                    },
                ).fail((err) => {
                    App.showToastr.error("Error", err.responseJSON.message);
                });
            }
        });
    });
});
