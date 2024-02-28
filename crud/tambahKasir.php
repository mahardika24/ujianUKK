<?php
session_start();

if (!isset($_SESSION["idPetugas"])) {
    header("Location: ../multi-user/login.php");
    exit();
}

require_once "../function/konek.php";

$tanggalPenjualan = mysqli_real_escape_string($koneksi, $_POST['tanggalPenjualan']);
$totalHarga = mysqli_real_escape_string($koneksi, $_POST['totalHarga']);
$pelangganID = intval(mysqli_real_escape_string($koneksi, $_POST['pelangganID'])); 

$query = "INSERT INTO penjualan (tanggalPenjualan, totalHarga, pelangganID) VALUES ('$tanggalPenjualan', '$totalHarga', '$pelangganID')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "Transaksi berhasil disimpan ke database";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);