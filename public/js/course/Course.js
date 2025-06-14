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
import { showMsg, showDlg } from "../helper/message.js";
import {
    failloadata,
    successdeletedata,
    successtambahdata,
    successupdatedata,
    confirmhapus,
    btnhapus,
    cancelhapus,
} from "../helper/string.js";
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
                width: "5%",
            },
            {
                data: "course_name",
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
        const coldef = [
            {
                targets: [0, 1], // indeks kolom yang ingin diatur
                className: "text-start", // gunakan Bootstrap 5 atau ganti dengan 'dt-body-left' jika pakai DataTables style
            },
            {
                targets: [2], // indeks kolom yang ingin diatur
                className: "text-center", // gunakan Bootstrap 5 atau ganti dengan 'dt-body-left' jika pakai DataTables style
            },
        ];
        showTables(data, columm, null, coldef);
    } catch (error) {
        showMsg("Gagal", failloadata, "error");
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
        showMsg("Berhasil", successtambahdata, "success");
    } catch (error) {
        showMsg("Gagal", error, "error");
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
        showMsg("Berhasil", successupdatedata, "success");
    } catch (error) {
        showMsg("Gagal", error, "error");
    }
}
async function deleteDataGuru(id) {
    try {
        await showDlg("Hapus data?", confirmhapus, btnhapus).then((opt) => {
            if (opt.isConfirmed) {
                deleteData(mapel, id, token);
            } else {
                throw cancelhapus;
            }
        });
        get();
        showMsg("Berhasil", successdeletedata, "success");
    } catch (error) {
        showMsg("Gagal", error, "error");
    }
}
