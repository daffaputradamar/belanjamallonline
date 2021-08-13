<?php
    session_start();
    include_once("config/connection.php");
    
    include_once("layout/header.php");
?>

<?php
    include_once("layout/navbar.php");
?>

<div class="container mb-5">
    <div class="modal" tabindex="-1" id="home_berhasil">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="text-center">
                        <img src="assets/checkout/ilustrasi_pembayaran.png" alt="illus" class="img-fluid">
                        <h1 class="fw-bold mt-5">Transaksimu Berhasil</h1>
                        <h3 class="text-muted fw-light">
                            Pesananmu akan diteruskan ke penjual. Kamu bisa melanjutkan belanjamu.
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <img src="assets/homepage/banner.jpg" alt="" class="img-fluid w-100">
    </div>
    <div class="row mt-4 mb-5">
        <div class="col">
            <div class="card shadow-sm border-cstm-rounded">
                <div class="card-body">
                    <div class="text-center">
                        <img src="assets/homepage/logo_mall.png" alt="" class="img-fluid">
                        <h2 class="fw-bold mt-3">Mall</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-cstm-rounded">
                <div class="card-body">
                    <div class="text-center">
                        <img src="assets/homepage/logo_toko.png" alt="" class="img-fluid">
                        <h2 class="fw-bold mt-3">Toko</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-cstm-rounded">
                <div class="card-body">
                    <div class="text-center">
                        <img src="assets/homepage/logo_promosi.png" alt="" class="img-fluid">
                        <h2 class="fw-bold mt-3">Promosi</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-cstm-rounded">
                <div class="card-body">
                    <div class="text-center">
                        <img src="assets/homepage/logo_kategori.png" alt="" class="img-fluid">
                        <h2 class="fw-bold mt-3">Kategori</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h2 class="fw-bold mb-4">Hanya Untuk Kamu</h2>
        <div class="row mt-5 bg-promo">
            <div class="col-3 ">
                <div class="py-5 ps-4 text-light h-100 d-flex flex-column justify-content-between">
                    <h2 class="fw-bold">Rekomendasi hari ini</h2>
                    <h5 class="mb-5 fw-bold">
                        Nikmati berbagai macam produk dengan harga promo
                    </h5>
                </div>
            </div>
            <div class="col ">
                <div class="py-4">
                    <div class="d-flex justify-content-around">
                        <?php
                    $query = "SELECT * FROM produk WHERE is_promo = 1";
                    if ($row = mysqli_query($con, $query)):
                        while ($data = mysqli_fetch_assoc($row)):
                ?>
                        <div class="card border-cstm-rounded" style="width: 14rem;">
                            <img src="assets/homepage/<?= $data['gambar'] ?>"
                                class="card-img-top img-fluid border-cstm-rounded img-thumbnail" alt="...">
                            <div class="card-body me-2 d-flex flex-column justify-content-between">
                                <h6 class="card-title fs-5"><?= $data['nama'] ?>
                                </h6>
                                <h5 class="card-text fw-bold">
                                    <?= "Rp " . number_format($data['harga'], 0, ",", ".") ?>
                                </h5>
                                <div class="mt-4 d-flex align-items-center">
                                    <img src="assets/icon-star.png" alt="star" style="" class="me-2">
                                    <small class="text-muted">4.8</small>
                                </div>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                <a href="detail.php?id=<?= $data['id'] ?>" class="stretched-link"></a>
                            </div>
                        </div>
                        <?php
                        endwhile;
                    endif;
                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h2 class="fw-bold mb-4">Kategori Pilihan</h2>
        <div class="row align-items-stretch">
            <div class="col">
                <div class="card shadow-sm border-cstm-rounded h-100">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="assets/homepage/logo_elektronik.png" alt="" class="img-fluid">
                            <h3 class="fw-bold mt-3">Elektronik</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm border-cstm-rounded h-100">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="assets/homepage/logo_olahraga.png" alt="" class="img-fluid">
                            <h3 class="fw-bold mt-3">Olahraga</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm border-cstm-rounded h-100">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="assets/homepage/logo_fashion.png" alt="" class="img-fluid">
                            <h3 class="fw-bold mt-3">Fashion</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm border-cstm-rounded h-100">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="assets/homepage/logo_atk.png" alt="" class="img-fluid">
                            <h3 class="fw-bold mt-3">Alat Tulis Kantor</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm border-cstm-rounded h-100">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="assets/homepage/logo_kecantikan.png" alt="" class="img-fluid">
                            <h3 class="fw-bold mt-3">Kecantikan</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h2 class="fw-bold mb-4">Produk Menarik Lainnya</h2>
        <div class="row">
            <?php
                    $query = "SELECT * FROM produk WHERE is_promo = 0";
                    if ($row = mysqli_query($con, $query)):
                        while ($data = mysqli_fetch_assoc($row)):
                ?>
            <div class="col-2 d-flex align-items-stretch">
                <div class="card border-cstm-rounded">
                    <img src=" assets/homepage/<?= $data['gambar'] ?>"
                        class="card-img-top img-fluid border-cstm-rounded" alt="...">
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

<?php
    include_once("layout/footer.php");

    if (isset($_GET['home_berhasil'])):
?>
<script>
const myModal = new bootstrap.Modal(document.getElementById('home_berhasil'))
myModal.show()
setTimeout(() => {
    myModal.hide();
}, 3000);
</script>
<?php
        endif;