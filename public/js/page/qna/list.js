let table;
let answeredTable = null;


$(() => {

   $(document).on("submit", "#form-user-pic", function (e) {
    e.preventDefault(); 
    e.stopPropagation();

    const form = $(this);

    $.ajax({
        url: BASE_URL + "qna/store-pic", 
        type: "POST",
        data: form.serialize(),
        beforeSend: () => {
            // 1. Bersihkan error lama sebelum submit ulang agar tidak menumpuk
            if (window.App && App.handleErrors && typeof App.handleErrors.clear === "function") {
                App.handleErrors.clear(form);
            }
            $("#modal-user-pic .modal-content").LoadingOverlay("show");
            form.find("button[type='submit']").attr("disabled", true);
        },
        success: (res) => {
            $("#modal-user-pic .modal-content").LoadingOverlay("hide");
            App.showToastr.success("Sukses", res.message || "User PIC berhasil ditambahkan!");
            $("#modal-user-pic").modal("hide");
            form[0].reset();
            if (typeof table !== "undefined") table.ajax.reload();
        },
        error: (err) => {
    $("#modal-user-pic .modal-content").LoadingOverlay("hide");
    
    if (err.status === 422) {
        // Ambil data error response
        let errorData = err.responseJSON;

        // JIKA responseJSON kosong, coba parse manual dari responseText
        if (!errorData && err.responseText) {
            try {
                errorData = JSON.parse(err.responseText);
            } catch (e) {
                console.error("Gagal parse JSON manual:", e);
            }
        }

        // Jalankan generator error jika data object-nya valid
        if (errorData) {
            // Coba kirim langsung object errorData, atau errorData.errors jika main.js butuh nested object-nya
            try {
                App.handleErrors.generate(errorData, true);
            } catch (e) {
                // Failsafe jika main.js masih nge-crush, kita paksa pakai toastr biar kelihatan errornya
                console.error("App.handleErrors.generate gagal:", e);
                if (errorData.errors) {
                    let msg = Object.values(errorData.errors).map(el => el[0]).join("<br>");
                    App.showToastr.error("Validasi Gagal", msg);
                } else {
                    App.showToastr.error("Error", errorData.message || "Validasi gagal.");
                }
            }
        } else {
            App.showToastr.error("Error", "Terjadi kesalahan validasi data.");
        }

    } else {
        App.showToastr.error("Error", err.responseJSON?.message || "Gagal menyimpan data");
    }
},
        complete: () => {
            form.find("button[type='submit']").attr("disabled", false);
        },
    });
});
    // ── DataTable Utama ──────────────────────────────────────────────
    table = $("#table-data").DataTable({
        language: App.options.dt,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "qna/data",
            type: "get",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", searchable: false, orderable: false },
            { data: "name" },
            { data: "instansi" },
            { data: "category_name" },
            { data: "question" },
            { data: "answer_preview",  searchable: false, orderable: false },
            { data: "asked_at",        searchable: false, orderable: false },
            { data: "answered_at_col", searchable: false, orderable: false },
            { data: "status",          searchable: false, orderable: false },
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

    // ── Tombol "Jawaban" → buka modal + init/reload table ───────────
    $(".btn-show-answered").on("click", function () {
        $("#modal-answered").modal("show");

        if (answeredTable === null) {
            answeredTable = $("#table-answered").DataTable({
                language: App.options.dt,
                serverSide: true,
                processing: true,
                ajax: {
                    url: BASE_URL + "qna/data-answered",
                    type: "get",
                    dataType: "json",
                },
                columns: [
                    { data: "DT_RowIndex", searchable: false, orderable: false },
                    { data: "name" },
                    { data: "instansi" },
                    { data: "category_name" },
                    { data: "question" },
                    { data: "answer" },
                    { data: "asked_at",        searchable: false, orderable: false },
                    { data: "answered_at_col", searchable: false, orderable: false },
                    { data: "admin_name",      searchable: false, orderable: false },
                ],
            });
        } else {
            answeredTable.ajax.reload();
        }
    });

    // ── Tombol Edit / Jawab ──────────────────────────────────────────
    $("#table-data").on("click", ".btn-update", function () {
        let id = $(this).data("id");
        $.get(BASE_URL + "qna/edit/" + id, (res) => {
            if (res) {
                $("#id").val(res.id);
                $("#show-name").text(res.name);
                $("#show-email").text(res.email);
                $("#show-instansi").text(res.instansi);
                $("#show-phone").text(res.phone);
                $("#show-category").val(res.category_id);
                $("#show-question").text(res.question);
                $("#answer").val(res.answer);
                $("#modal-qna").modal("show");
            }
        }).fail(() => {
            App.showToastr.error("Error", "Gagal mengambil data pertanyaan");
        });
    });

    // ── Submit Jawaban ───────────────────────────────────────────────
    $("#form-qna").on("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);
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
                App.showToastr.success("Sukses", res.message || "Jawaban berhasil disimpan");
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

    // ── Edit Kategori ─────────────────────────────────────────────────────
    $("#table-data").on("click", ".btn-edit-category", function () {
        let id       = $(this).data("id");
        let name     = $(this).data("name");
        let question = $(this).data("question");
        let category = $(this).data("category");

        $("#category-id").val(id);
        $("#category-show-name").text(name);
        $("#category-show-question").text(question);
        $("#category-select").val(category);
        $("#modal-edit-category").modal("show");
    });

    $("#form-edit-category").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: BASE_URL + "qna/update-category",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#modal-edit-category .modal-content").LoadingOverlay("show");
                $("#form-edit-category button[type='submit']").attr("disabled", true);
            },
            success: (res) => {
                App.showToastr.success("sukses", res.message);
                $("#modal-edit-category").modal("hide");
                table.ajax.reload();
            },
            error: ({ status, responseJSON }) => {
                if (status == 422) {
                    App.handleErrors.generate(responseJSON);
                    return false;
                }
                if (status == 403) {
                    App.showToastr.error("oops", "Akses ditolak.");
                    return false;
                }
                App.showToastr.error("oops", responseJSON.message);
            },
            complete: () => {
                $("#modal-edit-category .modal-content").LoadingOverlay("hide");
                $("#form-edit-category button[type='submit']").attr("disabled", false);
            },
        });
    });
    

    // ── Hapus ────────────────────────────────────────────────────────
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
                        App.showToastr.success("Sukses", res.message || "Data berhasil dihapus");
                        table.ajax.reload();
                    },
                ).fail((err) => {
                    App.showToastr.error("Error", err.responseJSON.message);
                });
            }
        });
    });
});