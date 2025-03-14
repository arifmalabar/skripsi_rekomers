import { React, useState } from "react";
import ReactDOM from "react-dom";
let data = [
    {
        nama: "sampo",
        harga: 45000,
        stok: 1,
        status: "produk",
    },
    {
        nama: "sampo",
        harga: 45000,
        stok: 4,
        status: "bahan",
    },
    {
        nama: "sampo",
        harga: 45000,
        stok: 4,
        status: "bahan",
    },
    {
        nama: "sampo",
        harga: 45000,
        stok: 4,
        status: "bahan",
    },
];
function Manufacturing() {
    let no = 1;
    return data.map((e) => (
        <tr>
            <td>{no++}</td>
            <td>{e.nama}</td>
            <td>{e.harga}</td>
            <td>{e.stok}</td>
            <td>
                <IsBahan jenis={e.status} />
            </td>
            <td>
                <center>
                    <button
                        class="btn btn-outline-info btn-sm"
                        data-toggle="modal"
                        data-target="#editRuanganModal"
                        data-kode=""
                        data-gedung=""
                        data-ruang=""
                        data-nomor=""
                        data-kapasitas=""
                    >
                        <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                    </button>
                </center>
            </td>
        </tr>
    ));
}
function IsBahan(props) {
    if (props.jenis == "bahan") {
        return <span className="badge badge-info">Bahan</span>;
    } else {
        return <span className="badge badge-success">Produk</span>;
    }
}

ReactDOM.render(<Manufacturing />, document.getElementById("product-data"));
