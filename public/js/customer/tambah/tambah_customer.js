import { tambah_customer } from "../../config/end_point.js";
import { postData } from "../../fecth/fetch.js";
import { fecthCustomer } from "../customer.js";

export function init() {
    $(".btn-proses").on("click", function () {
        prosesData();
    });
}
async function prosesData() {
    let data = {
        NIK: $("input[name='nik']").val(),
        name: $("input[name='nama']").val(),
        notelp: $("input[name='notelp']").val(),
        email: $("input[name='email']").val(),
        alamat: $("#alamat").val(),
    };
    await postData(tambah_customer, data);
    fecthCustomer();
}
