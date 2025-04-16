import { siswa, prodi } from "../config/end_point.js";
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
        $(".update-nisn").val($(this).data("id"));
        $(".update-nama").val($(this).data("nama"));
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
        var data = await getData(siswa);
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
                data: "gender",
            },

            {
                data: null,
                render: function (p1, p2, p3) {
                    return `
                        <button class="btn btn-outline-warning btn-sm btn-update" data-id="${p3.id}" data-nama="${p3.name}" data-jk="${p3.gender}"
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
    var nisn = $(".insert-nisn").val();
    var nama = $(".insert-nama").val();
    var gender = $(".insert-gender").val();
    var data = {
        id: nisn,
        name: nama,
        gender: gender,
    };
    try {
        validateEmptyField(nisn);
        validateEmptyField(nama);
        validateEmptyField(gender);
        await insertData(siswa, data, token);
        clearField(".insert-nisn");
        clearField(".insert-nama");
        get();
    } catch (error) {
        alert(error);
    }
}
async function update() {
    var nisn = $(".update-nisn").val();
    var nama = $(".update-nama").val();
    var gender = $(".update-gender").val();
    var data = {
        id: nisn,
        name: nama,
        gender: gender,
    };
    try {
        validateEmptyField(nisn);
        validateEmptyField(nama);
        validateEmptyField(gender);
        await updateData(`${siswa}/${lastid}`, data, token);
        clearField(".update-nisn");
        clearField(".update-nama");
        get();
    } catch (error) {
        alert(error);
    }
}
async function delData(id) {
    try {
        var opt = confirm("Apakah anda ingin mneghapus data?");
        if (opt) {
            await deleteData(siswa, id, token);
        } else {
            alert("batal hapus data");
        }
        get();
    } catch (error) {
        alert(error);
    }
}
