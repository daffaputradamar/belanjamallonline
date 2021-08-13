<?php
    session_start();
    include_once("config/connection.php");
    
    include_once("layout/header.php");

    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
    }

    $id_user = $_SESSION['id'];
?>

<?php
    include_once("layout/navbar.php");
?>

<div class="container my-5">
    <h4 class="fw-bold">Keranjang</h4>
    <div class="row mt-3">
        <div class="col-7">
            <a href="actions/hapus_keranjang_action.php" class="text-decoration-none">
                <h6 class="fw-bold text-danger text-end">Hapus Semua</h6>
            </a>
            <hr>
            <?php
                $result = mysqli_query($con, "SELECT k.id AS id_keranjang, k.jumlah, p.* FROM keranjang k JOIN produk p ON k.id_produk = p.id WHERE id_user = $id_user");
                
                if (mysqli_num_rows($result) == 0) :
            ?>
            <h5 class="fw-bold">Keranjang Kosong</h5>
            <?php
                else:
                    $index_produk = 0;
                    while ($row = mysqli_fetch_assoc($result)):
            ?>
            <div class="d-flex align-items-center justify-content-between mt-4 mb-5">
                <div class="d-flex align-items-center">
                    <input class="form-check-input me-4" type="radio" name="selectedProduk"
                        <?= ($index_produk == 0) ? "checked" : "" ?> value="<?= $row['id_keranjang'] ?>">
                    <img src="assets/homepage/<?= $row['gambar'] ?>" alt="gambar" class="img-fluid" width="150">
                    <div class="ms-4">
                        <h5><?= $row['nama'] ?>
                        </h5>
                        <h4 class="card-text fw-bold mt-4 mb-5">
                            <?= "Rp " . number_format($row['harga'], 0, ",", ".") ?>
                        </h4>
                        <a href="actions/hapus_keranjang_action.php?id=<?= $row['id_keranjang'] ?>"
                            class="text-decoration-none"><small type="button" class="text-danger">Hapus Item</small></a>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    <a class="btn <?= ($row['jumlah'] == 1) ? "disabled" : "" ?>"
                        id="btnMinus_<?=$row['id_keranjang']?>"
                        onclick="updateJumlah(<?=$row['id_keranjang']?>, 'down')">
                        <svg id="btnMinusSvg_<?=$row['id_keranjang']?>" xmlns="http://www.w3.org/2000/svg" width="28"
                            height="28" fill="currentColor"
                            class="bi bi-dash-circle-fill <?= ($row['jumlah'] > 1) ? "text-danger" : "" ?>"
                            viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z" />
                        </svg>
                    </a>
                    <h4 class="mb-0 mx-4" id="jml_beli_<?=$row['id_keranjang']?>">
                        <?= $row['jumlah'] ?>
                    </h4>
                    <a class="btn" onclick="updateJumlah(<?=$row['id_keranjang']?>, 'up')"
                        id="btnPlus_<?=$row['id_keranjang']?>">
                        <svg xmlns=" http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi bi-plus-circle-fill text-danger" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg>
                    </a>
                </div>
            </div>
            <input type="hidden" id="idInput_<?=$row['id_keranjang']?>" value="<?= $row['id'] ?>">
            <input type="hidden" id="namaInput_<?=$row['id_keranjang']?>" value="<?= $row['nama'] ?>">
            <input type="hidden" id="hargaInput_<?=$row['id_keranjang']?>" value="<?= $row['harga'] ?>">
            <input type="hidden" id="jumlahInput_<?=$row['id_keranjang']?>" value="<?= $row['jumlah'] ?>">
            <?php
                        $index_produk++;
                    endwhile;
                endif;
            ?>
        </div>
        <div class="col-1"></div>
        <div class="col">
            <div class="card border-cstm-rounded shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Total Belanja</h5>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="text-muted" id="totalNama">
                            -
                        </h6>
                        <h6 class="text-muted" id="totalHarga">
                            -
                        </h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold">Total Harga</h5>
                        <h5 class="fw-bold" id="totalHargaSemua">
                            -
                        </h5>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button"
                            class="btn btn-danger bg-red rounded <?= (mysqli_num_rows($result) == 0) ? "disabled" : "" ?>"
                            id="btnBeli">
                            <h5 class="fw-bold mb-0 py-1 ">Beli</h5>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-5">
    <div>
        <h5 class="fw-bold mb-4">Belanja Barang Lainnya</h5>
        <div class="row">
            <?php
                $query = "SELECT * FROM produk WHERE id NOT IN (SELECT id_produk FROM keranjang WHERE id_user = $id_user) LIMIT 10";
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
</div>

<script src="scripts/keranjang.js"></script>

<?php
    include_once("layout/footer.php");