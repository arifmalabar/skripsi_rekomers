import { delete_customer, tambah_customer } from "../../config/end_point.js";
import { deleteData } from "../../fecth/fetch.js";
import { fecthCustomer } from "../customer.js";

export function init() {
    $("tbody").on("click", ".btn-hapus", function () {
        const id = $(this).data("id");
        Swal.fire({
            title: "Menghapus data",
            text: "Apakah anda ingin menghapus data?",
            showConfirmButton: true,
            showDenyButton: true,
            confirmButtonText: "Hapus",
            denyButtonText: "Batalkan",
            icon: "info",
        }).then((result) => {
            if (result.isConfirmed) {
                deleteDataCustomer(id);
            }
        });
    });
}
async function deleteDataCustomer(id) {
    await deleteData(delete_customer, id);
    fecthCustomer();
}
