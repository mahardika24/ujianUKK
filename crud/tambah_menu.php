<?php
session_start();

if (!isset($_SESSION["idPetugas"])) {
    header("Location: ../multi-user/login.php");
    exit();
}

require_once "../function/konek.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaProduk = $_POST["namaProduk"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    
    $gambar = $_FILES['gambar']['tmp_name'];
    $gambarData = file_get_contents($gambar);
    $gambarBase64 = base64_encode($gambarData);

    $query = "INSERT INTO produk (namaProduk, harga, stok, gambar) VALUES ('$namaProduk', '$harga', '$stok', '$gambarBase64')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: ../dataMenu.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
