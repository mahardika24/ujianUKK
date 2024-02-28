<?php
require_once "../function/konek.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["produkID"])) {
    $produkID = $_POST["produkID"];
    
    $query = "SELECT namaProduk, harga, stok FROM produk WHERE produkID = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $produkID);
    $stmt->execute();
    $stmt->bind_result($namaProduk, $harga, $stok);
    $stmt->fetch();
    $stmt->close();

    $data = array(
        'namaProduk' => $namaProduk,
        'harga' => $harga,
        'stok' => $stok
    );

    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'Permintaan tidak valid'));
}