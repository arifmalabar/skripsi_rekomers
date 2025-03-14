import { tambah_customer, update_customer } from "../../config/end_point.js";
import { updateData } from "../../fecth/fetch.js";
import { fecthCustomer } from "../customer.js";

export function init() {
    $(".btn-update").on("click", function () {
        prosesData();
    });
}
async function prosesData() {
    let data = {
        NIK: $("input[name='update-nik']").val(),
        name: $("input[name='update-nama']").val(),
        notelp: $("input[name='update-notelp']").val(),
        email: $("input[name='update-email']").val(),
        alamat: $(".update-alamat").val(),
    };
    let id = $(".id_customer").val();
    await updateData(update_customer, data, id);
    fecthCustomer();
    /*try {
        const response = await fetch(`${update_customer}/${id}`, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $(".csrf").val(),
            },
            body: JSON.stringify(data),
            method: "PUT",
        });
        if (response.status == 200) {
            const data = await response.json();
            //window.location.href = "/customer";
            Swal.fire({
                title: "Berhasil",
                text: "Berhasil mengubah data",
                icon: "success",
            });
            fecthCustomer();
        } else if (response.status == 400) {
            const error = await response.json();
            console.log(error);
        } else {
            throw new Error(response.status);
        }
    } catch (error) {
        alert(error);
    }*/
}
