import { dashboard } from "../config/end_point.js";
import { getData } from "../fetch/fetch.js";

export async function get() {
    try {
        let data = await getData(dashboard);
        $(".jml_siswa").text(data.jml_siswa);
        $(".jml_jurusan").text(data.jumlah_jurusan);
        $(".jml_guru").text(data.jumlah_guru);
        let presentase = data.presentase;
        $(".high-risk").text(`${presentase.risiko_tinggi} %`);
        $(".mid-risk").text(`${presentase.risiko_tengah} %`);
        $(".low-risk").text(`${presentase.risiko_rendah} %`);
    } catch (error) {
        alert(error);
    }
}
