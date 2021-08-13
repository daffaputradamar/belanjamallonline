<nav class="navbar navbar-expand-lg navbar-dark bg-red">
    <div class="container-fluid">
        <a class="navbar-brand text-center" href="home.php">
            <img src="assets/Logo-Belanja-Mall-Online-kecil.png" alt="logo" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="d-flex w-100 px-5">
            <input class="form-control form-control-sm me-2 " type="search" placeholder="Cari barang kesukaanmu">
        </form>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['nama'])): ?>
                <li class="nav-item">
                    <a class="nav-link active position-relative" aria-current="page" href="keranjang.php">
                        <img src="assets/header_login/icon_cart.png">
                        <?php
                            $id_user = $_SESSION['id'];
                            $result = mysqli_query($con, "SELECT id jml FROM keranjang WHERE id_user = $id_user");
                            if (mysqli_num_rows($result) != 0):
                        ?>
                        <span
                            class="position-absolute top-75 start-75 translate-middle p-1 bg-warning border rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                        <?php
                            endif;
                        ?>
                    </a>
                </li>
                <li class="nav-item dropdown mt-2 mx-2">
                    <a href="#" id="notification" data-bs-toggle="dropdown">
                        <img src="assets/header_login/icon_notification.png">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" role="menu" aria-labelledby="notification">
                        <li>
                            <h5 class="dropdown-header d-flex justify-content-between align-items-center">
                                Notifikasi
                                <small class="text-danger">Lihat semua</small>
                            </h5>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item fw-bold" href="#">
                                <small>Silahkan lakukan pembayaran</small>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown mt-2 mx-2">
                    <a href="#" id="message" data-bs-toggle="dropdown">
                        <img src="assets/header_login/icon_mail.png">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" role="menu" aria-labelledby="message">
                        <li>
                            <h5 class="dropdown-header d-flex justify-content-between align-items-center">
                                Pesan
                                <small class="text-danger">Lihat semua</small>
                            </h5>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item fw-bold" href="#">
                                <img src="assets/person1.jpg" alt="person1" width="50" class="me-2 rounded-circle">
                                <small>Barang ready kak :')</small>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item text-muted" href="#">
                                <img src="assets/person2.png" alt="person1" width="50" class="me-2 rounded-circle">
                                <small>Maaf barangnya masih out of stock</small></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?= explode(" ", $_SESSION['nama'])[0] ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                        <li><a class="dropdown-item" href="transaksi.php">Daftar Transaksi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="actions/logout_action.php">Keluar</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link active btn btn-online-dark fw-bold py-1 px-3" href="login.php"
                        style="border: 1px solid #fff">
                        <h5 class="mb-0 fw-bold">Masuk</h5>
                    </a>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link active btn btn-online-info fw-bold py-1 px-3 text-danger" href="daftar.php"
                        style="background-color: #fff">
                        <h5 class="mb-0 fw-bold">Daftar</h5>
                    </a>
                </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>