<?php
require_once "../function/konek.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pelangganID'])) {
    $pelangganID

    = $_POST['pelangganID'];

    $query = "DELETE FROM pelanggan WHERE pelangganID = ?";
    
    $stmt = mysqli_prepare($koneksi, $query);
    
    mysqli_stmt_bind_param($stmt, "i", $pelangganID);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(array("status" => "success", "message" => "Data berhasil dihapus."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Gagal menghapus data."));
    }
    
    mysqli_stmt_close($stmt);
    
    mysqli_close($koneksi);
} else {
    echo json_encode(array("status" => "error", "message" => "Tidak ada data yang dihapus."));
}