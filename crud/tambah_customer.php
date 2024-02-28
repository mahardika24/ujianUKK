<?php
session_start();

if (!isset($_SESSION["idPetugas"])) {
    header("Location: ../multi-user/login.php");
    exit();
}

require_once "../function/konek.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaPelanggan = $_POST["namaPelanggan"];
    $alamat = $_POST["alamat"];
    $nomerTelepon = $_POST["nomerTelepon"];


    $query = "INSERT INTO pelanggan ( namaPelanggan, alamat, nomerTelepon) VALUES ( '$namaPelanggan', '$alamat', '$nomerTelepon')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: ../dataCustomer.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}