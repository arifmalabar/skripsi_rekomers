import { bom_detail, bom_detail_data } from "../../config/end_point.js";
import { getDetailData } from "../../fecth/fetch.js";
import { ProductData } from "../manufacturing_order.js";
import { init as moDefault } from "../manufacturing_order.js";
var status = $(".status").val();
var jml_produksi = 0;
export function init() {
    BomDetail($("#bom-data").val());
    $("#bom-data").on("change", function () {
        if (status == 0) {
            BomDetail($("#bom-data").val());
        } else {
            Swal.fire({
                title: "Failed",
                text: "bom tidak dapat diubah",
            });
        }
    });
    try {
        jml_produksi = parseInt($(".jml_produksi").val());
    } catch (error) {
        jml_produksi = 0;
    }
}
async function BomDetail(id) {
    try {
        const response = await fetch(`${bom_detail_data}/${id}`);
        if (response.status) {
            const data = await response.json();
            showDetailData(data);
        } else {
            throw new Error(response.statusText);
        }
    } catch (error) {
        console.log(error);
    }
}
function showDetailData(dt) {
    if (status == 0) {
        tabelKonfirmasi(dt);
    } else if (status == 1) {
        tabelCekKetersediaan(dt);
    } else {
        tabelKonfirmasi(dt);
    }
}
function tabelKonfirmasi(dt) {
    $("#example2").DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        bDestroy: true,
        data: dt,
        columns: [
            {
                data: "nama",
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `${row.quantity * jml_produksi}`;
                },
            },
        ],
    });
}
function tabelCekKetersediaan(dt) {
    console.log(dt);
    $("#example3").DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        bDestroy: true,
        data: dt,
        columns: [
            {
                data: "nama",
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `${row.quantity * jml_produksi}`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    if (row.on_hand < row.kuantitas * jml_produksi) {
                        return `<p class="text-danger">${row.on_hand}</p>`;
                    } else {
                        return `<p>${row.on_hand}</p>`;
                    }
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return 0;
                },
            },
        ],
    });
}
