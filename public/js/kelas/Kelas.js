import { kelas, prodi } from "../config/end_point.js";
import { deleteData, getData, insertData, updateData } from "../fetch/fetch.js";
import { clearField, clearFields } from "../helper/clear_form.js";
import { validateEmptyField } from "../helper/form_validation.js";
import { showDlg, showMsg } from "../helper/message.js";
import {
    btnhapus,
    cancelhapus,
    confirmhapus,
    questhapus,
    successdeletedata,
    successtambahdata,
    successupdatedata,
} from "../helper/string.js";
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
        delData($(this).data("id"));
    });
    $("body").on("click", ".btn-update", function () {
        lastid = $(this).data("id");
        //$(".update-kode-prodi").val($(this).data("id"));
        $(".update-nama-kelas").val($(this).data("namakelas"));
    });
    $(".btn-proses-update").on("click", function () {
        update();
    });
    showListJurusan();
    $(".list-jurusan").change(function (e) {
        var id = $(this).val();
        get(id);
    });
}
async function showListJurusan() {
    var data = await getData(prodi);
    var list = "<option value=''>Pilih Jurusan</option>";
    data.forEach((e) => {
        list += `<option value="${e.id}">${e.program_study_name}</option>`;
    });
    $(".list-jurusan").html(list);
}
async function get(id = null) {
    try {
        var no = 1;
        var data =
            id == null ? await getData(kelas) : await getData(`${kelas}/${id}`);
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
                data: null,
                render: function (p1, p2, p3) {
                    return `<a href="/kakomli/detail_kelas/${p3.id}">${p3.classname}</href>`;
                },
            },
            {
                data: "nama_jurusan",
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `<span class="badge badge-primary">${p3.jml_siswa}</span>`;
                },
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `
                                <button class="btn btn-outline-warning btn-sm btn-update" data-id="${p3.id}" data-namakelas="${p3.classname}" data-kodejurusan="1"
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
        showMsg("Error", `${error}`, "error");
    }
}
async function insert() {
    var nama = $(".insert-nama-kelas").val();
    var kode_jurusan = $(".insert-kode-jurusan").val();
    var data = {
        classname: nama,
        program_study_id: kode_jurusan,
    };
    try {
        validateEmptyField(nama);
        validateEmptyField(kode_jurusan);
        await insertData(kelas, data, token);
        clearField(".insert-nama-kelas");
        get();
        showMsg("Success", successtambahdata, "success");
    } catch (error) {
        showMsg("Error", `${error}`, "error");
    }
}
async function update() {
    var nama = $(".update-nama-kelas").val();
    var kode_jurusan = $(".update-kode-jurusan").val();
    var data = {
        classname: nama,
        program_study_id: kode_jurusan,
    };
    try {
        validateEmptyField(nama);
        validateEmptyField(kode_jurusan);
        await updateData(`${kelas}/${lastid}`, data, token);
        clearField(".insert-nama-kelas");
        get();
        showMsg("Berhasil", successupdatedata, "success");
    } catch (error) {
        showMsg("Error", `${error}`, "error");
    }
}
async function delData(id) {
    try {
        await showDlg(questhapus, confirmhapus, btnhapus).then((e) => {
            if (e.isConfirmed) {
                deleteData(kelas, id, token);
            } else {
                throw cancelhapus;
            }
        });
        get();
        showMsg("Berhasil", successdeletedata, "success");
    } catch (error) {
        showMsg("Error", `${error}`, "error");
    }
}
