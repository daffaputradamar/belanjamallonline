<?php
    session_start();
    include_once("config/connection.php");
    
    include_once("layout/header.php");

    $id_user = $_SESSION['id'];
    $nama_user = $_SESSION['nama'];
?>

<?php
    include_once("layout/navbar.php");
?>

<div class="container my-5">
    <h4 class="fw-bold">Daftar Transaksi</h4>
    <nav class="mt-4">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Semua</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Berlangsung</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Selesai</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <?php
                $query = "SELECT t.*, p.nama pnama, p.gambar pgambar, p.harga pharga FROM transaksi t JOIN produk p ON t.id_produk = p.id WHERE id_user = $id_user";
                if ($row = mysqli_query($con, $query)):
                    while ($data = mysqli_fetch_assoc($row)):
            ?>
            <div class="card mt-3 rounded shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="d-flex align-items-center">
                                <img src="assets/homepage/<?= $data['pgambar'] ?>" alt="gambar" class="img-fluid"
                                    width="100">
                                <div class="ms-4">
                                    <div>
                                        <h6><?= $data['pnama'] ?>
                                        </h6>
                                        <small class="text-muted"><?= $data['jumlah_produk'] ?>
                                            Item
                                        </small>
                                    </div>
                                    <div class="mt-4">
                                        <small
                                            class="text-muted me-3 fst-italic"><?= date_format(date_create($data['tgl_pembelian']), "d - m - Y") ?></small>
                                        <span class="badge bg-danger"><?php
                                        switch ($data['status']) {
                                            case 1:
                                                echo "Menunggu Pembayaran";
                                                break;
                                            case 2:
                                                echo "Menunggu Konfirmasi";
                                                break;
                                            case 3:
                                                echo "Selesai";
                                                break;
                                        }
                                    ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center border-start justify-content-between">
                                <h5 class="text-muted ms-5 me-5">Total Harga</h5>
                                <div class="d-flex flex-column align-items-end">
                                    <small class="text-danger" type="button" data-bs-toggle="modal"
                                        data-bs-target="#produk1<?=$data['id']?>">Lihat
                                        Detail Transaksi</small>
                                    <h5 class="card-text fw-bold mt-4 mb-4">
                                        <?= "Rp. " . number_format($data['total_bayar'], 0, ",", ".") ?>
                                    </h5>
                                    <?php if ($data['status'] < 3): ?>
                                    <button type="button" class="btn btn-danger bg-red px-3" data-bs-toggle="modal"
                                        data-bs-target="#produkConfirm1<?=$data['id']?>">
                                        <?php
                                    switch ($data['status']) {
                                        case 1:
                                            echo "Konfirmasi Pembayaran";
                                            break;
                                        case 2:
                                            echo "Konfirmasi Penerimaan";
                                            break;
                                    }
                                ?>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="produkConfirm1<?=$data['id']?>" tabindex="-1"
                aria-labelledby="produkConfirm1<?=$data['id']?>" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable rounded">
                    <div class="modal-content">
                        <div class="modal-body px-5 py-4">
                            <div class="text-center">
                                <h3 class="modal-title mb-5" id="produkConfirm1<?=$data['id']?>">
                                    <?php
                                    switch ($data['status']) {
                                        case 1:
                                            echo "Konfirmasi Pembayaran Barang";
                                            break;
                                        case 2:
                                            echo "Konfirmasi Penerimaan Barang";
                                            break;
                                    }
                                ?>
                                </h3>
                            </div>
                            <div class="d-flex justify-content-between px-3">
                                <img src="assets/konfirmasi pembayaran/ilustrasi_confirm.png" alt="logo_confirm"
                                    class="me-3">
                                <div class="ms-5">
                                    <h5 class="mb-3">Apakah kamu sudah <?php
                                    switch ($data['status']) {
                                        case 1:
                                            echo "membayar barang ini?";
                                            break;
                                        case 2:
                                            echo "menerima barang ini?";
                                            break;
                                    }
                                    ?>
                                    </h5>
                                    <form action="actions/update_transaksi_action.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                        <button class="btn btn-danger px-5 fw-bold" type="submit">
                                            Ya
                                        </button>
                                        <button type="button" class="btn btn-light text-danger px-5 fw-bold ms-3"
                                            data-bs-dismiss="modal">
                                            Tidak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="produk1<?=$data['id']?>" tabindex="-1" aria-labelledby="produk1<?=$data['id']?>"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable rounded">
                    <div class="modal-content">
                        <div class="modal-body px-5 py-4">
                            <div class="d-flex justify-content-between mb-3">
                                <div></div>
                                <h5 class="modal-title text-center" id="produk1<?=$data['id']?>">
                                    Detail Transaksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="row">
                                <div class="col text-start">
                                    <div class="mb-3">
                                        <small class="text-muted mb-3">Nomor Transaksi</small>
                                        <h6 class="text-danger">ABC123DEF456GHI</h6>
                                    </div>
                                    <div>
                                        <small class="text-muted mb-3">Status Transaksi</small>
                                        <h6><?php
                                        switch ($data['status']) {
                                            case 1:
                                                echo "Menunggu Pembayaran";
                                                break;
                                            case 2:
                                                echo "Menunggu Konfirmasi";
                                                break;
                                            case 3:
                                                echo "Selesai";
                                                break;
                                        }
                                    ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <div class="mb-3">
                                        <small class="text-muted mb-3">Nomor Toko</small>
                                        <h6 class="text-danger">SerbaAda Shop</h6>
                                    </div>
                                    <div>
                                        <small class="text-muted mb-3">Tanggal Pembelian</small>
                                        <h6><?= date_format(date_create($data['tgl_pembelian']), "d - m - Y, H.i") ?>
                                            WIB</h6>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="text-muted mb-3">Barang</h6>
                            <div class="d-flex align-items-center">
                                <img src="assets/homepage/<?= $data['pgambar'] ?>" alt="gambar" class="img-fluid"
                                    width="80">
                                <div class="ms-4">
                                    <div>
                                        <h6><?= $data['pnama'] ?>
                                        </h6>
                                    </div>
                                    <div class="mt-4">
                                        <h6 class="fw-bold">
                                            <?= "Rp. " . number_format($data['pharga'], 0, ",", ".") ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="text-muted mb-3">Alamat Pengiriman</h6>
                            <h6 class="text-danger mb-0"><?= $nama_user ?>
                            </h6>
                            <small class="text-muted">Jl. KH. Achmad Dahlan 11 RT 01 RW 04,
                                Kelurahan Pohjentrek,
                                Kecamatan Purworejoasdasdasasdasd
                                Kota Pasuruan, 67119</small>
                            <br>
                            <small class="text-muted">08123456789</small>
                            <br>
                            <br>
                            <small class="text-muted fw-bold">
                                <?php
                                    $kurir = explode("_", $data['kurir']);
                                ?>
                                <span class="me-3">
                                    <?= $kurir[0] ?>
                                </span>
                                <span>
                                    <?= $kurir[1] ?>
                                </span>
                            </small>
                            <hr class="my-4">
                            <h6 class="text-muted mb-3">Pembayaran</h6>
                            <div class="row">
                                <div class="col">
                                    <small class="text-muted">Total Harga
                                        (<?= $data['jumlah_produk'] ?>
                                        Item)</small><br />
                                    <small class="text-muted">Total Ongkos Kirim</small><br />
                                    <small class="text-muted">Total Pembayaran</small><br />
                                    <small class="text-muted">Metode Pembayaran</small><br />
                                </div>
                                <div class="col">
                                    <small
                                        class="fw-bold"><?= "Rp. " . number_format($data['produk_ongkos'], 0, ",", ".") ?></small><br />
                                    <small
                                        class="fw-bold"><?= "Rp. " . number_format($data['kurir_ongkos'], 0, ",", ".") ?></small><br />
                                    <small
                                        class="fw-bold text-danger"><?= "Rp. " . number_format($data['total_bayar'], 0, ",", ".") ?></small><br />
                                    <small class="fw-bold"> Transfer Bank
                                        <?= strtoupper($data['jenis_pembayaran']) ?></small><br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    endwhile;
                endif;
            ?>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <?php
                $query = "SELECT t.*, p.nama pnama, p.gambar pgambar, p.harga pharga FROM transaksi t JOIN produk p ON t.id_produk = p.id WHERE id_user = $id_user AND status = 1 OR status = 2";
                if ($row = mysqli_query($con, $query)):
                    while ($data = mysqli_fetch_assoc($row)):
            ?>
            <div class="card mt-3 rounded shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="d-flex align-items-center">
                                <img src="assets/homepage/<?= $data['pgambar'] ?>" alt="gambar" class="img-fluid"
                                    width="100">
                                <div class="ms-4">
                                    <div>
                                        <h6><?= $data['pnama'] ?>
                                        </h6>
                                        <small class="text-muted"><?= $data['jumlah_produk'] ?>
                                            Item
                                        </small>
                                    </div>
                                    <div class="mt-4">
                                        <small
                                            class="text-muted me-3 fst-italic"><?= date_format(date_create($data['tgl_pembelian']), "d - m - Y") ?></small>
                                        <span class="badge bg-danger"><?php
                                        switch ($data['status']) {
                                            case 1:
                                                echo "Menunggu Pembayaran";
                                                break;
                                            case 2:
                                                echo "Menunggu Konfirmasi";
                                                break;
                                            case 3:
                                                echo "Selesai";
                                                break;
                                        }
                                    ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center border-start justify-content-between">
                                <h5 class="text-muted ms-5 me-5">Total Harga</h5>
                                <div class="d-flex flex-column align-items-end">
                                    <small class="text-danger" type="button" data-bs-toggle="modal"
                                        data-bs-target="#produk2<?=$data['id']?>">Lihat
                                        Detail Transaksi</small>
                                    <h5 class="card-text fw-bold mt-4 mb-4">
                                        <?= "Rp. " . number_format($data['total_bayar'], 0, ",", ".") ?>
                                    </h5>
                                    <?php if ($data['status'] < 3): ?>
                                    <button type="button" class="btn btn-danger bg-red px-3" data-bs-toggle="modal"
                                        data-bs-target="#produkConfirm2<?=$data['id']?>">
                                        <?php
                                    switch ($data['status']) {
                                        case 1:
                                            echo "Konfirmasi Pembayaran";
                                            break;
                                        case 2:
                                            echo "Konfirmasi Penerimaan";
                                            break;
                                    }
                                ?>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="produkConfirm2<?=$data['id']?>" tabindex="-1"
                aria-labelledby="produkConfirm2<?=$data['id']?>" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable rounded">
                    <div class="modal-content">
                        <div class="modal-body px-5 py-4">
                            <div class="text-center">
                                <h3 class="modal-title mb-5" id="produkConfirm2<?=$data['id']?>">
                                    <?php
                                    switch ($data['status']) {
                                        case 1:
                                            echo "Konfirmasi Pembayaran Barang";
                                            break;
                                        case 2:
                                            echo "Konfirmasi Penerimaan Barang";
                                            break;
                                    }
                                ?>
                                </h3>
                            </div>
                            <div class="d-flex justify-content-between px-3">
                                <img src="assets/konfirmasi pembayaran/ilustrasi_confirm.png" alt="logo_confirm"
                                    class="me-3">
                                <div class="ms-5">
                                    <h5 class="mb-3">Apakah kamu sudah <?php
                                    switch ($data['status']) {
                                        case 1:
                                            echo "membayar barang ini?";
                                            break;
                                        case 2:
                                            echo "menerima barang ini?";
                                            break;
                                    }
                                    ?>
                                    </h5>
                                    <form action="actions/update_transaksi_action.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                        <button class="btn btn-danger px-5 fw-bold" type="submit">
                                            Ya
                                        </button>
                                        <button type="button" class="btn btn-light text-danger px-5 fw-bold ms-3"
                                            data-bs-dismiss="modal">
                                            Tidak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="produk2<?=$data['id']?>" tabindex="-1" aria-labelledby="produk2<?=$data['id']?>"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable rounded">
                    <div class="modal-content">
                        <div class="modal-body px-5 py-4">
                            <div class="d-flex justify-content-between mb-3">
                                <div></div>
                                <h5 class="modal-title text-center" id="produk2<?=$data['id']?>">
                                    Detail Transaksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="row">
                                <div class="col text-start">
                                    <div class="mb-3">
                                        <small class="text-muted mb-3">Nomor Transaksi</small>
                                        <h6 class="text-danger">ABC123DEF456GHI</h6>
                                    </div>
                                    <div>
                                        <small class="text-muted mb-3">Status Transaksi</small>
                                        <h6><?php
                                        switch ($data['status']) {
                                            case 1:
                                                echo "Menunggu Pembayaran";
                                                break;
                                            case 2:
                                                echo "Menunggu Konfirmasi";
                                                break;
                                            case 3:
                                                echo "Selesai";
                                                break;
                                        }
                                    ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <div class="mb-3">
                                        <small class="text-muted mb-3">Nomor Toko</small>
                                        <h6 class="text-danger">SerbaAda Shop</h6>
                                    </div>
                                    <div>
                                        <small class="text-muted mb-3">Tanggal Pembelian</small>
                                        <h6><?= date_format(date_create($data['tgl_pembelian']), "d - m - Y, H.i") ?>
                                            WIB</h6>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="text-muted mb-3">Barang</h6>
                            <div class="d-flex align-items-center">
                                <img src="assets/homepage/<?= $data['pgambar'] ?>" alt="gambar" class="img-fluid"
                                    width="80">
                                <div class="ms-4">
                                    <div>
                                        <h6><?= $data['pnama'] ?>
                                        </h6>
                                    </div>
                                    <div class="mt-4">
                                        <h6 class="fw-bold">
                                            <?= "Rp. " . number_format($data['pharga'], 0, ",", ".") ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="text-muted mb-3">Alamat Pengiriman</h6>
                            <h6 class="text-danger mb-0"><?= $nama_user ?>
                            </h6>
                            <small class="text-muted">Jl. KH. Achmad Dahlan 11 RT 01 RW 04,
                                Kelurahan Pohjentrek,
                                Kecamatan Purworejoasdasdasasdasd
                                Kota Pasuruan, 67119</small>
                            <br>
                            <small class="text-muted">08123456789</small>
                            <br>
                            <br>
                            <small class="text-muted fw-bold">
                                <?php
                                    $kurir = explode("_", $data['kurir']);
                                ?>
                                <span class="me-3">
                                    <?= $kurir[0] ?>
                                </span>
                                <span>
                                    <?= $kurir[1] ?>
                                </span>
                            </small>
                            <hr class="my-4">
                            <h6 class="text-muted mb-3">Pembayaran</h6>
                            <div class="row">
                                <div class="col">
                                    <small class="text-muted">Total Harga
                                        (<?= $data['jumlah_produk'] ?>
                                        Item)</small><br />
                                    <small class="text-muted">Total Ongkos Kirim</small><br />
                                    <small class="text-muted">Total Pembayaran</small><br />
                                    <small class="text-muted">Metode Pembayaran</small><br />
                                </div>
                                <div class="col">
                                    <small
                                        class="fw-bold"><?= "Rp. " . number_format($data['produk_ongkos'], 0, ",", ".") ?></small><br />
                                    <small
                                        class="fw-bold"><?= "Rp. " . number_format($data['kurir_ongkos'], 0, ",", ".") ?></small><br />
                                    <small
                                        class="fw-bold text-danger"><?= "Rp. " . number_format($data['total_bayar'], 0, ",", ".") ?></small><br />
                                    <small class="fw-bold"> Transfer Bank
                                        <?= strtoupper($data['jenis_pembayaran']) ?></small><br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    endwhile;
                endif;
            ?>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <?php
                $query = "SELECT t.*, p.nama pnama, p.gambar pgambar, p.harga pharga FROM transaksi t JOIN produk p ON t.id_produk = p.id WHERE id_user = $id_user AND status = 3";
                if ($row = mysqli_query($con, $query)):
                    while ($data = mysqli_fetch_assoc($row)):
            ?>
            <div class="card mt-3 rounded shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="d-flex align-items-center">
                                <img src="assets/homepage/<?= $data['pgambar'] ?>" alt="gambar" class="img-fluid"
                                    width="100">
                                <div class="ms-4">
                                    <div>
                                        <h6><?= $data['pnama'] ?>
                                        </h6>
                                        <small class="text-muted"><?= $data['jumlah_produk'] ?>
                                            Item
                                        </small>
                                    </div>
                                    <div class="mt-4">
                                        <small
                                            class="text-muted me-3 fst-italic"><?= date_format(date_create($data['tgl_pembelian']), "d - m - Y") ?></small>
                                        <span class="badge bg-danger"><?php
                                        switch ($data['status']) {
                                            case 1:
                                                echo "Menunggu Pembayaran";
                                                break;
                                            case 2:
                                                echo "Menunggu Konfirmasi";
                                                break;
                                            case 3:
                                                echo "Selesai";
                                                break;
                                        }
                                    ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center border-start justify-content-between">
                                <h5 class="text-muted ms-5 me-5">Total Harga</h5>
                                <div class="d-flex flex-column align-items-end">
                                    <small class="text-danger" type="button" data-bs-toggle="modal"
                                        data-bs-target="#produk3<?=$data['id']?>">Lihat
                                        Detail Transaksi</small>
                                    <h5 class="card-text fw-bold mt-4 mb-4">
                                        <?= "Rp. " . number_format($data['total_bayar'], 0, ",", ".") ?>
                                    </h5>
                                    <?php if ($data['status'] < 3): ?>
                                    <button type="button" class="btn btn-danger bg-red px-3" data-bs-toggle="modal"
                                        data-bs-target="#produkConfirm3<?=$data['id']?>">
                                        <?php
                                    switch ($data['status']) {
                                        case 1:
                                            echo "Konfirmasi Pembayaran";
                                            break;
                                        case 2:
                                            echo "Konfirmasi Penerimaan";
                                            break;
                                    }
                                ?>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="produkConfirm3<?=$data['id']?>" tabindex="-1"
                aria-labelledby="produkConfirm3<?=$data['id']?>" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable rounded">
                    <div class="modal-content">
                        <div class="modal-body px-5 py-4">
                            <div class="text-center">
                                <h3 class="modal-title mb-5" id="produkConfirm3<?=$data['id']?>">
                                    <?php
                                    switch ($data['status']) {
                                        case 1:
                                            echo "Konfirmasi Pembayaran Barang";
                                            break;
                                        case 2:
                                            echo "Konfirmasi Penerimaan Barang";
                                            break;
                                    }
                                ?>
                                </h3>
                            </div>
                            <div class="d-flex justify-content-between px-3">
                                <img src="assets/konfirmasi pembayaran/ilustrasi_confirm.png" alt="logo_confirm"
                                    class="me-3">
                                <div class="ms-5">
                                    <h5 class="mb-3">Apakah kamu sudah <?php
                                    switch ($data['status']) {
                                        case 1:
                                            echo "membayar barang ini?";
                                            break;
                                        case 2:
                                            echo "menerima barang ini?";
                                            break;
                                    }
                                    ?>
                                    </h5>
                                    <form action="actions/update_transaksi_action.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                        <button class="btn btn-danger px-5 fw-bold" type="submit">
                                            Ya
                                        </button>
                                        <button type="button" class="btn btn-light text-danger px-5 fw-bold ms-3"
                                            data-bs-dismiss="modal">
                                            Tidak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="produk3<?=$data['id']?>" tabindex="-1" aria-labelledby="produk3<?=$data['id']?>"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable rounded">
                    <div class="modal-content">
                        <div class="modal-body px-5 py-4">
                            <div class="d-flex justify-content-between mb-3">
                                <div></div>
                                <h5 class="modal-title text-center" id="produk3<?=$data['id']?>">
                                    Detail Transaksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="row">
                                <div class="col text-start">
                                    <div class="mb-3">
                                        <small class="text-muted mb-3">Nomor Transaksi</small>
                                        <h6 class="text-danger">ABC123DEF456GHI</h6>
                                    </div>
                                    <div>
                                        <small class="text-muted mb-3">Status Transaksi</small>
                                        <h6><?php
                                        switch ($data['status']) {
                                            case 1:
                                                echo "Menunggu Pembayaran";
                                                break;
                                            case 2:
                                                echo "Menunggu Konfirmasi";
                                                break;
                                            case 3:
                                                echo "Selesai";
                                                break;
                                        }
                                    ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <div class="mb-3">
                                        <small class="text-muted mb-3">Nomor Toko</small>
                                        <h6 class="text-danger">SerbaAda Shop</h6>
                                    </div>
                                    <div>
                                        <small class="text-muted mb-3">Tanggal Pembelian</small>
                                        <h6><?= date_format(date_create($data['tgl_pembelian']), "d - m - Y, H.i") ?>
                                            WIB</h6>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="text-muted mb-3">Barang</h6>
                            <div class="d-flex align-items-center">
                                <img src="assets/homepage/<?= $data['pgambar'] ?>" alt="gambar" class="img-fluid"
                                    width="80">
                                <div class="ms-4">
                                    <div>
                                        <h6><?= $data['pnama'] ?>
                                        </h6>
                                    </div>
                                    <div class="mt-4">
                                        <h6 class="fw-bold">
                                            <?= "Rp. " . number_format($data['pharga'], 0, ",", ".") ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="text-muted mb-3">Alamat Pengiriman</h6>
                            <h6 class="text-danger mb-0"><?= $nama_user ?>
                            </h6>
                            <small class="text-muted">Jl. KH. Achmad Dahlan 11 RT 01 RW 04,
                                Kelurahan Pohjentrek,
                                Kecamatan Purworejoasdasdasasdasd
                                Kota Pasuruan, 67119</small>
                            <br>
                            <small class="text-muted">08123456789</small>
                            <br>
                            <br>
                            <small class="text-muted fw-bold">
                                <?php
                                    $kurir = explode("_", $data['kurir']);
                                ?>
                                <span class="me-3">
                                    <?= $kurir[0] ?>
                                </span>
                                <span>
                                    <?= $kurir[1] ?>
                                </span>
                            </small>
                            <hr class="my-4">
                            <h6 class="text-muted mb-3">Pembayaran</h6>
                            <div class="row">
                                <div class="col">
                                    <small class="text-muted">Total Harga
                                        (<?= $data['jumlah_produk'] ?>
                                        Item)</small><br />
                                    <small class="text-muted">Total Ongkos Kirim</small><br />
                                    <small class="text-muted">Total Pembayaran</small><br />
                                    <small class="text-muted">Metode Pembayaran</small><br />
                                </div>
                                <div class="col">
                                    <small
                                        class="fw-bold"><?= "Rp. " . number_format($data['produk_ongkos'], 0, ",", ".") ?></small><br />
                                    <small
                                        class="fw-bold"><?= "Rp. " . number_format($data['kurir_ongkos'], 0, ",", ".") ?></small><br />
                                    <small
                                        class="fw-bold text-danger"><?= "Rp. " . number_format($data['total_bayar'], 0, ",", ".") ?></small><br />
                                    <small class="fw-bold"> Transfer Bank
                                        <?= strtoupper($data['jenis_pembayaran']) ?></small><br />
                                </div>
                            </div>
                        </div>
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