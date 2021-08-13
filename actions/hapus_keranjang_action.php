<?php
session_start();
include_once("../config/connection.php");

if (!isset($_SESSION['nama'])) {
    header("Location: ../login.php");
}

$id_keranjang = $_GET['id'];

if (isset($id_keranjang)) {
    mysqli_query($con, "DELETE FROM keranjang WHERE id = $id_keranjang");
} else {
    $id_user = $_SESSION['id'];
    mysqli_query($con, "DELETE FROM keranjang WHERE id_user = $id_user");
}


header("Location: ../keranjang.php");