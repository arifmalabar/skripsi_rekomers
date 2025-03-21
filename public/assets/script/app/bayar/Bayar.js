import {
  bayar_tagihan,
  data_pembayaran,
  host,
  halaman_update_penghuni,
  path,
  get_tahuntagihan,
  get_blntagihan,
  get_pembayaran_tagihan,
} from "../config/EndPoint.js";
import getRupiah from "../helper/NumberFormat.js";
import {
  parseIntToRupiah,
  parseRupiahToInt,
} from "../helper/RupiahFormFormat.js";
import { errorMsg, successMsg } from "../message/Message.js";

let view_nik = document.querySelector(".view-nik");
let view_ktp = document.querySelector(".view-ktp");
let view_nama = document.querySelector(".view-nama");
let view_gedung = document.querySelector(".view-gedung");
let view_ruang = document.querySelector(".view-ruang");
let view_tagihan = document.querySelector(".view-tagihan");
let view_inputbukti = document.querySelector(".input-bukti");
let view_loading = document.querySelector(".preloader");

const field_tahun = document.querySelector(".field-tahun");
const field_bulan = document.querySelector(".field-bulan");
const field_total = document.querySelector(".field-total");
const field_bukti = document.querySelector(".field-bukti");
const jt_tunai = document.querySelector("#tunai");
const jt_transfer = document.querySelector("#transfer");
const csrf = document.querySelector(".csrf");
let btn_proses = document.querySelector(".btn-proses");
let btn_edit = document.querySelector(".btn-edit");

let is_tranfer = false;
let tgl_bergabung = "";
let nik = 0;
let kode_bayar = "";

export function initData() {
  btn_proses.addEventListener("click", function (params) {
    bayarTagihan();
  });
  /*jt_transfer.addEventListener("click", function (params) {
    is_tranfer = true;
    showUploadBukti();
  });
  jt_tunai.addEventListener("click", function (params) {
    is_tranfer = false;
    showUploadBukti();
  });*/
  $(".field-tahun").on("change", function (params) {
    getBulan();
  });
  $(document).on("click", ".btn-pilihtagihan", function (params) {
    getDataBayarTagihan(params);
  });
  btn_edit.href = `${halaman_update_penghuni}/${path[2]}`;
  $(".field-tagihan-modal").on("keyup", function (params) {
    this.value = parseIntToRupiah(this.value);
  });
}

