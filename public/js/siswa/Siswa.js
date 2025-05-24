import { siswa, prodi } from "../config/end_point.js";
import { deleteData, getData, insertData, updateData } from "../fetch/fetch.js";
import { clearField, clearFields } from "../helper/clear_form.js";
import { validateEmptyField } from "../helper/form_validation.js";
import { showTables } from "../helper/table.js";
import { uploadExcel } from "../helper/upload_excel.js";
var token = "";
var lastid = "";
let selectedFile;
var pria = 0,
    wanita = 0;
export function init() {
    token = $(".token").val();
    get();
    $(".btn-tambah").click(function (e) {
        insert();
    });
    $("body").on("click", ".btn-hapus", function () {
        delData($(this).data("id"));
    });
    $(".upload-siswa").change(function (e) {
        selectedFile = e.target.files[0];
    });
    $("body").on("click", ".btn-update", function () {
        lastid = $(this).data("id");
        $(".update-nisn").val($(this).data("id"));
        $(".update-nama").val($(this).data("nama"));
    });
    $(".btn-proses-update").on("click", function () {
        update();
    });
    $(".btn-upload").click(function () {
        uploadDataSiswa();
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
    pria = 0;
    wanita = 0;
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
                data: null,
                render: function (p1, p2, p3) {
                    if (p3.gender === "pria") {
                        pria += 1;
                    } else if (p3.gender === "wanita") {
                        wanita += 1;
                    }
                    return p3.gender;
                },
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
        $(".jk-pria").text(pria);
        $(".jk-wanita").text(wanita);
    } catch (error) {
        alert(error);
    }
}
async function uploadDataSiswa() {
    try {
        let data = [];
        await uploadExcel(selectedFile).then((e) => {
            e.forEach((element) => {
                data.push({
                    id: element[0],
                    name: element[1],
                    gender: element[2],
                });
            });
        });
        await insertData(`${siswa}/multiple`, data, token).then((e) => {
            console.log(e);
        });
        get();
    } catch (error) {
        console.log(error);
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
