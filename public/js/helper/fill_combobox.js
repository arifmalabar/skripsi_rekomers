import {
    get_guru,
    kelas,
    semester,
    tahun_ajaran,
} from "../config/end_point.js";
import { getData } from "../fetch/fetch.js";
export async function setCbSemester(id = null, cbid = null) {
    const data = await getData(semester);
    var list = `<option value="">Pilih Semester</option>`;
    data.forEach((element) => {
        if (id != null && element.id === id) {
            list += `<option selected value="${element.semester}">${element.semester}</option>`;
        } else if (id != null && element.id !== id) {
            list += `<option value="${element.semester}">${element.semester}</option>`;
        } else {
            list += `<option value="${element.semester}">${element.semester}</option>`;
        }
    });
    $(cbid == null ? ".cb-semester" : cbid).html(list);
}
export async function setCbThAjar() {
    const data = await getData(tahun_ajaran);
    var list = `<option value="">Pilih Th Ajaran</option>`;
    data.forEach((element) => {
        list += `<option value="${element.year}">${element.academic_year}</option>`;
    });
    $(".cb-thajar").html(list);
}
export async function setCbKelas() {
    const data = await getData(kelas);
    var list = `<option value="">Pilih Kelas</option>`;
    data.forEach((element) => {
        list += `<option value="${element.id}">${element.classname}</option>`;
    });
    $(".cb-kelas").html(list);
}
export async function setCbGuru() {
    const data = await getData(get_guru);
    var list = `<option value="">Pilih Guru</option>`;
    data.forEach((element) => {
        list += `<option value="${element.id}">${element.name}</option>`;
    });
    $(".cb-guru").html(list);
}
