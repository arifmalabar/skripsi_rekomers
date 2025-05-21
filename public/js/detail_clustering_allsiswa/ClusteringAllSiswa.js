import {
    all_cluster_siswa,
    detail_cluster_siswa,
} from "../config/end_point.js";
import { deleteData, getData, insertData, updateData } from "../fetch/fetch.js";
import { showInformation } from "../helper/information_box.js";
import { showTables } from "../helper/table.js";

export function init() {
    get();
}
async function get() {
    try {
        var no = 1;
        var data = await getData(all_cluster_siswa);
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
                    return `<a href="/kakomli/detail_cluster/clustering_siswa/${p3.id}">${p3.id}</a>`;
                },
            },
            {
                data: "name",
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    if (p3.risiko === "high") {
                        return `<span class="badge badge-danger">${p3.risiko}</span>`;
                    } else if (p3.risiko === "medium") {
                        return `<span class="badge badge-warning">${p3.risiko}</span>`;
                    } else if (p3.risiko === "low") {
                        return `<span class="badge badge-success">${p3.risiko}</span>`;
                    } else {
                        return `<span class="badge badge-primary">undefined</span>`;
                    }
                },
            },
        ];
        showTables(data, columm);
    } catch (error) {
        alert(error);
    }
}
