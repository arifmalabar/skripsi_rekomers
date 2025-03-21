import {
  get_gedung,
  get_tagihan,
  sorting_tagihan,
  tambah_tagihan,
} from "../config/EndPoint.js";
import { fecthDataSorting } from "../helper/ModalSorting.js";
import getRupiah from "../helper/NumberFormat.js";
import { errorMsg, successMsg } from "../message/Message.js";
var bulan = [
  "Januari",
  "Februari",
  "Maret",
  "April",
  "Mei",
  "Juni",
  "Juli",
  "Agustus",
  "September",
  "Oktober",
  "Nopember",
  "Desember",
];
let all_data = [];
const submit = document.querySelector(".btn-sorting");
export function init() {
  $("#field-tahun").val(new Date().getFullYear());
  $(".btn-buattagihan").on("click", function (params) {
    buatTagihan();
  });
  $("#sort-gedung").on("change", function (params) {
    sortByGedung();
  });
  showBulan();

  submit.addEventListener("click", function () {
    exportTagihan();
  });
}
export async function fecth_tagihan() {
  await fetch(get_tagihan)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      showTables(data);
      all_data = data;
    })
    .catch((err) => {
      console.log(err);
    });
}
export async function getGedung() {
  try {
    let response = await fetch(get_gedung);
    let data = await response.json();
    let gedung_opt = `<option value="">Pilih Gedung</option>`;
    data.forEach((e) => {
      gedung_opt =
        gedung_opt +
        `<option value="${e.kode_gedung}">${e.nama_gedung}</option>`;
    });
    $("#field-gedung").html(gedung_opt);
  } catch (error) {
    errorMsg("Error", error);
  }
}
function sortByGedung() {
  const kd_gedung = $("#sort-gedung").val();
  if (kd_gedung != 0) {
    const filteredData = all_data.filter(
      (item) => item.kode_gedung === kd_gedung
    );
    showTables(filteredData);
  } else {
    fecth_tagihan();
  }
}
function showBulan() {
  let opt_bulan = `<option value="">Pilih Bulan</option>`;
  let valbln = 1;
  bulan.forEach((e) => {
    opt_bulan = opt_bulan + `<option value="${valbln}">${e}</option>`;
    valbln++;
  });
  $("#field-bulan").html(opt_bulan);
}
function showTables(dt) {
  var no = 1;
  $("#example2").DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
    bDestroy: true,
    data: dt,
    columns: [
      {
        data: null,
        render: function (data, type, row) {
          return no++;
        },
      },
      {
        data: "nama",
      },
      {
        data: "nama_gedung",
      },
      {
        data: "nama_ruang",
      },
      {
        data: null,
        render: function (data, type, row) {
          return getTglTagihan(row);
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return getJmlTagihan(row);
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          if (row.total != 0) {
            return `<span class="badge badge-danger">Terhutang</span>`;
          } else {
            return `<span class="badge badge-success">Lunas</span>`;
          }
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          if (row.total != 0) {
            return showButtonAksi(row);
          } else {
            return `<i style='font-size: 12px'>Pembayaran Sdh Lunas</i>`;
          }
        },
      },
    ],
  });
}
function covertIntNum(num) {
  return `+62${num.slice(1)}`;
}
function showButtonAksi(dt) {
  return `<center>
            <a href="/bayar/${dt.NIK}" class="btn btn-outline-info btn-sm"><i
                    class="fas fa-dollar-sign"></i>&nbsp;Bayar</a>
            <a target="_blank" href="https://wa.me/${covertIntNum(
              dt.no_telp
            )}?text=*Pembayaran Kost A.N ${
    dt.nama
  }* total tagihan ${getJmlTagihan(dt)} dengan tanggal tagihan ${getTglTagihan(
    dt
  )} Segera lunasi pembayaran"
                class="btn btn-sm btn-outline-success"><i class="fa fa-phone"></i>
                Hubungi</a>
        </center>`;
}
function getJmlTagihan(row) {
  try {
    if (row.tagihan === null) {
      return getRupiah(row.harga);
    } else {
      return getRupiah(row.tagihan);
    }
  } catch (error) {
    return error;
  }
}
function getTglTagihan(row) {
  let tgl = new Date(row.tanggal_tagihan);
  return `${tgl.getDate()} ${
    bulan[tgl.getMonth()]
  } ${new Date().getFullYear()}`;
}
async function buatTagihan() {
  let data_tagihan = {
    tahun: $("#field-tahun").val(),
    bulan: $("#field-bulan").val(),
    gedung: $("#field-gedung").val(),
  };
  try {
    let response = await fetch(tambah_tagihan, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": $("#csrf").val(),
      },
      body: JSON.stringify(data_tagihan),
    });
    if (response.ok) {
      let data = await response.json();
      console.log(data);
      fecth_tagihan();
      successMsg(
        "Berhasil",
        `Tambah tagihan bulan ${data_tagihan.bulan} tahun ${data_tagihan.tahun} berhasil, lakukan sorting`
      );
    } else {
      throw new Error(response.statusText);
    }
  } catch (error) {
    errorMsg("Terjadi Kesalahan", error);
  }
}
async function exportTagihan() {
  const response = await fecthDataSorting(sorting_tagihan);
  if (!response.iserror) {
    showTables(response);
    all_data = response;
  } else {
    errorMsg("Error", response.msg);
  }
}
