import { tahun_ajaran } from "../config/end_point.js";
import { deleteData, getData, insertData, updateData } from "../fetch/fetch.js";
import { clearField, clearFields } from "../helper/clear_form.js";
import {
    validateEmptyField,
    validateEmptyFields,
} from "../helper/form_validation.js";
import { showTables } from "../helper/table.js";
var token = "";
var lastid = "";
export function init() {
    token = $(".token").val();
    get();
    $(".btn-tambah-thajar").click(function (e) {
        insert();
    });
    $("body").on("click", ".btn-hapus-thajar", function () {
        delData($(this).data("year"));
    });
    $("body").on("click", ".btn-update-thajar", function () {
        lastid = $(this).data("year");
        $("#update-tahun-ajar").val(lastid);
        $("#update-periode").val($(this).data("academic_year"));
    });
    $(".btn-proses-update-thajar").on("click", function () {
        update();
    });
}
async function get() {
    try {
        var no = 1;
        var data = await getData(tahun_ajaran);
        var columm = [
            {
                data: null,
                render: function (p1, p2, p3) {
                    return no++;
                },
            },
            {
                data: "year",
            },
            {
                data: "academic_year",
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `
                                <button class="btn btn-outline-warning btn-sm btn-update-thajar" data-year="${p3.year}" data-academic_year="${p3.academic_year}"
                                 data-toggle="modal" data-target="#modal-update-thajar"
                                >
                                        <i class="fa fa-edit"></i>
                                        Update
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm btn-hapus-thajar" data-year="${p3.year}">
                                        <i class="fa fa-trash"></i>
                                        Hapus
                                    </button>
                            `;
                },
            },
        ];
        showTables(data, columm, "#example1");
    } catch (error) {
        alert(error);
    }
}
async function insert() {
    var tahun = $("#insert-tahun-ajar").val();
    var periode = $("#insert-periode").val();
    var data = {
        year: tahun,
        academic_year: periode,
    };
    try {
        validateEmptyField(tahun);
        validateEmptyField(tahun_ajaran);
        await insertData(tahun_ajaran, data, token);
        clearField("#insert-tahun-ajar");
        clearField("#insert-periode");
        get();
    } catch (error) {
        alert(error);
    }
}
async function update() {
    var tahun = $("#update-tahun-ajar").val();
    var periode = $("#update-periode").val();
    var data = {
        year: tahun,
        academic_year: periode,
    };
    try {
        validateEmptyField(tahun);
        validateEmptyField(tahun_ajaran);
        await updateData(`${tahun_ajaran}/${lastid}`, data, token);
        clearField("#update-tahun-ajar");
        clearField("#update-periode");
        get();
    } catch (error) {
        alert(error);
    }
}
async function delData(id) {
    try {
        var opt = confirm("Apakah anda ingin menghapus data?");
        if (opt) {
            await deleteData(tahun_ajaran, id, token);
        } else {
            alert("batal hapus data");
        }
        get();
    } catch (error) {
        alert(error);
    }
}
