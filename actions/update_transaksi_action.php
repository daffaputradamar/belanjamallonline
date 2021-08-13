<?php
include_once("../config/connection.php");

$id = $_POST['id'];

mysqli_query($con, "UPDATE transaksi SET status = status + 1 WHERE id = $id");

header('Location: ../transaksi.php');