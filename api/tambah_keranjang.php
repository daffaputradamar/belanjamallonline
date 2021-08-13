<?php
session_start();
include_once("../config/connection.php");

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}

// if (mysqli_query($con, "INSERT INTO keranjang")) {
// }
$id_user = $_POST['id_user'];
$id_produk = $_POST['id_produk'];
$jumlah = $_POST['jumlah'];

if ($result = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = $id_user AND id_produk = $id_produk")) {
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $keranjang_id = $row['id'];
            mysqli_query($con, "UPDATE keranjang SET jumlah = jumlah + $jumlah WHERE id = $keranjang_id");
        }
    } else {
        mysqli_query($con, "INSERT INTO keranjang (id_user, id_produk, jumlah) VALUES ($id_user, $id_produk, $jumlah)");
    }
}

$result;

if (mysqli_error($con)) {
    $result = array("success" => false);
}

$result = array("success" => true);
echo json_encode($result);