import { dashboard } from "../config/end_point.js";
import { getData } from "../fetch/fetch.js";
import { showDlg, showMsg } from "../helper/message.js";

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
        showBar(presentase);
    } catch (error) {
        showMsg("Erorr", "Gagal menampilkan data " + error, "error");
    }
}
function showBar(presentase) {
    var areaChartData = {
        labels: ["Risiko Tinggi", "Risiko Tengah", "Risiko Rendah"],
        datasets: [
            {
                label: "Digital Goods",
                backgroundColor: "rgba(60,141,188,0.9)",
                borderColor: "rgba(60,141,188,0.8)",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: [
                    presentase.risiko_tinggi,
                    presentase.risiko_tengah,
                    presentase.risiko_rendah,
                ],
            },
            {
                label: "Electronics",
                backgroundColor: "rgba(210, 214, 222, 1)",
                borderColor: "rgba(210, 214, 222, 1)",
                pointRadius: false,
                pointColor: "rgba(210, 214, 222, 1)",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [],
            },
        ],
    };

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false,
        },
        scales: {
            xAxes: [
                {
                    gridLines: {
                        display: false,
                    },
                },
            ],
            yAxes: [
                {
                    gridLines: {
                        display: false,
                    },
                },
            ],
        },
    };

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChartData = $.extend(true, {}, areaChartData);
    var temp0 = areaChartData.datasets[0];
    var temp1 = areaChartData.datasets[1];
    barChartData.datasets[0] = temp1;
    barChartData.datasets[1] = temp0;

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
    };

    new Chart(barChartCanvas, {
        type: "bar",
        data: barChartData,
        options: barChartOptions,
    });
}
