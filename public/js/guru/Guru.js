import {
    delete_guru,
    get_guru,
    insert_guru,
    update_guru,
} from "../config/end_point.js";
import { deleteData, getData, insertData, updateData } from "../fetch/fetch.js";
import { clearField, clearFields } from "../helper/clear_form.js";
import { validateEmptyField } from "../helper/form_validation.js";
import { showTables } from "../helper/table.js";
var token = "";
var lastid = "";
export function init() {
    token = $(".token").val();
    get();
    $(".btn-tambah").click(function (e) {
        insert();
    });
    $("body").on("click", ".btn-hapus", function () {
        deleteDataGuru($(this).data("id"));
    });
    $("body").on("click", ".btn-update", function () {
        lastid = $(this).data("id");
        $(".update-nip").val($(this).data("id"));
        $(".update-nama").val($(this).data("nama"));
    });
    $(".btn-proses-update").on("click", function () {
        update();
    });
}
async function get() {
    try {
        var no = 1;
        var data = await getData(get_guru);
        var columm = [
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
                        <button class="btn btn-outline-warning btn-sm btn-update" data-id="${p3.id}" data-nama="${p3.name}"
                         data-toggle="modal" data-target="#modal-update"
                        >
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
        ];
        showTables(data, columm);
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
        clearFields(["#insert-nama", "#insert-nip"]);
        get();
    } catch (error) {
        alert(error);
    }
}
async function update() {
    var nama = $(".update-nama").val();
    var nip = $(".update-nip").val();
    var data = {
        id: nip,
        name: nama,
    };
    try {
        //alert(`${update_guru}/${lastid}`);
        validateEmptyField(nama);
        validateEmptyField(nip);
        await updateData(`${update_guru}/${lastid}`, data, token);
        clearFields([".update-nama", ".update-nip"]);
        get();
    } catch (error) {
        alert(error);
    }
}
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
