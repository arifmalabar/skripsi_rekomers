import ReactDom from "react-dom";

function TambahBom(params) {
    return (
        <div className="row">
            <div className="col-md-12">
                <div className="form-group row">
                    <label
                        for="inputEmail3"
                        className="col-sm-2 col-form-label"
                    >
                        Produk
                    </label>
                    <div className="col-sm-10">
                        <select
                            className="form-control select2bs4"
                            style={{ width: "100%" }}
                        >
                            <option selected="selected">Sepatu Sekolah</option>
                            <option>Sepatu Kets</option>
                            <option>Sepatu Olahraga</option>
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
                        Kategori
                    </label>
                    <div className="col-sm-10">
                        <select
                            className="form-control select2bs4"
                            style={{ width: "100%" }}
                        >
                            <option selected="selected">Sepatu Sekolah</option>
                            <option>Sepatu Kets</option>
                            <option>Sepatu Olahraga</option>
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
                        Kuantitas
                    </label>
                    <div className="col-sm-8">
                        <input
                            type="number"
                            className="form-control"
                            placeholder="Masukan Kuantitas"
                        />
                    </div>
                    <div className="col-sm-2">
                        <input
                            type="text"
                            className="form-control"
                            placeholder="Satuan"
                        />
                    </div>
                </div>
            </div>
            <div className="col-md-2"></div>
            <div className="col-md-10">
                <button
                    className="btn btn-success btn-sm"
                    style={{ width: "100%" }}
                >
                    <i className="fa fa-plus"></i> Tambah Data
                </button>
            </div>
        </div>
    );
}
function Komposisi() {
    let data_komposisi = [
        {
            komponen: "tali",
            kuantitas: 1,
            harga: 45000,
        },
    ];
    let no = 1;
    return data_komposisi.map((e) => (
        <tr>
            <td>{no++}</td>
            <td>{e.komponen}</td>
            <td>{e.kuantitas}</td>
            <td>{e.harga}</td>
            <td>
                <center>
                    <button type="button" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                    </button>
                </center>
            </td>
        </tr>
    ));
}
function TambahKomposisi() {
    return (
        <div className="row">
            <div className="col-md-12">
                <div className="form-group">
                    <label>Komponen/Bahan</label>
                    <select
                        className="form-control select2bs4"
                        style={{ width: "100%" }}
                    >
                        <option>Pilih Komponen </option>
                    </select>
                </div>
            </div>
            <div className="col-md-12">
                <div className="form-group">
                    <label>Kuantitas</label>
                    <div className="row">
                        <div className="col-md-10">
                            <input
                                className="form-control"
                                placeholder="Masukan Kuantitas"
                            />
                        </div>
                        <div className="col-md-2">
                            <input
                                className="form-control"
                                placeholder="Satuan"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
ReactDom.render(<TambahBom />, document.getElementById("form-data"));
ReactDom.render(<Komposisi />, document.getElementById("form-data-komposisi"));
ReactDom.render(
    <TambahKomposisi />,
    document.getElementById("form-komponen-tambah")
);
