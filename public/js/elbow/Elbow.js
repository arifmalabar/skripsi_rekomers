import { elbow } from "../config/end_point.js";
import { getData } from "../fetch/fetch.js";
import { showMsg } from "../helper/message.js";
import { showTables } from "../helper/table.js";
export async function showElbow() {
    try {
        const data = await getData(elbow).then((e) => {
            showGraphic(e);
            showDetailElbow(e);
        });
    } catch (error) {
        showMsg("Gagal", `Data gagal ditampilkan ${error}`, "error");
    }
}
function showDetailElbow(dt) {
    var columm = [
        {
            data: "K",
        },
        {
            data: "WCSS",
        },
    ];

    const coldef = [
        {
            targets: "_all",
            className: "text-center",
        },
    ];

    showTables(dt, columm, "#exampe1", coldef);
}
function showGraphic(data) {
    $.plot(
        "#elbowChart",
        [
            {
                data: data.map((item) => [item.K, item.WCSS]),
                label: "WCSS vs K",
                lines: { show: true },
                points: { show: true },
            },
        ],
        {
            xaxis: {
                tickDecimals: 0,
                axisLabel: "K (jumlah kluster)",
            },
            yaxis: {
                axisLabel: "WCSS (Within Cluster Sum of Squares)",
            },
            grid: {
                hoverable: true,
                clickable: true,
            },
        }
    );
    /* END LINE CHART */
}
