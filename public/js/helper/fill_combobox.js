import { kelas, semester, tahun_ajaran } from "../config/end_point.js";
import { getData } from "../fetch/fetch.js";
export async function setCbSemester() {
    const data = await getData(semester);
    var list = `<option value="">Pilih Semester</option>`;
    data.forEach((element) => {
        list += `<option value="${element.semester}">${element.semester}</option>`;
    });
    $(".cb-semester").html(list);
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
    var list = `<option value="">Pilih Th Ajaran</option>`;
    data.forEach((element) => {
        list += `<option value="${element.id}">${element.classname}</option>`;
    });
    $(".cb-kelas").html(list);
}
