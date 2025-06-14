import { prodi, semester } from "../config/end_point.js";
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
        lastid = $(this).data("semester");
        $("#update-semester").val($(this).data("semester"));
    });
    $(".btn-proses-update").on("click", function () {
        update();
    });
}
async function get() {
    try {
        var no = 1;
        var data = await getData(semester);
        var columm = [
            {
                data: null,
                render: function (p1, p2, p3) {
                    return no++;
                },
            },
            {
                data: "semester",
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `
                        <button class="btn btn-outline-warning btn-sm btn-update" data-semester="${p3.semester}"
                         data-toggle="modal" data-target="#modal-update-semester"
                        >
                                <i class="fa fa-edit"></i>
                                Update
                            </button>
                    `;
                },
            },
        ];
        const coldef = [
            {
                targets: [2], // indeks kolom yang ingin diatur
                className: "text-center", // gunakan Bootstrap 5 atau ganti dengan 'dt-body-left' jika pakai DataTables style
            },
        ];
        showTables(data, columm, null, coldef);
    } catch (error) {
        alert(error);
    }
}
async function insert() {
    var smt = $("#insert-semester").val();
    var data = {
        semester: smt,
    };
    try {
        validateEmptyField(smt);
        await insertData(semester, data, token);
        clearField("#insert-semester");
        get();
    } catch (error) {
        alert(error);
    }
}
async function update() {
    var smt = $("#update-semester").val();
    var data = {
        semester: smt,
    };
    try {
        validateEmptyField(smt);
        await updateData(`${semester}/${lastid}`, data, token);
        clearField("#update-semester");
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
