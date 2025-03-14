import { data_customer } from "../config/end_point.js";

export async function fecthCustomer() {
    try {
        const response = await fetch(data_customer);
        switch (response.status) {
            case 200:
                const data = await response.json();
                showCustomer(data);
                break;
            case 400:
                const error = await response.json();
                throw new Error(error);
                break;
            default:
                throw new Error(response.status);
                break;
        }
    } catch (error) {
        alert(error);
    }
}
function showCustomer(dt) {
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
                data: "id",
            },
            {
                data: "name",
            },
            {
                data: "notelp",
            },
            {
                data: null,
                render: function (p1, p2, row) {
                    return `
                        <a href="#" onclick="" class="btn btn-outline-info btn-sm" id="update-customer"
                            data-toggle="modal" data-target="#modal-update" data-id="${row.id}"
                            data-nik="${row.NIK}" data-nama="${row.name}"
                            data-notelp="${row.notelp}" data-email="${row.email}"
                            data-alamat="${row.alamat}"><i class="fa fa-edit"></i> Update</a>
                        <a href="#" class="btn btn-outline-danger btn-sm btn-hapus" data-target="#delete-data" data-id="${row.id}" data-csrf="{{ csrf_token() }}"><i class="fa fa-trash"></i>
                            Hapusa</a>
                    `;
                },
            },
        ],
    });
}
