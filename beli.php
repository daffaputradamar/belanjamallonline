<?php
    session_start();
    include_once("config/connection.php");
    
    include_once("layout/header.php");

    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
    }

    $id_user = $_SESSION['id'];
    $id_produk = $_GET['id_produk'];
    $jumlah = $_GET['jumlah'];
    
    $from_keranjang = 0;
    if (isset($_GET['cart'])) {
        $from_keranjang = $_GET['cart'];
    }

    $produk;

    $result = mysqli_query($con, "SELECT * FROM produk WHERE id = $id_produk");
    if ($row = mysqli_fetch_assoc($result)) {
        $produk = $row;
    }
?>

<?php
    include_once("layout/navbar.php");
?>

<div class="container my-5">
    <h4 class="fw-bold">Pembayaran</h4>
    <input type="hidden" id="idProdukInput" value="<?= $produk['id'] ?>">
    <input type="hidden" id="jmlProdukInput" value="<?= $jumlah ?>">
    <input type="hidden" id="cart" value="<?= $from_keranjang ?>">
    <div class="row mt-3">
        <div class="col-7">
            <div class="card rounded shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0 fw-bold">Pilih Alamat Pengiriman</h5>
                        <small class="text-danger">Pilih atau Masukkan Alamat Lain</small>
                    </div>
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <div class="d-flex">
                                <small class="text-danger me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                    </svg>
                                </small>
                                <div>
                                    <p class="mb-1">Alamat Rumah</p>
                                    <p class="fw-bold mb-1"><?= $_SESSION['nama'] ?>
                                    </p>
                                    <p class="text-muted mb-1">
                                        Jl. KH. Achmad Dahlan 11 RT 01 RW 04, Kelurahan Pohjentrek, Kecamatan Purworejo
                                        Kota Pasuruan, 67119
                                    </p>
                                    <small class="fw-bold"><?= $_SESSION['no_hp'] ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card rounded shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 py-3 px-3">
                            <h5 class="mb-0 fw-bold">SerbaAda Shop</h5>
                        </div>
                        <div class="col">
                            <div class="d-flex mb-3">
                                <img src="assets/homepage/<?=$produk['gambar']?> ?>" alt="gambar" class="w-25">
                                <div class="ms-4 mt-2 w-100">
                                    <h5 class="fw-bold"><?= $produk['nama'] ?>
                                    </h5>
                                    <p class="text-muted"><?= $jumlah ?> item</p>
                                    <h5 class="fw-bold" id="totalHargaSemua">
                                        <?= "Rp. " . number_format($produk['harga'] * $jumlah, 0, ",", ".") ?>
                                    </h5>
                                    <input type="hidden" name="totalHargaSemuaInput" id="totalHargaSemuaInput"
                                        value="<?= $produk['harga'] * $jumlah ?>">
                                </div>
                            </div>
                            <small class="text-danger">Tambahkan catatan untuk penjual</small>
                            <select class="form-select mt-3" aria-label=".form-select-sm example" id="kurir">
                                <option selected hidden value="0">Pilih Pengiriman</option>

                                <option value="JNE(Reguler)_2-3 hari kerja_256000">
                                    JNE(Reguler) | 2-3 hari kerja | Rp. 256.000
                                </option>
                                <option value="AnterAja_3-4 hari kerja_216000">
                                    AnterAja | 3-4 hari kerja | Rp. 216.000
                                </option>
                                <option value="JNT_1 hari kerja_456000">
                                    JNT | 1 hari kerja | Rp. 456.000
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card rounded shadow-sm mb-4 pb-5">
                <div class="card-body">
                    <h5 class="mb-4 fw-bold">Pilih Metode Pembayaran</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodePembayaranInput"
                            id="metodePembayaranInput" value="bri" id="metodePembayaranInput">
                        <label class="form-check-label" for="metodePembayaranInput">
                            <img src="assets/checkout/logo_bri.png" alt="logobri" class="mx-2"> <span
                                class="fw-bold">Transfer Bank
                                BRI</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-1"></div>
        <div class="col">
            <div class="card border-cstm-rounded shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Total Pembayaran</h5>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="text-muted" id="totalNama">
                            Total Harga (<?= $jumlah ?> Item)
                        </h6>
                        <h6 class="text-muted" id="totalHarga">
                            <?= "Rp. " . number_format($produk['harga'] * $jumlah, 0, ",", ".") ?>
                        </h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2 d-none" id="ongkosKirimRow">
                        <h6 class="text-muted" id="totalNama">
                            Total Ongkos Kirim
                        </h6>
                        <h6 class="text-muted" id="ongkosKirimRowHarga">
                            Rp.256.000
                        </h6>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold">Total Harga</h5>
                        <h5 class="fw-bold" id="totalPembayaranSemua">
                            <?= "Rp. " . number_format($produk['harga'] * $jumlah, 0, ",", ".") ?>
                        </h5>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-danger bg-red rounded" id="btnBayar">
                            <h5 class="fw-bold mb-0 py-1">Bayar</h5>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast-container">
            <div id="liveToastKurir" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Peringatan</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Kurir harus dipilih
                </div>
            </div>
            <div id="liveToastPembayaran" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Peringatan</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Metode pembayaran harus dipilih
                </div>
            </div>
        </div>
    </div>
</div>

<script src="scripts/beli.js"></script>
<?php
    include_once("layout/footer.php");