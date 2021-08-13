const totalNama = document.getElementById("totalNama");
const totalHarga = document.getElementById("totalHarga");
const totalHargaSemua = document.getElementById("totalHargaSemua");

const btnBeli = document.getElementById("btnBeli");

(function () {
    const radiosKeranjang = document.getElementsByName('selectedProduk');

    radiosKeranjang.forEach(rad => {
        rad.addEventListener("change", (e) => {
            if (rad.checked) {
                console.log(rad.value)
                toggleTotalBelanja(rad.value)
            }
        })
    })

    const checkedProduk = document.querySelector('input[name="selectedProduk"]:checked')
    if (checkedProduk) {
        toggleTotalBelanja(checkedProduk.value)
    }

})();

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

function toggleTotalBelanja(idKeranjang) {
    const namaInput = document.getElementById("namaInput_" + idKeranjang);
    const hargaInput = document.getElementById("hargaInput_" + idKeranjang);
    const jumlahInput = document.getElementById("jumlahInput_" + idKeranjang);

    totalNama.innerHTML = `${namaInput.value} (${jumlahInput.value} item)`
    totalHarga.innerHTML = formatRupiah(Number(hargaInput.value) * Number(jumlahInput.value))
    totalHargaSemua.innerHTML = formatRupiah(Number(hargaInput.value) * Number(jumlahInput.value))
}

function updateJumlah(idKeranjang, flag) {
    const jml = document.getElementById("jml_beli_" + idKeranjang)

    const keranjangData = new FormData()
    keranjangData.set("id", idKeranjang)

    const btnMinus = document.getElementById("btnMinus_" + idKeranjang)
    const btnMinusSvg = document.getElementById("btnMinusSvg_" + idKeranjang)
    const jumlahInput = document.getElementById("jumlahInput_" + idKeranjang);

    switch (flag) {
        case "up":
            keranjangData.set("jumlah", Number(jml.innerHTML) + 1)
            fetch("./api/update_keranjang.php", { method: "POST", body: keranjangData })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        jml.innerHTML++
                        jumlahInput.value++
                        const checkedProduk = document.querySelector('input[name="selectedProduk"]:checked')
                        if (checkedProduk.value == idKeranjang) {
                            toggleTotalBelanja(idKeranjang)
                        }
                        toggleBtnDisable(jml.innerHTML, btnMinus, btnMinusSvg)
                    }
                })
            break;

        case "down":
            if (jml.innerHTML - 1 >= 1) {
                keranjangData.set("jumlah", Number(jml.innerHTML) - 1)
                fetch("./api/update_keranjang.php", { method: "POST", body: keranjangData })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            jml.innerHTML--
                            jumlahInput.value--
                            const checkedProduk = document.querySelector('input[name="selectedProduk"]:checked')
                            if (checkedProduk.value == idKeranjang) {
                                toggleTotalBelanja(idKeranjang)
                            }
                            toggleBtnDisable(jml.innerHTML, btnMinus, btnMinusSvg)
                        }
                    })
            }
            break;
    }
}

function toggleBtnDisable(jml, btnMinus, btnMinusSvg) {
    if (jml == 1) {
        btnMinus.classList.add("disabled")
        btnMinusSvg.classList.remove("text-danger")
    } else {
        btnMinus.classList.remove("disabled")
        btnMinusSvg.classList.add("text-danger")
    }
}

// const radiosKeranjang = document.getElementsByName('selectedProduk');

// radiosKeranjang.forEach(rad => {
//     rad.addEventListener("change", (e) => {
//         if (rad.checked) {
//             alert(rad.value);
//         }
//     })
// })

btnBeli.addEventListener("click", function () {
    const checkedProduk = document.querySelector('input[name="selectedProduk"]:checked')
    const idProduk = document.getElementById("idInput_" + checkedProduk.value)
    const jml = document.getElementById("jumlahInput_" + checkedProduk.value)
    window.location = `beli.php?id_produk=${idProduk.value}&jumlah=${jml.value}`
})
