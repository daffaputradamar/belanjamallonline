<?php
session_start();
include_once("../config/connection.php");

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}

// if (mysqli_query($con, "INSERT INTO keranjang")) {
// }
$id_keranjang = $_POST['id'];
$jumlah = $_POST['jumlah'];

mysqli_query($con, "UPDATE keranjang SET jumlah = $jumlah WHERE id = $id_keranjang");

$result;

if (mysqli_error($con)) {
    $result = array("success" => false);
}

$result = array("success" => true);
echo json_encode($result);