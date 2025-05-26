import {
    delete_guru,
    get_guru,
    insert_guru,
    update_guru,
} from "../config/end_point.js";
import { deleteData, getData, insertData, updateData } from "../fetch/fetch.js";
import { clearField, clearFields } from "../helper/clear_form.js";
import { validateEmptyField } from "../helper/form_validation.js";
import { showDlg, showMsg } from "../helper/message.js";
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
        $("#update-username").val($(this).data("username"));
        $("#update-old-password").val($(this).data("password"));
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
                    return `
                        <button class="btn btn-outline-warning btn-sm btn-update" data-id="${p3.id}" data-nama="${p3.name}" data-username="${p3.username}" data-password="${p3.password}"
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
        showMsg("Error", "Gagal Menambah Data" + error, "error");
    }
}
async function insert() {
    var nama = $("#insert-nama").val();
    var nip = $("#insert-nip").val();
    var username = $("#insert-username").val();
    var password = $("#insert-password").val();
    var role = $("#insert-role").val();
    var data = {
        id: nip,
        name: nama,
        username: username,
        password: password,
        role: role,
    };
    try {
        validateEmptyField(nama);
        validateEmptyField(nip);
        validateEmptyField(username);
        validateEmptyField(password);
        await insertData(insert_guru, data, token);
        clearFields([
            "#insert-nama",
            "#insert-nip",
            "#insert-username",
            "#insert-password",
        ]);
        get();
        showMsg("Berhasil", "Berhasil Menambah Data", "success");
    } catch (error) {
        showMsg("Error", "Gagal Menambah Data" + error, "error");
    }
}
async function update() {
    var nama = $(".update-nama").val();
    var nip = $(".update-nip").val();
    var username = $("#insert-username").val();
    var password = $("#insert-password").val();
    var oldpassword = $("#update-old-password").val();
    var role = $("#insert-role").val();
    var data = {
        id: nip,
        name: nama,
        username: username,
        password: password === "" ? oldpassword : password,
        role: role,
    };
    try {
        validateEmptyField(nama);
        validateEmptyField(nip);
        validateEmptyField(username);
        validateEmptyField(password);
        await updateData(`${update_guru}/${lastid}`, data, token).then((e) => {
            console.log(e);
        });
        clearFields([
            ".update-nama",
            ".update-nip",
            "#insert-username",
            "#insert-password",
        ]);
        get();
        showMsg("Berhasil", "Berhasil mengubah Data", "success");
    } catch (error) {
        showMsg("Error", "Gagal mengubah Data" + error, "error");
    }
}
async function deleteDataGuru(id) {
    try {
        await showDlg(
            "Hapus Data",
            "Anda Yakin Ingin Hapus data",
            "Ya Hapus"
        ).then((opt) => {
            if (opt.isConfirmed) {
                deleteData(delete_guru, id, token);
            } else {
                throw "anda membatalkan aksi hapus";
            }
        });

        get();
        showMsg("Berhasil", "Berhasil Menghapus Data", "success");
    } catch (error) {
        showMsg("Error", "Gagal Menambah Data " + error, "error");
    }
}
