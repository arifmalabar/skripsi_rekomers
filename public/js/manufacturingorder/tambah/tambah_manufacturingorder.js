import { bom_tambah } from "../../config/end_point.js";

export function init() {
    $(".btn-tambah").on("click", function () {
        tambahData();
    });
}
async function tambahData() {
    let data = {
        billofmaterials_id: $("#bom-data").val(),
        products_id: $("#product-data").val(),
        quantity: $("#kuantitas").val(),
        schedule: $("#et-mulai").val(),
        late: $("#et-selesai").val(),
    };
    try {
        const response = await fetch(bom_tambah, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $("#csrf_token").val(),
            },
            method: "POST",
            body: JSON.stringify(data),
        });
        if (response.status == 200 || response.status == 201) {
            const data = await response.json();
            window.location.href = "/manufacturing_order";
        } else {
            throw new Error(await response.json());
        }
    } catch (error) {
        console.log(error);
    }
}
