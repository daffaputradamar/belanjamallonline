<?php
    session_start();
    include_once("config/connection.php");

    $detail_produk = $_GET['id'];

    if (!isset($detail_produk)) {
        Header("Location: home.php");
    }
    
    include_once("layout/header.php");
?>

<?php
    include_once("layout/navbar.php");
?>

<div class="container mt-4 mb-5">
    <?php
        $query_detail = "SELECT * FROM produk WHERE id = $detail_produk";
        if ($row_detail = mysqli_query($con, $query_detail)):
            while ($data_detail = mysqli_fetch_assoc($row_detail)):
    ?>
    <div class="row">
        <div class="col-5 px-5">
            <img src="assets/homepage/<?= $data_detail['gambar'] ?>" alt="gambar" class="img-fluid w-100">
        </div>
        <div class="col">
            <h2><?= $data_detail['nama'] ?>
            </h2>
            <div class="mt-3 mb-4 d-flex align-items-center">
                <img src="assets/icon-star.png" alt="star" class="me-2">
                <h5 class="text-muted mb-0 fw-normal">4.8</h5>
            </div>
            <h2 class="fw-bold mb-5">
                <?= "Rp " . number_format($data_detail['harga'], 0, ",", ".") ?>
            </h2>
            <hr>
            <form id="form-beli">
                <div class="row mt-4">
                    <div class="col">
                        <h4 class="fw-normal">Jumlah Pesan</h4>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-center align-items-center">
                            <a class="btn disabled" id="btnMinus" onclick="toggleCount(false)">
                                <svg id="btnMinusSvg" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z" />
                                </svg>
                            </a>
                            <h4 class="mb-0 mx-4" id="jml_beli_display">1</h4>
                            <a class="btn" onclick="toggleCount(true)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                                    class="bi bi-plus-circle-fill text-danger" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg>
                            </a>
                        </div>
                        <input type="hidden" name="jml_beli" id="jml_beli_input" value="1">
                        <input type="hidden" name="id_produk" id="id_produk" value="<?= $data_detail['id'] ?>">
                        <input type="hidden" name="id_user" id="id_user"
                            value="<?= (isset($_SESSION['id'])) ? $_SESSION['id'] : "" ?>">
                        <input type="hidden" name="harga_beli" id="harga_beli_input"
                            value="<?= $data_detail['harga'] ?>">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-danger bg-red" id="btnBeli">
                                <h5 class="fw-bold mb-0 py-1">Beli</h5>
                            </button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#keranjangModal">
                                <h5 class="fw-bold mb-0 py-1">Tambah Keranjang</h5>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="keranjangModal" tabindex="-1" role="dialog" aria-labelledby="keranjangModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content px-4 py-2">
                            <div class="modal-body">
                                <div class="d-flex justify-content-start">
                                    <img src="assets/homepage/<?= $data_detail['gambar'] ?>" alt="gambar"
                                        class="img-fluid" style="width: 15%;">
                                    <div class="ms-4 mt-2 w-100">
                                        <h5 class="fw-bold"><?= $data_detail['nama'] ?>
                                        </h5>
                                        <p class="fst-italic"><span id="keranjang_jml"></span> (<span
                                                id="keranjang_jml_terbilang"></span>) item x
                                            <span id="keranjang_harga"></span>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center" id="footerModal">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
    <hr class="my-5">
    <div class="row">
        <div class="col">
            <h5 class="fw-bold mb-4">Deskripsi Produk</h5>
            <div>
                <?= $data_detail['deskripsi'] ?>
            </div>
        </div>
        <div class="col-3"></div>
        <div class="col">
            <h5 class="fw-bold mb-3">Informasi Produk</h5>
            <div class="row mb-2">
                <div class="col">
                    <h6 class="text-muted">Nama Produk</h6>
                </div>
                <div class="col"><?= $data_detail['nama'] ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <h6 class="text-muted">Berat</h6>
                </div>
                <div class="col"><?= $data_detail['berat'] ?> Kg
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <h6 class="text-muted">Spesifikasi</h6>
                </div>
                <div class="col"></div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <h6 class="text-muted">Kategori</h6>
                </div>
                <div class="col"><?= $data_detail['kategori'] ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <h6 class="text-muted">Merek</h6>
                </div>
                <div class="col"><?= $data_detail['merk'] ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <h6 class="text-muted">Toko Penjual</h6>
                </div>
                <div class="col text-danger fw-bold">SerbaAda Shop</div>
            </div>
        </div>
    </div>
    <hr class="my-5">
    <div>
        <h5 class="fw-bold mb-4">Produk Serupa Lainnya</h5>
        <div class="row">
            <?php
                    $query = "SELECT * FROM produk WHERE id != $detail_produk LIMIT 10";
                    if ($row = mysqli_query($con, $query)):
                        while ($data = mysqli_fetch_assoc($row)):
                ?>
            <div class="col-2 d-flex align-items-stretch">
                <div class="card border-cstm-rounded">
                    <img src="assets/homepage/<?= $data['gambar'] ?>" class="card-img-top img-fluid border-cstm-rounded"
                        alt="...">
                    <div class="card-body me-2 d-flex flex-column justify-content-between">
                        <h6 class="card-title fs-5"><?= $data['nama'] ?>
                        </h6>
                        <h5 class="card-text mt-2 fw-bold">
                            <?= "Rp " . number_format($data['harga'], 0, ",", ".") ?>
                        </h5>
                        <div class="mt-4 d-flex align-items-center">
                            <img src="assets/icon-star.png" alt="star" style="" class="me-2">
                            <small class="text-muted">4.8</small>
                        </div>
                        <a href="detail.php?id=<?= $data['id'] ?>" class="stretched-link"></a>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <?php
                        endwhile;
                    endif;
                ?>
        </div>
    </div>
    <?php
            endwhile;
        endif;
    ?>
</div>

<script src="https://unpkg.com/@develoka/angka-terbilang-js@1.4.1/index.min.js"></script>
<script src="scripts/detailproduk.js"></script>

<?php
    include_once("layout/footer.php");