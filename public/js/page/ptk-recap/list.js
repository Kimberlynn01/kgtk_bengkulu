$(() => {
    function generate() {
        const rowKey = $("#row-field").val();
        const colKey = $("#col-field").val();

        if (rowKey === colKey) {
            App.showToastr.error("Error", "Field Baris dan Kolom tidak boleh sama");
            return;
        }

        $.post(BASE_URL + "ptk/recap/generate", {
            row_key: rowKey, col_key: colKey,
            _token: $('meta[name="csrf-token"]').attr("content"),
        }, (res) => {
            let thead = `<tr><th>${res.row_label}</th>`;
            res.columns.forEach((c) => (thead += `<th>${c}</th>`));
            thead += `<th>Grand Total</th></tr>`;

            let tbody = "";
            res.rows.forEach((r) => {
                tbody += `<tr><td><strong>${r.label}</strong></td>`;
                res.columns.forEach((c) => (tbody += `<td>${r.cells[c]}</td>`));
                tbody += `<td><strong>${r.total}</strong></td></tr>`;
            });

            let tfoot = `<tr><th>Grand Total</th>`;
            res.columns.forEach((c) => (tfoot += `<th>${res.col_totals[c]}</th>`));
            tfoot += `<th>${res.grand_total}</th></tr>`;

            $("#recap-thead").html(thead);
            $("#recap-tbody").html(tbody);
            $("#recap-tfoot").html(tfoot);
        }).fail((err) => {
            App.showToastr.error("Error", err.responseJSON?.message || "Gagal memuat rekap");
        });
    }

    $("#btn-generate").on("click", generate);
    generate();

    $("#btn-export").on("click", function () {
    const rowKey = $("#row-field").val();
    const colKey = $("#col-field").val();

    if (rowKey === colKey) {
        App.showToastr.error("Error", "Field Baris dan Kolom tidak boleh sama");
        return;
    }

    window.location.href = BASE_URL + "ptk/recap/export?row_key=" + rowKey + "&col_key=" + colKey;
});
});
