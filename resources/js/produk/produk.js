import { React, useEffect, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import { getproduk } from "../config/endpoint";
import Swal from "sweetalert2";
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

function Produk() {
    const [produkData, setProdukData] = useState([
        {
            nama: "sampo",
            harga: 45000,
            stok: 4,
            status: "bahan",
        },
    ]);
    const deleteProduct = async (prod_id) => {
        try {
            const response = await axios.delete(
                `/produk/hapus_data/${prod_id}`,
                {
                    headers: {
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                }
            );
            console.log(response.data);
            if (response.status == 200) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Berhasil menghapus data",
                    icon: "success",
                }).then((e) => {
                    if (e.isConfirmed) {
                        window.location = "/produk";
                    }
                });
            } else {
                const err = await response.data;
                Swal.fire({
                    title: "Berhasil",
                    text: err.message,
                    icon: "success",
                }).then((e) => {
                    if (e.isConfirmed) {
                        window.location = "/produk";
                    }
                });
            }
        } catch (error) {
            Swal.fire({ title: "Berhasil", text: error, icon: "success" });
        }
    };
    useEffect(() => {
        const getProduct = async () => {
            try {
                let response = await axios.get("/produk/get_produk");
                if (response.status == 200) {
                    let dt = await response.data;
                    setProdukData(dt.data);
                } else {
                    const errdata = await response.json();
                    throw new Error(`Error : ${errdata.message}`);
                }
            } catch (error) {
                console.log(error);
            }
        };
        getProduct();

        console.log("oke");
    }, []);
    let no = 1;
    return produkData.map((e) => (
        <tr>
            <td>{no++}</td>
            <td>{e.nama_produk}</td>
            <td>{e.harga_jual}</td>
            <td>
                <center>
                    <button
                        class="btn btn-outline-info btn-sm"
                        onClick={(i) => {
                            window.location = `/produk/update_produk/${e.id}`;
                        }}
                    >
                        <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
                    </button>
                    &nbsp;
                    <button
                        type="button"
                        class="btn btn-outline-danger btn-sm"
                        onClick={(d) => {
                            Swal.fire({
                                title: "Konfirmasi Hapus",
                                text: "apakah anda ingin menghapus data",
                                icon: "question",
                                showCancelButton: true,
                                showConfirmButton: true,
                            }).then((i) => {
                                if (i.isConfirmed) {
                                    deleteProduct(e.id);
                                } else {
                                    Swal.fire({
                                        title: "Gagal",
                                        text: "anda menggagalkan proses hapus data",
                                        icon: "error",
                                    });
                                }
                            });
                        }}
                    >
                        <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                    </button>
                </center>
            </td>
        </tr>
    ));
}
ReactDOM.render(<Produk />, document.getElementById("product-data"));
