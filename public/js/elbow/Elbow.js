import { elbow } from "../config/end_point.js";
import { getData } from "../fetch/fetch.js";
import { showMsg } from "../helper/message.js";
export async function showElbow() {
    try {
        const data = await getData(elbow);
        console.log(data);
        showGraphic(data);
    } catch (error) {
        showMsg("Gagal", `Data gagal ditampilkan ${error}`, "error");
    }
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
