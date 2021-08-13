<?php
session_start();
include_once("../config/connection.php");

if (!isset($_SESSION['nama'])) {
    header("Location: ../login.php");
}

$id_produk = $_GET['id_produk'];
$jumlah = $_GET['jumlah'];

$id_user = $_SESSION['id'];

$result = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = $id_user AND id_produk = $id_produk");

if (mysqli_num_rows($result) == 1) {
    if ($row = mysqli_fetch_assoc($result)) {
        $jumlah = $jumlah + $row['jumlah'];
    }
}

header("Location: ../beli.php?id_produk=$id_produk&jumlah=$jumlah");