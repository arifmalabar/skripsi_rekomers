import { prodi } from "../config/end_point.js";
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
        $(".update-kode-prodi").val($(this).data("id"));
        $(".update-nama-prodi").val($(this).data("nama"));
    });
    $(".btn-proses-update").on("click", function () {
        update();
    });
}
async function get() {
    try {
        var no = 1;
        var data = await getData(prodi);
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
                data: "program_study_name",
            },
            {
                data: "jml_kelas",
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
                        <button class="btn btn-outline-warning btn-sm btn-update" data-id="${p3.id}" data-nama="${p3.program_study_name}"
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
    var nama = $(".insert-nama-prodi").val();
    var kode = $(".insert-kode-prodi").val();
    var data = {
        id: kode,
        program_study_name: nama,
    };
    try {
        validateEmptyField(nama);
        validateEmptyField(kode);
        await insertData(prodi, data, token);
        clearFields([".insert-nama-prodi", ".insert-kode-prodi"]);
        get();
    } catch (error) {
        alert(error);
    }
}
async function update() {
    var nama = $(".update-nama-prodi").val();
    var kode = $(".update-kode-prodi").val();
    var data = {
        id: kode,
        program_study_name: nama,
    };
    try {
        //alert(`${update_guru}/${lastid}`);
        validateEmptyField(nama);
        validateEmptyField(kode);
        await updateData(`${prodi}/${lastid}`, data, token);
        clearFields([".update-nama-prodi", ".update-kode-prodi"]);
        get();
    } catch (error) {
        alert(error);
    }
}
async function deleteDataGuru(id) {
    try {
        var opt = confirm("Apakah anda ingin mneghapus data?");
        if (opt) {
            await deleteData(prodi, id, token);
        } else {
            alert("batal hapus data");
        }
        get();
    } catch (error) {
        alert(error);
    }
}
