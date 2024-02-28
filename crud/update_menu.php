<?php
require_once "../function/konek.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produkID = $_POST["produkID"];
    $namaProduk = $_POST["namaProduk"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    $query = "UPDATE produk SET namaProduk = ?, harga = ?, stok = ? WHERE produkID = ?";
    $stmt = $koneksi->prepare($query);
    
    $stmt->bind_param("siii", $namaProduk, $harga, $stok, $produkID);

    if ($stmt->execute()) {
        echo json_encode(array('success' => 'Perubahan disimpan.'));
    } else {
        echo json_encode(array('error' => 'Gagal menyimpan perubahan: ' . $stmt->error));
    }

    $stmt->close();
} else {
    echo json_encode(array('error' => 'Permintaan tidak valid'));
}