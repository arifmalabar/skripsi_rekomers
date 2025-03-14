import { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import Swal from "sweetalert2";
function UpdateProduk() {
    let [preview, setPreview] = useState(null);
    let [produk, setProduk] = useState({
        category_id: "",
        nama_produk: "",
        harga_modal: "",
        harga_jual: "",
        internal_reference: "",
    });
    let [kategori, setKategori] = useState([]);
    let [detailProduk, setDetailProduk] = useState([]);

    const inputProdukHander = (index, value) => {
        setProduk({ ...produk, [index]: value });
    };

    const getKategori = async () => {
        try {
            let response = await axios.get("/get_kategori");
            if (response.status == 200) {
                const dt = await response.data;
                setKategori(dt);
            } else {
                const err = await response.data;
                throw new Error(`Error : ${err.message}`);
            }
        } catch (error) {
            console.log(error);
        }
    };
    const getProduk = async () => {
        const name = window.location.pathname.split("/");
        const id = name[3];
        try {
            const response = await axios.get(`/produk/show/${id}`);
            if (response.status == 200) {
                const detail_produk = await response.data;
                setProduk(detail_produk.data);
            } else {
                const err = await response.data;
                throw new Error(err.message);
            }
        } catch (error) {
            Swal.fire({ title: "Erorr", text: error, icon: "error" });
        }
    };
    useEffect(() => {
        getKategori();
        getProduk();
    }, []);
    async function postDataProduk() {
        try {
            const response = await axios.post("/produk/tambah_data", produk, {
                headers: {
                    "X-CSRF-TOKEN": window.csrf_token,
                },
            });
            if (response.status == 200 && response.data.status == "success") {
                Swal.fire({
                    title: "Berhasil",
                    text: "Data yang diinputkan berhasil ditambah",
                    icon: "success",
                }).then((e) => {
                    if (e.isConfirmed) {
                        document.location = "/produk";
                    }
                });
            } else {
                Swal.fire({
                    title: "Gagal menambah data",
                    text: response.data.message,
                    icon: "error",
                });
            }
        } catch (error) {
            console.log(error);
        }
    }
    return (
        <div className="row">
            <div className="col-md-9">
                <div className="col-md-12">
                    <div className="form-group row">
                        <label
                            for="inputEmail3"
                            className="col-sm-2 col-form-label"
                        >
                            Nama
                        </label>
                        <div className="col-sm-10">
                            <input
                                type="text"
                                className="form-control"
                                id="inputEmail3"
                                placeholder="Masukan Nama Produk/Bahan"
                                value={produk.nama_produk}
                                onChange={(e) => {
                                    inputProdukHander(
                                        "nama_produk",
                                        e.target.value
                                    );
                                    /*if (type == 0) {
                                        inputProdukHander(
                                            "nama_produk",
                                            e.target.value
                                        );
                                    } else {
                                        inputBahanHander(
                                            "nama_produk",
                                            e.target.value
                                        );
                                    }*/
                                }}
                            />
                        </div>
                    </div>
                </div>

                <div className="col-md-12">
                    <div className="form-group row">
                        <label
                            for="inputEmail3"
                            className="col-sm-2 col-form-label"
                        >
                            Harga Modal
                        </label>
                        <div className="col-sm-10">
                            <input
                                type="number"
                                className="form-control"
                                id="inputEmail3"
                                placeholder="Masukan Harga Modal"
                                value={produk.harga_modal}
                                onChange={(e) => {
                                    /*if (type == 0) {
                                        inputProdukHander(
                                            "harga_modal",
                                            e.target.value
                                        );
                                    } else {
                                        inputBahanHander(
                                            "harga_modal",
                                            e.target.value
                                        );
                                    }*/
                                    inputProdukHander(
                                        "harga_modal",
                                        e.target.value
                                    );
                                }}
                            />
                        </div>
                    </div>
                </div>
                <div className="col-md-12">
                    <div className="form-group row">
                        <label
                            for="inputEmail3"
                            className="col-sm-2 col-form-label"
                        >
                            Kategori
                        </label>
                        <div className="col-sm-10">
                            <select
                                className="form-control"
                                onChange={(e) => {
                                    inputProdukHander(
                                        "category_id",
                                        e.target.value
                                    );
                                }}
                            >
                                <option>Pilih Kategori</option>
                                {kategori.map((e) => (
                                    <option value={e.category_id}>
                                        {e.nama_kategori}
                                    </option>
                                ))}
                            </select>
                        </div>
                    </div>
                </div>

                <div className="col-md-12">
                    <div className="form-group row">
                        <label
                            for="inputEmail3"
                            className="col-sm-2 col-form-label"
                        >
                            Harga Jual
                        </label>
                        <div className="col-sm-10">
                            <input
                                type="number"
                                className="form-control"
                                id="inputEmail3"
                                placeholder="Harga Jual"
                                value={produk.harga_jual}
                                onChange={(e) => {
                                    inputProdukHander(
                                        "harga_jual",
                                        e.target.value
                                    );
                                }}
                            />
                        </div>
                    </div>
                </div>
                <div className="col-md-12">
                    <div className="form-group row">
                        <label
                            for="inputEmail3"
                            className="col-sm-2 col-form-label"
                        >
                            Internal Reference
                        </label>
                        <div className="col-sm-10">
                            <input
                                type="email"
                                className="form-control"
                                id="inputEmail3"
                                placeholder="Internal Refrence"
                                value={produk.internal_reference}
                                onChange={(e) => {
                                    inputProdukHander(
                                        "internal_reference",
                                        e.target.value
                                    );
                                }}
                            />
                        </div>
                    </div>
                </div>

                <div className="col-md-12">
                    <div className="form-group row">
                        <label
                            for="inputEmail3"
                            className="col-sm-2 col-form-label"
                        ></label>
                    </div>
                </div>
            </div>

            <div className="col-md-3">
                <div className="col-md-12">
                    {preview && (
                        <img
                            height={200}
                            width={200}
                            src={preview}
                            alt=""
                        ></img>
                    )}
                </div>
                <div className="col-md-12">
                    <input
                        type="file"
                        placeholder="Upload File Disini"
                        className="form-control"
                        onChange={(e) => {
                            const file = e.target.files[0];
                            if (file) {
                                const prevURL = URL.createObjectURL(file);
                                setPreview(prevURL);
                            }
                        }}
                    />
                </div>
            </div>
            <div className="col-md-12">
                <button
                    className="btn btn-success w-100"
                    onClick={(e) => {
                        postDataProduk();
                    }}
                >
                    <i className="fa fa-plus"></i>
                    Tambah Data
                </button>
            </div>
        </div>
    );
}
ReactDOM.render(<UpdateProduk />, document.getElementById("form-produk"));
