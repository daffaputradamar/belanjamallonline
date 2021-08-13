<?php
include_once("../config/connection.php");

$email = $_POST['email'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$nomor_hp = "0".$_POST['nomor_hp'];

// $query = "INSERT INTO user (email, password, nama, tgl_lahir, jenis_kelamin, no_hp) VALUE ('$email', '$password', '$nama', '$tanggal_lahir', '$jenis_kelamin', '$nomor_hp')";

// echo $query;

mysqli_query($con, "INSERT INTO user (email, password, nama, tgl_lahir, jenis_kelamin, no_hp) VALUE ('$email', '$password', '$nama', '$tanggal_lahir', '$jenis_kelamin', '$nomor_hp')");

header('Location: ../login.php');