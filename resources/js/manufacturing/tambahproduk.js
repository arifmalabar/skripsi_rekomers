import { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import { postproduk } from "../config/endpoint";
function TambahProduk() {
    let [type, setType] = useState(0);
    let [preview, setPreview] = useState(null);
    let [primaryData, setPrimaryData] = useState({
        nama_produk: "",
        harga_modal: "",
    });
    let [produk, setProduk] = useState({
        /*nama_produk: "",
        harga_modal: "",*/
        kategori: "",
        jumlah: "",
        harga_jual: "",
        internal_reference: "",
    });
    let [bahan, setBahan] = useState({
        /*nama_produk: "",
        harga_modal: "",*/
        kuantitas: "",
        jenis_bahan: "",
    });
    const inputPrimaryData = (index, value) => {
        setPrimaryData({ ...primaryData, [index]: value });
    };
    const inputProdukHander = (index, value) => {
        setProduk({ ...produk, [index]: value });
    };
    const inputBahanHander = (index, value) => {
        setBahan({ ...bahan, [index]: value });
    };
    async function postDataProduk() {
        try {
            const response = await axios.post(
                "/manufacturing/tambah_data",
                produk,
                {
                    headers: {
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                }
            );
            console.log(response.data);
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
                                onChange={(e) => {
                                    inputPrimaryData(
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
                                    inputPrimaryData(
                                        "harga_modal",
                                        e.target.value
                                    );
                                }}
                            />
                        </div>
                    </div>
                </div>
                {type == 0 ? (
                    <div>
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
                                        onSelect={(e) => {
                                            inputProdukHander(
                                                "kategori",
                                                e.target.value
                                            );
                                        }}
                                    >
                                        <option>Pilih Kategori</option>
                                        <option>---</option>
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
                                    Jumlah
                                </label>
                                <div className="col-sm-10">
                                    <input
                                        type="number"
                                        className="form-control"
                                        id="inputEmail3"
                                        placeholder="Masukan Jumlah"
                                        onChange={(e) => {
                                            inputProdukHander(
                                                "jumlah",
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
                                    Harga Jual
                                </label>
                                <div className="col-sm-10">
                                    <input
                                        type="number"
                                        className="form-control"
                                        id="inputEmail3"
                                        placeholder="Harga Jual"
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
                                        placeholder="Email"
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
                    </div>
                ) : (
                    <div>
                        <div className="col-md-12">
                            <div className="form-group row">
                                <label
                                    for="inputEmail3"
                                    className="col-sm-2 col-form-label"
                                >
                                    Kuantitas
                                </label>
                                <div className="col-sm-10">
                                    <input
                                        type="number"
                                        className="form-control"
                                        id="inputEmail3"
                                        placeholder="Masukan kuantias"
                                        onChange={(e) => {
                                            inputBahanHander(
                                                "kuantitas",
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
                                    Jenis Bahan
                                </label>
                                <div className="col-sm-10">
                                    <select
                                        className="form-control"
                                        onChange={(e) => {
                                            inputBahanHander(
                                                "jenis_bahan",
                                                e.target.value
                                            );
                                        }}
                                    >
                                        <option>Pilih bahan</option>
                                        <option value={1}>Katun</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                )}

                <div className="col-md-12">
                    <div className="form-group row">
                        <label
                            for="inputEmail3"
                            className="col-sm-2 col-form-label"
                        ></label>
                        <div className="col-sm-10">
                            <input
                                type="radio"
                                id="produk"
                                name="type"
                                value={"produk"}
                                onClick={(e) => {
                                    setType(0);
                                    setProduk({ ...produk, ...primaryData });
                                }}
                            />{" "}
                            <label for="produk"> Produk</label>
                            <br />
                            <input
                                type="radio"
                                id="bahan"
                                name="type"
                                value={"bahan"}
                                onClick={(e) => {
                                    setType(1);
                                    setBahan({ ...bahan, ...primaryData });
                                }}
                            />{" "}
                            <label for="bahan"> Bahan</label>
                        </div>
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
                        if (type == 0) {
                            postDataProduk();
                        } else {
                            console.log(bahan);
                            console.log(window.csrf_token);
                        }
                    }}
                >
                    <i className="fa fa-plus"></i>
                    Tambah Data
                </button>
            </div>
        </div>
    );
}

ReactDOM.render(<TambahProduk />, document.getElementById("form-produk"));
