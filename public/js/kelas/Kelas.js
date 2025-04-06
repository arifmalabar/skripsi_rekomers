import { kelas, prodi } from "../config/end_point.js";
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
}
async function showListJurusan() {
    var data = await getData(prodi);
    var list = "<option value=''>Pilih Jurusan</option>";
    data.forEach((e) => {
        list =
            `<option value="${e.id}">${e.program_study_name}</option>` + list;
    });
    $(".list-jurusan").html(list);
}
async function get() {
    try {
        var no = 1;
        var data = await getData(kelas);
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
                data: "classname",
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
        alert(error);
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
    } catch (error) {
        alert(error);
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
    } catch (error) {
        alert(error);
    }
}
async function delData(id) {
    try {
        var opt = confirm("Apakah anda ingin mneghapus data?");
        if (opt) {
            await deleteData(kelas, id, token);
        } else {
            alert("batal hapus data");
        }
        get();
    } catch (error) {
        alert(error);
    }
}
