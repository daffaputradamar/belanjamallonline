<?php
session_start();
include_once("../config/connection.php");

if (!isset($_SESSION['nama'])) {
    header("Location: ../login.php");
}

$id_user = $_SESSION['id'];
$id_produk = $_POST['id_produk'];
$total_bayar = $_POST['total_bayar'];
$produk_ongkos = $_POST['produk_ongkos'];
$status = $_POST['status'];
$kurir = $_POST['kurir'];
$kurir_ongkos = $_POST['kurir_ongkos'];
$jenis_pembayaran = $_POST['jenis_pembayaran'];
$jumlah_produk = $_POST['jumlah_produk'];

// echo "INSERT INTO transaksi VALUE (null, $id_produk, $total_bayar, $produk_ongkos, $status, '$tgl_pembelian', '$kurir', $kurir_ongkos, '$jenis_pembayaran', $jumlah_produk, $id_user)";
// return;

if (mysqli_query($con, "INSERT INTO transaksi VALUE (null, $id_produk, $total_bayar, $produk_ongkos, $status, CURRENT_TIMESTAMP(), '$kurir', $kurir_ongkos, '$jenis_pembayaran', $jumlah_produk, $id_user)")) {
    $result = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = $id_user AND id_produk = $id_produk");

    if (mysqli_num_rows($result) == 1) {
        mysqli_query($con, "DELETE FROM keranjang WHERE id_user = $id_user AND id_produk = $id_produk");
    }
}

$result;

if (mysqli_error($con)) {
    $result = array("success" => false);
}

$result = array("success" => true);
echo json_encode($result);