export async function fecthDataPembayaran() {
  await fetch(data_pembayaran)
    .then((response) => {
      return response.json();
    })
    .then((response) => {
      if (response != 0) {
        setData(response.penghuni_detail);
        setTabel(response.list_pembayaran);
        //setTahun();
      } else {
        errorMsg("Error", "NIK Tidak terdaftar di sistem").then((res) => {
          if (res.isConfirmed) {
            window.location.href = `${host}/pembayaran`;
          }
        });
      }
    })
    .catch((err) => {
      console.log(err);
    });
}
async function getDataBayarTagihan(params) {
  const button = $(params.target); // The button that was clicked
  const id = button.data("id"); // Get data-id attribute from button
  kode_bayar = id;
  try {
    let response = await fetch(`${get_pembayaran_tagihan}/${id}`);
    let data = await response.json();
    $(".field-tahun-modal").val(data.tahun);
    $(".field-bulan-modal").val(data.bulan);
  } catch (error) {
    alert(error);
  }
}
export async function getTahun() {
  try {
    let response = await fetch(get_tahuntagihan);
    let data = await response.json();
    let opttahun = `<option value="">Pilih Tahun</option>`;
    data.forEach((element) => {
      opttahun += `<option value="${element.tahun}">${element.tahun}</option>`;
    });
    $(".field-tahun").html(opttahun);
  } catch (error) {
    console.log(error);
  }
}
export async function getBulan() {
  try {
    const tahun = field_tahun.value;
    let response = await fetch(`${get_blntagihan}/${tahun}`);
    let data = await response.json();
    let optbln = `<option value="">Pilih Tahun</option>`;
    data.forEach((element) => {
      optbln += `<option value="${element.bulan}">${element.nmbulan}</option>`;
    });
    $(".field-bulan").html(optbln);
  } catch (error) {
    errorMsg("error", error);
  }
}
async function bayarTagihan() {
  let tahun = $(".field-tahun-modal").val();
  let bulan = $(".field-bulan-modal").val();
  let tagihan = $(".field-tagihan-modal").val();
  let token = $(".csrf_modal").val();

  let data = {
    kode_bayar: kode_bayar,
    tahun: tahun,
    bulan: bulan,
    tagihan: parseRupiahToInt(tagihan),
    token: token,
  };
  try {
    let response = await fetch(bayar_tagihan, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": token,
      },
      body: JSON.stringify(data),
    });
    let dt = await response.json();
    successMsg("Berhasil", "Transaksi Berhasil");
    fecthDataPembayaran();
  } catch (error) {
    errorMsg("Error Client", error);
  }
}
/*async function bayarTagihan() {
  let tahun = field_tahun.value;
  let bulan = field_bulan.value;
  let total = field_total.value;
  let date = new Date(tgl_bergabung);
  let tanggal = `${tahun}-${bulan}-${date.getDate()}`;
  let data = {};

  data = {
    NIK: nik,
    jml_bayar: total,
    metode_bayar: is_tranfer ? "transfer" : "tunai",
    tanggal_tagihan: tanggal,
    //bukti : bt,
  };
  if (total.length != 0) {
    await fetch(bayar_tagihan, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": csrf.value,
      },
      body: JSON.stringify(data),
    })
      .then((result) => {
        return result.json();
      })
      .then((data) => {
        if (data.status == "failed") {
          errorMsg("Transaksi Gagal", data.msg);
        } else if (data.status == "success") {
          successMsg("Transaksi Sukses", data.msg);
          fecthDataPembayaran();
        } else {
          errorMsg("Transaksi Gagal", data.Error.errorInfo[2]);
        }
      })
      .catch((err) => {
        errorMsg(err);
        //console.log(err)
      });
  } else {
    errorMsg("Error", "Total transaksi belum diisi");
  }
}
/*function setTahun() {
  let bulan = [
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
  let date = new Date(tgl_bergabung);
  let date_now = new Date().getUTCFullYear();
  let opt = ``;
  var i = date.getFullYear();
  while (i <= date_now) {
    opt = opt + `<option value="${i}">${i}</option>`;
    i++;
  }
  field_tahun.innerHTML = opt;
}*/
function showUploadBukti() {
  if (is_tranfer) {
    view_inputbukti.style.display = "block";
  } else {
    view_inputbukti.style.display = "none";
  }
}
function setData(data) {
  view_nik.innerHTML = data.NIK;
  view_nama.innerHTML = data.nama;
  view_gedung.innerHTML = data.gedung;
  view_ruang.innerHTML = data.ruangan;
  view_tagihan.innerHTML = `<b>${getRupiah(data.harga)}</b>`;
  tgl_bergabung = data.tanggal_bergabung;
  nik = data.NIK;
}
function setTabel(dt) {
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
        data: null,
        render: function (data, type, row) {
          return getRupiah(row.jml_bayar);
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return getRupiah(row.sisa_bayar);
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return waktuBayar(row.tanggal);
        },
      },
      {
        data: "tanggal_tagihan",
      },
      {
        data: null,
        render: function (data, type, row) {
          return statusBayar(row.status);
        },
        orderable: false,
        searchable: false,
      },
      {
        data: null,
        render: function (data, type, row) {
          return tombolCetak(row);
        },
        orderable: false,
        searchable: false,
      },
    ],
  });
}
function waktuBayar(tgl) {
  let list_hari = [
    "Minggu",
    "Senin",
    "Selasa",
    "Rabu",
    "Kamis",
    "Jumat",
    "Sabtu",
  ];
  let list_bulan = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "Mei",
    "Jun",
    "Jul",
    "Agt",
    "Sep",
    "Okt",
    "Nop",
    "Des",
  ];
  let date = new Date(tgl);
  let hari = list_hari[date.getDay()];
  let bulan = list_bulan[date.getMonth()];
  let tahun = date.getFullYear();
  return `${hari}, ${date.getDate()} ${bulan} ${tahun}`;
}
function statusBayar(sts) {
  let rd = "";
  switch (sts) {
    case "lunas":
      rd = '<center><span class="badge badge-success">Lunas</span></center>';
      break;
    case "terhutang":
      rd = `<center><span class="badge badge-danger">Terhutang</span></center>`;
      break;
    default:
      rd = `<center><span class="badge badge-danger">Terhutang</span></center>`;
      break;
  }
  return rd;
}
function tombolCetak(sts) {
  let rd = "";
  switch (sts.status) {
    case "lunas":
      rd =
        '<center><a href="" class="btn btn-primary btn-sm"><i class="fa fa-print"></i>&nbsp;Cetak Struk</a></center>';
      break;
    case "terhutang":
      rd = `<center><a href="#" data-toggle="modal" data-target="#modal-lg" class="btn btn-success btn-sm btn-pilihtagihan" data-id="${sts.kode_bayar}"><i class="fas fa-dollar-sign"></i>&nbsp;Bayar Tagihan</a></center>`;
      break;
    default:
      rd = ``;
      break;
  }
  return rd;
}
