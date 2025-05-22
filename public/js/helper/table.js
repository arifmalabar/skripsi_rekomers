export function showTables(dt, col, tbid = null) {
    const id = tbid == null ? "#example2" : tbid;
    $(id).DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        bDestroy: true,
        data: dt,
        columns: col,
        columnDefs: [{ targets: [1, 2], className: "align-kiri" }],
    });
}
