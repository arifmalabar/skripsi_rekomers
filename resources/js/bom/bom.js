import ReactDOM from "react-dom";
import Swal from "sweetalert2";
const bom_data = [
    {
        kode_bom: "b001",
        produk: "Sepatu Sekolah",
        reference: "SS",
        total_komponen: 6,
    },
];
function Bom() {
    let no = 1;
    return (
        <div className="row">
            <div className="col-md-12">
                <table
                    id="example2"
                    className="table table-bordered table-hover"
                    style={{ textAlign: "center" }}
                >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Reference</th>
                            <th>Total Komponen</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {bom_data.map((e) => (
                            <tr>
                                <td>{no++}</td>
                                <td>{e.produk}</td>
                                <td>{e.reference}</td>
                                <td>{e.total_komponen}</td>
                                <td>
                                    <a
                                        href={`/bill_material/edit/${e.kode_bom}`}
                                        className="btn btn-sm btn-outline-info"
                                    >
                                        <i className="fa fa-edit"></i> Update
                                    </a>
                                    &nbsp;
                                    <a
                                        href="/bill_material/hapus/"
                                        className="btn btn-sm btn-outline-danger btn-hapus"
                                        onClick={(e) => {
                                            e.preventDefault();
                                            Swal.fire({
                                                title: "Konfirmasi Hapus",
                                                text: "Apakah anda ingin menghapus data?",
                                                icon: "question",
                                                showConfirmButton: true,
                                                showDenyButton: true,
                                                denyButtonText: "Batal",
                                                confirmButtonText: "Ya, Hapus",
                                            }).then((res) => {
                                                if (res.isConfirmed) {
                                                    const btn =
                                                        document.querySelector(
                                                            ".btn-hapus"
                                                        );
                                                    window.location.href =
                                                        btn.href;
                                                } else {
                                                    Swal.fire({
                                                        title: "Batal",
                                                        text: "Anda membatalkan hapus data",
                                                        icon: "error",
                                                    });
                                                }
                                            });
                                        }}
                                    >
                                        <i className="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
}
ReactDOM.render(<Bom />, document.getElementById("bom-data"));
