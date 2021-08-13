<?php
session_start();
include_once("../config/connection.php");

$email = $_POST['email'];
$password = $_POST['password'];

if ($row = mysqli_query($con, "SELECT * FROM user WHERE email = '$email' AND password = '$password'")) {
    if (mysqli_num_rows($row) != 0) {
        while ($data = mysqli_fetch_assoc($row)) {
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['id'] = $data['id'];
            $_SESSION['no_hp'] = $data['no_hp'];
        }
        header('Location: ../home.php');
        return;
    }
    // echo "tes";
    header('Location: ../login.php');
} else {
    // echo "wow";
    header('Location: ../login.php');
}