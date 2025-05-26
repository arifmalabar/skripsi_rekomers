import { clustering, nilai, semester } from "../config/end_point.js";
import {
    deleteData,
    deleteDataByCompact,
    getData,
    insertData,
    updateData,
} from "../fetch/fetch.js";
import { clearField, clearFields } from "../helper/clear_form.js";
import {
    setCbMapel,
    setCbSemester,
    setCbThAjar,
} from "../helper/fill_combobox.js";
import { validateEmptyField } from "../helper/form_validation.js";
import { showDlg, showMsg } from "../helper/message.js";
import {
    cancelhapus,
    confirmhapus,
    failloadata,
    questhapus,
    successdeletedata,
    successtambahdata,
} from "../helper/string.js";
import { showTables } from "../helper/table.js";
var token = "";
var lastid = "";
var course_id;
var year;
var smt;
export function init() {
    token = $(".token").val();
    get();
    setCbSemester();
    setCbThAjar();
    setCbMapel();
    $(".btn-tambah").click(function (e) {
        insert();
    });
    $("body").on("click", ".btn-hapus", function () {
        //deleteDataGuru($(this).data("id"));
        course_id = $(this).data("id");
        year = $(this).data("year");
        smt = $(this).data("semester");
        const data = {
            course_id: course_id,
            year: year,
            semester: smt,
        };
        deleteDataNilai(data);
    });
    $("body").on("click", ".btn-update", function () {
        course_id = $(this).data("courseid");
        year = $(this).data("year");
        smt = $(this).data("semester");
        $("#last_course_id").val($(this).data("courseid"));
        $("#last_year").val(year);
        $("#last_semester").val(smt);
    });
    $(".btn-proses-update").on("click", function () {
        const data = {
            course_id: course_id,
            year: year,
            semester: smt,
        };
        console.log(data);
        //update(data);
    });
}
async function get() {
    try {
        var no = 1;
        var data = await getData(clustering);
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
                    return `${p3.semester}/${p3.year}`;
                },
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `
                            <form method="POST" action="clustering/detail">
                                    <input type="hidden" value="${p3.course_id}" name="course_id">
                                    <input type="hidden" value="${p3.semester}" name="semester">
                                    <input type="hidden" value="${p3.year}" name="year">
                                    <input type="hidden" value="${token}" name="_token">
                                    <button class="btn btn-outline-primary btn-sm" type="submit" data-id="${p3.course_id}"
                         data-toggle="modal">
                                    <i class="fa fa-info"></i>
                                    Detail
                                </button>
                            </form>
                        
                            <button class="btn btn-outline-danger btn-sm btn-hapus" data-id="${p3.course_id}" data-semester="${p3.semester}" data-year="${p3.year}">
                                <i class="fa fa-trash"></i>
                                Hapus
                            </button>
                        
                    `;
                },
            },
        ];
        showTables(data, columm);
    } catch (error) {
        showMsg("Error", error, "error");
    }
}
async function insert() {
    var id_mapel = $("#insert-mapel").val();
    var tahun = $("#insert-thajaran").val();
    var semester = $("#insert-semester").val();
    var data = {
        course_id: id_mapel,
        year: tahun,
        semester: semester,
    };
    try {
        validateEmptyField(id_mapel);
        validateEmptyField(tahun);
        validateEmptyField(semester);
        await insertData(clustering, data, token).then((e) => {
            console.log(e);
        });
        clearFields(["#insert-mapel", "#insert-thajaran", "#insert-semester"]);
        get();
        showMsg("Berhasil", successtambahdata, "success");
    } catch (error) {
        showMsg("Gagal", failloadata, "error");
    }
}
async function update(last_data) {
    var id_mapel = $("#update-mapel").val();
    var tahun = $("#update-thajaran").val();
    var semester = $("#update-semester").val();
    var data = {
        id_mapel: id_mapel,
        tahun: tahun,
        semester: semester,
    };
    data = { ...data, last_data };
    console.log(data);

    /*try {
        //alert(`${update_guru}/${lastid}`);
        await updateData(`${nilai}/0`, data, token);
        clearFields([".update-nama", ".update-nip"]);
        get();
    } catch (error) {
        alert(error);
    }*/
}
async function deleteDataNilai(data) {
    try {
        await showDlg("Hapus Data?", confirmhapus, "Ya, Hapus cluster").then(
            (opt) => {
                if (opt.isConfirmed) {
                    deleteDataByCompact(clustering, data, token).then((e) => {
                        console.log(e);
                    });
                } else {
                    throw cancelhapus;
                }
            }
        );

        get();
        showMsg("Berhasil", successdeletedata, "success");
    } catch (error) {
        showMsg("Gagal", error, "error");
    }
}
