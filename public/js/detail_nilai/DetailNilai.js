import { detai_nilai, nilai } from "../config/end_point.js";
import { deleteData, getData, insertData, updateData } from "../fetch/fetch.js";
import { checkFormatExcel } from "../helper/check_format_excel.js";
import { clearField, clearFields } from "../helper/clear_form.js";
import { validateEmptyField } from "../helper/form_validation.js";
import { showDlg, showMsg } from "../helper/message.js";
import {
    btnhapus,
    questhapus,
    successdeletedata,
    successtambahdata,
    successupdatedata,
} from "../helper/string.js";
import { showTables } from "../helper/table.js";
import { uploadExcel } from "../helper/upload_excel.js";
var token = "";
var lastid = "";
let selectedFile;
export function init() {
    token = $(".token").val();
    get();
    $(".btn-refresh").click(function (e) {
        get();
    });
    $(".btn-tambah").click(function (e) {
        insert();
    });
    $(".btn-upload").click(function (e) {
        upload();
    });
    $("#input-nilai").on("change", function (e) {
        selectedFile = e.target.files[0];
        try {
            checkFormatExcel(selectedFile);
        } catch (error) {
            $(this).val("");
            showMsg("Gagal", error, "error");
        }
    });
    $("body").on("click", ".btn-hapus", function () {
        deleteDataGuru($(this).data("id"));
    });
    $("body").on("click", ".btn-update", function () {
        lastid = $(this).data("id");
        $(".update-nip").val($(this).data("id"));
        $(".update-nama").val($(this).data("nama"));
    });
    $(".btn-proses-update").on("click", function () {
        update();
    });
}
async function upload() {
    let ready = [];

    try {
        checkFormatExcel(selectedFile);
        const data = await uploadExcel(selectedFile).then((e) => {
            e.forEach((element) => {
                ready.push({
                    student_id: element[0],
                    name: element[1],
                    assignment: element[2],
                    project: element[3],
                    exams: element[4],
                    attendance_presence: element[5],
                });
            });
        });
        insertData(detai_nilai, ready, token);
        get();
        showMsg("Berhasil", "Berhasil upload data", "success");
        $(".upload-file").val("");
    } catch (error) {
        showMsg("Gagal", error, "error");
    }
}
async function get() {
    try {
        var no = 1;
        var data = await getData(detai_nilai);
        var columm = [
            {
                data: null,
                render: function (p1, p2, p3) {
                    return no++;
                },
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `<b class="input-nisn">${p3.nisn}</b>`;
                },
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `<b class="input-name">${p3.nama_siswa}</b>`;
                },
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `<input type="number" style="text-align:center" value="${p3.assignment}" placeholder="Input Nilai Tugas"
                                            class="form-control input-tugas">`;
                },
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `<input type="number" style="text-align:center" value="${p3.project}" placeholder="Input Nilai Proyek"
                                            class="form-control input-proyek">`;
                },
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `<input type="number" style="text-align:center" value="${p3.exams}" placeholder="Input Nilai Ujian"
                                            class="form-control input-ujian">`;
                },
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `<input type="number" style="text-align:center" value="${p3.attendance_presence}" placeholder="Input Nilai Tugas"
                                            class="form-control input-presensi">`;
                },
            },
        ];
        showTables(data, columm);
    } catch (error) {
        showMsg(error);
    }
}
async function insert() {
    let nilai = [];
    $("#example2 tbody tr").each(function (indexInArray, valueOfElement) {
        const row = $(this);
        const student_id = row.find(".input-nisn").text().trim();
        const name = row.find(".input-name").text().trim();
        const assignment = row.find(".input-tugas").val();
        const project = row.find(".input-proyek").val();
        const exams = row.find(".input-ujian").val();
        const attendance_presence = row.find(".input-presensi").val();
        nilai.push({
            student_id,
            name,
            assignment,
            project,
            exams,
            attendance_presence,
        });
    });
    try {
        insertData(detai_nilai, nilai, token).then((e) => {
            console.log(e);
        });
        showMsg("Berhasil", successtambahdata, "success");
    } catch (error) {
        showMsg("Gagal", error, "error");
    }
}
async function update() {
    var nama = $(".update-nama").val();
    var nip = $(".update-nip").val();
    var data = {
        id: nip,
        name: nama,
    };
    try {
        //alert(`${update_guru}/${lastid}`);
        validateEmptyField(nama);
        validateEmptyField(nip);
        await updateData(`${update_guru}/${lastid}`, data, token);
        clearFields([".update-nama", ".update-nip"]);
        get();
        showMsg("Berhasil", successupdatedata, "success");
    } catch (error) {
        showMsg("Gagal", error, "error");
    }
}
async function deleteDataGuru(id) {
    try {
        await showDlg("Hapus data?", questhapus, btnhapus).then((opt) => {
            if (opt.isConfirmed) {
                deleteData(delete_guru, id, token);
            } else {
                throw "batal hapus data";
            }
        });
        get();
        showMsg("Berhasil", successdeletedata, "success");
    } catch (error) {
        showMsg("Gagal", error, "error");
    }
}
