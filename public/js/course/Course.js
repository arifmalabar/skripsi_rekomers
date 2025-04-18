import { mapel, semester } from "../config/end_point.js";
import { deleteData, getData, insertData, updateData } from "../fetch/fetch.js";
import { clearField, clearFields } from "../helper/clear_form.js";
import {
    setCbGuru,
    setCbKelas,
    setCbSemester,
    setCbThAjar,
} from "../helper/fill_combobox.js";
import { validateEmptyField } from "../helper/form_validation.js";
import { showTables } from "../helper/table.js";
var token = "";
var lastid = "";
export function init() {
    token = $(".token").val();
    get();
    setCbSemester();
    setCbThAjar();
    setCbKelas();
    setCbGuru();
    $(".btn-tambah").click(function (e) {
        insert();
    });
    $("body").on("click", ".btn-hapus", function () {
        deleteDataGuru($(this).data("id"));
    });
    $("body").on("click", ".btn-update", function () {
        lastid = $(this).data("id");
        $("#update-nm-mapel").val($(this).data("nama"));
    });
    $(".btn-proses-update").on("click", function () {
        update();
    });
}

async function get() {
    try {
        var no = 1;
        var data = await getData(mapel);
        var columm = [
            {
                data: null,
                render: function (p1, p2, p3) {
                    return no++;
                },
            },
            {
                data: "course_name",
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
                        <button class="btn btn-outline-warning btn-sm btn-update" data-id="${p3.id}" data-nama="${p3.course_name}" data-semester="${p3.semester_id}" data-year="${p3.year}" data-classroom="${p3.classroom_id}" data-teacher="${p3.teacher_id}"
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
    var nama = $("#insert-nm-mapel").val();
    var semester = $("#insert-semester").val();
    var th_ajar = $("#insert-thajar").val();
    var kelas = $("#insert-kelas").val();
    var guru = $("#insert-guru").val();
    var data = {
        course_name: nama,
        teacher_id: guru,
        year: th_ajar,
        classroom_id: kelas,
        semester_id: semester,
    };
    try {
        validateEmptyField(nama);
        validateEmptyField(guru);
        validateEmptyField(th_ajar);
        validateEmptyField(kelas);
        validateEmptyField(semester);
        await insertData(mapel, data, token);
        clearFields([
            "#insert-nm-mapel",
            "#insert-semester",
            "#insert-thajar",
            "#insert-kelas",
            "#insert-guru",
        ]);
        get();
    } catch (error) {
        alert(error);
    }
}
async function update() {
    var nama = $("#update-nm-mapel").val();
    var semester = $("#update-semester").val();
    var th_ajar = $("#update-thajar").val();
    var kelas = $("#update-kelas").val();
    var guru = $("#update-guru").val();
    var data = {
        course_name: nama,
        teacher_id: guru,
        year: th_ajar,
        classroom_id: kelas,
        semester_id: semester,
    };
    try {
        validateEmptyField(nama);
        validateEmptyField(guru);
        validateEmptyField(th_ajar);
        validateEmptyField(kelas);
        validateEmptyField(semester);
        await updateData(`${mapel}/${lastid}`, data, token);
        clearFields([
            "#update-nm-mapel",
            "#update-semester",
            "#update-thajar",
            "#update-kelas",
            "#update-guru",
        ]);
        get();
    } catch (error) {
        alert(error);
    }
}
async function deleteDataGuru(id) {
    try {
        var opt = confirm("Apakah anda ingin mneghapus data?");
        if (opt) {
            await deleteData(mapel, id, token);
        } else {
            alert("batal hapus data");
        }
        get();
    } catch (error) {
        alert(error);
    }
}
