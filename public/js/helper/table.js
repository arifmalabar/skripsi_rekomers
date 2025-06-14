export function showTables(dt, col, tbid = null, coldef = null) {
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
        autoWidth: true,
        columnDefs:
            coldef == null
                ? [{ targets: [1, 2], className: "align-kiri" }]
                : coldef,
    });
}
