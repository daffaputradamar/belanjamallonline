<?php

define("HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DATABASE", "belanjamallonline");

$con = mysqli_connect(HOST, DB_USER, DB_PASS, DATABASE);

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}