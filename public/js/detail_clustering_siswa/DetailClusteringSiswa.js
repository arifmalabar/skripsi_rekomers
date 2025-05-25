import { detail_cluster_siswa } from "../config/end_point.js";
import { deleteData, getData, insertData, updateData } from "../fetch/fetch.js";
import { showInformation } from "../helper/information_box.js";
import { showTables } from "../helper/table.js";

export function init() {
    get();
}
async function get() {
    try {
        var no = 1;
        var data = await getData(detail_cluster_siswa);
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
                data: "year",
            },
            {
                data: "semester",
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    if (p3.cluster == "C1") {
                        return `<span class="badge badge-danger">${p3.cluster}/${p3.risk}</span>`;
                    } else if (p3.cluster == "C2") {
                        return `<span class="badge badge-warning">${p3.cluster}/${p3.risk}</span>`;
                    } else {
                        return `<span class="badge badge-success">${p3.cluster}/${p3.risk}</span>`;
                    }
                },
            },
        ];
        showTables(data["hasil_cluster"], columm);
        showBiodata(data["data_siswa"]);
        risikoSiswa(data["hasil_cluster"]);
        rekomendasiBelajar(data["hasil_cluster"]);
    } catch (error) {
        alert(error);
    }
}
function showBiodata(data) {
    $(".biodata-nama").text(data["name"]);
    $(".biodata-nisn").text(data["id"]);
}
function rekomendasiBelajar(data) {
    let rekomendasi = "";
    let tambah_nilai = "";
    data.forEach((element) => {
        if (element.cluster === "C1") {
            rekomendasi += `${element.course_name} (${element.year}/${element.semester}), `;
        } else if (element.cluster === "C2") {
            tambah_nilai += `${element.course_name} (${element.year}/${element.semester}), `;
        }
    });

    $(".rekomendasi-belajar").text(rekomendasi);
    $(".rekomendasi-tambah-nilai")
        .html(`<strong><u>Catatan Tambahan: </u></strong>

                        <p class="text-muted">
                            Siswa Memerlukan tambahan nilai di mata pelajaran<br>
                            <b class="text-warning rekomendasi-belajar">${tambah_nilai}</b>
                        </p>`);
}
function risikoSiswa(data) {
    var c1 = 0,
        c2 = 0,
        c3 = 0;

    data.forEach((element) => {
        if (element.cluster === "C1") {
            c1++;
        } else if (element.cluster === "C2") {
            c2++;
        } else if (element.cluster === "C3") {
            c3++;
        }
    });
    //alert(c1 >= c2 && c1 >= c3);
    const obj = ".biodata-risiko";
    $(obj).removeClass("badge-danger");
    if (c1 >= c2 && c1 >= c3) {
        $(obj).text("High Risk");
        showInformation(
            "alert-danger",
            "Peringatan",
            "Siswa termasuk dalam risiko tinggi lemah di dalam mata pelajaran, segera lakukan perbaikan"
        );
        $(obj).addClass("badge-danger");
    } else if (c2 >= c3 && c2 >= c1) {
        $(obj).text("Medium Risk");
        showInformation(
            "alert-warning",
            "Perhatian",
            "Siswa termasuk dalam risiko Menengah pertahankan nilai siswa"
        );
        $(obj).addClass("badge-warning");
    } else if (c3 >= c1 && c3 >= c2) {
        $(obj).text("Low Risk");
        showInformation(
            "alert-success",
            "Perhatian",
            "Siswa termasuk dalam risiko rendah"
        );
        $(obj).addClass("badge-success");
    }
}
