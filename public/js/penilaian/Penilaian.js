import { nilai, semester } from "../config/end_point.js";
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
        course_id = $(this).data("courseid");
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
        var data = await getData(nilai);
        var columm = [
            {
                data: null,
                render: function (p1, p2, p3) {
                    return no++;
                },
            },
            {
                data: "nama_mapel",
            },
            {
                data: "semester",
            },
            {
                data: "tahun_ajar",
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `
                        
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-info btn-sm">Opsi</button>
                            <button type="button" class="btn btn-outline-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <form method="POST" action="grades_detail">
                                    <input type="hidden" value="${p3.id_kelas}" name="id_kelas">
                                    <input type="hidden" value="${p3.id_mapel}" name="id_mapel">
                                    <input type="hidden" value="${p3.tahun}" name="tahun">
                                    <input type="hidden" value="${p3.semester}" name="semester">
                                    <input type="hidden" value="${token}" name="_token">
                                    <button class="dropdown-item" type="submit">
                                        <i class="fa fa-info"></i>
                                        Tampilkan List Nilai
                                    </button>
                                </form>
                                <button class="dropdown-item"
                                data-toggle="modal" data-target="#modal-update" data-courseid="${p3.id_mapel}" data-year="${p3.tahun}" data-semester="${p3.semester}"
                                >
                                        <i class="fa fa-edit"></i>
                                        Update
                                    </button>
                                    <button class="dropdown-item btn-hapus" data-courseid="${p3.id_mapel}" data-year="${p3.tahun}" data-semester="${p3.semester}">
                                        <i class="fa fa-trash"></i>
                                        Hapus
                                    </button>
                            </div>
                        </div>
                        
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
    var id_mapel = $("#insert-mapel").val();
    var tahun = $("#insert-thajaran").val();
    var semester = $("#insert-semester").val();
    var data = {
        id_mapel: id_mapel,
        tahun: tahun,
        semester: semester,
    };
    try {
        validateEmptyField(id_mapel);
        validateEmptyField(tahun);
        validateEmptyField(semester);
        await insertData(nilai, data, token).then((e) => {
            console.log(e);
        });
        clearFields(["#insert-mapel", "#insert-thajaran", "#insert-semester"]);
        get();
    } catch (error) {
        alert(error);
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
        var opt = confirm("Apakah anda ingin mneghapus data?");
        if (opt) {
            await deleteDataByCompact(nilai, data, token).then((e) => {
                console.log(e);
            });
        } else {
            alert("batal hapus data");
        }
        get();
    } catch (error) {
        alert(error);
    }
}
