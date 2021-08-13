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
    <div class="text-center">
        <img src="assets/checkout/ilustrasi_pembayaran.png" alt="illus" class="img-fluid">
        <h1 class="fw-bold mt-5">Transaksimu Berhasil</h1>
        <h3 class="text-muted fw-light">
            Pesananmu akan diteruskan ke penjual. Kamu bisa melanjutkan belanjamu.
        </h3>
    </div>
</div>

<?php
    include_once("layout/footer.php");