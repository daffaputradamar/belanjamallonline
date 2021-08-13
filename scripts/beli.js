const kurirInput = document.getElementById("kurir");
const ongkosKirimRow = document.getElementById("ongkosKirimRow")
const ongkosKirimRowHarga = document.getElementById("ongkosKirimRowHarga")
const totalPembayaranSemua = document.getElementById("totalPembayaranSemua")

const btnBayar = document.getElementById("btnBayar")

const totalHargaSemuaInput = document.getElementById("totalHargaSemuaInput")
const idProdukInput = document.getElementById("idProdukInput")
let jmlProdukInput = document.getElementById("jmlProdukInput")
let totalBayarInput = 0;
let produkOngkos = Number(totalHargaSemuaInput.value);

kurirInput.addEventListener("change", function (e) {
    const kurirData = e.target.value.split("_")

    ongkosKirimRow.classList.remove("d-none")
    ongkosKirimRowHarga.innerHTML = formatRupiah(kurirData[2])

    totalPembayaranSemua.innerHTML = formatRupiah(Number(totalHargaSemuaInput.value) + Number(kurirData[2]))

    totalBayarInput = Number(totalHargaSemuaInput.value) + Number(kurirData[2])
})

btnBayar.addEventListener("click", function (e) {

    let jenisPembayaran = null
    const metodePembayaranInput = document.querySelector('input[name="metodePembayaranInput"]:checked');

    if (metodePembayaranInput) {
        jenisPembayaran = metodePembayaranInput.value
    }

    if (kurirInput.value == "0") {
        let toastLiveKurir = document.getElementById('liveToastKurir')
        let toastKurir = new bootstrap.Toast(toastLiveKurir)
        toastKurir.show()
    }

    if (!jenisPembayaran) {
        let toastLivePembayaran = document.getElementById('liveToastPembayaran')
        let toastPembayaran = new bootstrap.Toast(toastLivePembayaran)
        toastPembayaran.show()
    }

    if (kurirInput.value == "0" || !jenisPembayaran) {
        return;
    }

    const kurirData = kurirInput.value.split("_")

    const data = {
        id_produk: idProdukInput.value,
        total_bayar: totalBayarInput,
        produk_ongkos: produkOngkos,
        status: 1,
        tgl_pembelian: new Date(),
        kurir: `${kurirData[0]}_${kurirData[1]}`,
        kurir_ongkos: kurirData[2],
        jenis_pembayaran: jenisPembayaran,
        jumlah_produk: jmlProdukInput.value
    }

    const formData = new FormData();
    Object.keys(data).forEach(key => {
        formData.append(key, data[key])
    })

    fetch("./api/transaksi_action.php", { method: "POST", body: formData })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location = "home.php?home_berhasil=1"
            }
        })
})

function formatRupiah(angka) {
    var number_string = angka.toString(),
        sisa = number_string.length % 3,
        rupiah = number_string.substr(0, sisa),
        ribuan = number_string.substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    return "Rp " + rupiah;
}