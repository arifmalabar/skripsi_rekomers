import { prodi } from "../config/end_point.js";
import { deleteData, getData, insertData, updateData } from "../fetch/fetch.js";
import { clearField, clearFields } from "../helper/clear_form.js";
import { validateEmptyField } from "../helper/form_validation.js";
import { showTables } from "../helper/table.js";
import { showDlg, showMsg } from "../helper/message.js";
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
                width: "5%",
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
        const coldef = [
            {
                targets: [4], // indeks kolom yang ingin diatur
                className: "text-center", // gunakan Bootstrap 5 atau ganti dengan 'dt-body-left' jika pakai DataTables style
            },
        ];
        showTables(data, columm, null, coldef);
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
        showMsg("Berhasil", "Berhasil Menambah Data", "success");
    } catch (error) {
        showMsg("Error", "Gagal Menambah Data" + error, "error");
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
        showMsg("Berhasil", "Berhasil mengubah Data", "success");
    } catch (error) {
        showMsg("Error", "Gagal mengubah Data" + error, "error");
    }
}
async function deleteDataGuru(id) {
    try {
        await showDlg(
            "Hapus Data",
            "Anda Yakin Ingin Hapus data",
            "Ya Hapus"
        ).then((opt) => {
            if (opt.isConfirmed) {
                deleteData(prodi, id, token);
            } else {
                throw "Anda membatalkan aksi";
            }
        });

        get();
        showMsg("Berhasil", "Berhasil Menghapus Data", "success");
    } catch (error) {
        showMsg("Error", "Gagal Hapus data " + error, "error");
    }
}
