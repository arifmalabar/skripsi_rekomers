import { delete_guru, get_guru, insert_guru } from "../config/end_point.js";
import { deleteData, getData, insertData } from "../fetch/fetch.js";
import { validateEmptyField } from "../helper/form_validation.js";
var token = "";
export function init() {
    token = $(".token").val();
    get();
    $(".btn-tambah").click(function (e) {
        insert();
    });
    $("body").on("click", ".btn-hapus", function () {
        deleteDataGuru($(this).data("id"));
    });
}
async function get() {
    try {
        var no = 1;
        $("#example2").DataTable({
            paging: true,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            bDestroy: true,
            data: await getData(get_guru),
            columns: [
                {
                    data: null,
                    render: function (p1, p2, p3) {
                        return no++;
                    },
                },
                {
                    data: "id",
                },
                {
                    data: "name",
                },
                {
                    data: null,
                    render: function (p1, p2, p3) {
                        return `<span class="badge badge-success">Aktif</span>`;
                    },
                },
                {
                    data: null,
                    render: function (p1, p2, p3) {
                        return `
                            <button class="btn btn-outline-warning btn-sm" data-id="${p3.id}" data-nama="${p3.name}">
                                    <i class="fa fa-edit"></i>
                                    Update
                                </button>
                                <button class="btn btn-outline-danger btn-sm btn-hapus" data-id="${p3.id}">
                                    <i class="fa fa-trash"></i>
                                    Hapus
                                </button>
                        `;
                    },
                },
            ],
        });
    } catch (error) {
        alert(error);
    }
}
async function insert() {
    var nama = $("#insert-nama").val();
    var nip = $("#insert-nip").val();
    var data = {
        id: nip,
        name: nama,
    };
    try {
        validateEmptyField(nama);
        validateEmptyField(nip);
        await insertData(insert_guru, data, token);
        alert("insert success");
    } catch (error) {
        alert(error);
    }
    get();
}
function update() {}
async function deleteDataGuru(id) {
    try {
        var opt = confirm("Apakah anda ingin mneghapus data?");
        if (opt) {
            await deleteData(delete_guru, id, token);
        } else {
            alert("batal hapus data");
        }
        get();
    } catch (error) {
        alert(error);
    }
}
