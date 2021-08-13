getDetailKeranjang(1)

const jmlInput = document.getElementById("jml_beli_input")
const idProduk = document.getElementById("id_produk")

const btnBeli = document.getElementById("btnBeli")

const keranjangModal = document.getElementById('keranjangModal')
keranjangModal.addEventListener('hidden.bs.modal', function (event) {
    const footerModal = document.getElementById("footerModal")
    footerModal.innerHTML = `
        <h6>
            Ingin menambahkan barang ke keranjang?
        </h6>
        <div>
            <button type="submit" class="btn btn-danger bg-red py-1 fw-bold"
                style="width:140px;">Ya</button>
            <button type="button" class="btn btn-outline-danger py-1 fw-bold ms-3"
                style="width:140px;" data-bs-dismiss="modal">
                Batal
            </button>
        </div>
    `
    // window.location.reload();

})

function toggleCount(isAdd) {

    let jmlDisplay = document.getElementById("jml_beli_display")
    let jmlInput = document.getElementById("jml_beli_input")

    let btnMinus = document.getElementById("btnMinus")
    let btnMinusSvg = document.getElementById("btnMinusSvg")

    if (isAdd) {
        jmlDisplay.innerHTML++

    } else {
        if (jmlDisplay.innerHTML > 1) {
            jmlDisplay.innerHTML--
        }
    }

    jmlInput.value = jmlDisplay.innerHTML

    if (jmlDisplay.innerHTML == 1) {
        btnMinus.classList.add("disabled")
        btnMinusSvg.classList.remove("text-danger")
    } else {
        btnMinus.classList.remove("disabled")
        btnMinusSvg.classList.add("text-danger")
    }

    getDetailKeranjang(jmlInput.value)
}

function getDetailKeranjang(jml) {
    let cartJml = document.getElementById("keranjang_jml")
    let cartJmlTerbilang = document.getElementById("keranjang_jml_terbilang")
    let cartHarga = document.getElementById("keranjang_harga")

    let harga = document.getElementById("harga_beli_input")

    cartJml.innerHTML = jml
    cartJmlTerbilang.innerHTML = angkaTerbilang(jml)
    cartHarga.innerHTML = formatRupiah(harga.value)

}

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


var formKeranjang = document.getElementById('form-beli');

formKeranjang.addEventListener('submit', function (e) {
    e.preventDefault();

    const idUser = document.getElementById("id_user")

    if (!idUser.value) {
        window.location.replace("login.php")
    }

    const harga = document.getElementById("harga_beli_input")

    const footerModal = document.getElementById("footerModal")
    // const jmlDisplay = document.getElementById("jml_beli_display")
    // const btnMinus = document.getElementById("btnMinus")
    // const btnMinusSvg = document.getElementById("btnMinusSvg")

    const keranjangData = new FormData()
    keranjangData.set("jumlah", jmlInput.value)
    keranjangData.set("harga", harga.value)
    keranjangData.set("id_produk", idProduk.value)
    keranjangData.set("id_user", idUser.value)

    fetch("./api/tambah_keranjang.php", { method: "POST", body: keranjangData })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                footerModal.innerHTML = `
                    <h5 class="fw-bold">
                        Barang berhasil ditambahkan ke <a class="text-danger text-decoration-none"
                            href="keranjang.php">Keranjang</a>!
                    </h5>
                `
                jmlInput.value = 1
                jmlDisplay.innerHTML = 1
                btnMinus.classList.add("disabled")
                btnMinusSvg.classList.remove("text-danger")
            }
        })

});

btnBeli.addEventListener("click", function () {
    window.location = `actions/beli_action.php?id_produk=${idProduk.value}&jumlah=${jmlInput.value}`
})
