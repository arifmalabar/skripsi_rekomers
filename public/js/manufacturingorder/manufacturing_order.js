import {
    bom_data,
    bom_detail_data,
    product_data,
} from "../config/end_point.js";

export function init() {
    $("#product-data").on("change", function (params) {
        BomData($("#product-data").val());
    });
    $("#bom-data").on("change", function (params) {
        BomDetail($("#bom-data").val());
    });
}
export async function ProductData() {
    console.log(product_data);
    try {
        const response = await fetch(product_data);
        if (response.status == 200) {
            const data = await response.json();
            setToSelectOption(data);
        } else {
            throw new Error(response.statusText);
        }
    } catch (error) {
        console.log(error);
    }
}
function setToSelectOption(data) {
    let opt = `<option value="0">Pilih Produk</select>`;
    data.forEach((element) => {
        opt =
            opt +
            `<option value="${element.id}">${element.nama_produk}</select>`;
    });
    $("#product-data").html(opt);
}
async function BomData(id) {
    try {
        const response = await fetch(`${bom_data}/${id}`);
        if (response.status == 200) {
            const data = await response.json();
            showBomData(data);
        } else {
            throw new Error(response.statusText);
        }
    } catch (error) {
        console.log(error);
    }
}
function showBomData(data) {
    let opt = `<option value="0">Pilih BOM</select>`;
    data.forEach((element) => {
        opt = opt + `<option value="${element.id}">[${element.id}]</select>`;
    });
    $("#bom-data").html(opt);
}
export async function BomDetail(id) {
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
                    return `${row.kuantitas}`;
                },
            },
        ],
    });
}
