<?php
session_start();

if (!isset($_SESSION["idPetugas"])) {
    header("Location: ../multi-user/login.php");
    exit();
}

require_once "./function/konek.php";

$id_petugas = $_SESSION["idPetugas"];
$role = $_SESSION["role"];

$query = "SELECT pelangganID, namaPelanggan, alamat, nomerTelepon FROM pelanggan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="./assets/iconTittle.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="./assets/iconTitle.png" type="image/x-icon">
    <title>Cetak Pelanggan</title>
</head>
<body>


<h1 class="text-gray-600 font-semibold text-lg flex justify-center">Laporan Pelanggan</h1>
<div class="flex justify-center">
<table id="barangTable" class="table-auto  w-full mx-10 border-collapse">
        <thead>
        <tr class=" text-[#595959] font-medium text-sm">
                <th class="px-4 border border-[#8E8E8E] py-2">No</th>
                <th class="px-4 border border-[#8E8E8E] text-start py-2">Nama Customer</th>
                <th class="px-4 border border-[#8E8E8E] text-start py-2">Alamat</th>
                <th class="px-4 border border-[#8E8E8E] text-start py-2">WA/HP</th>
            </tr>
        </thead>
        <tbody>
         
             <?php
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='" . ($no % 2 === 0 ? 'even:bg-[#e8e6f2ff]' : 'odd:bg-white') . "'>";
                            echo "<td class='border border-[#8E8E8E] border-b font-medium text-[#616161] text-sm px-4 text-center py-2'>" . $no . "</td>";
                            echo "<td class='border border-[#8E8E8E] border-b font-medium text-[#616161] text-sm px-4 py-2 text-center'>" . $row['namaPelanggan'] . "</td>";
                            echo "<td class='border border-[#8E8E8E] border-b font-medium text-[#616161] text-sm px-4  py-2'>" . $row['alamat'] . "</td>";
                            echo "<td class='border border-[#8E8E8E] border-b font-medium text-[#616161] text-sm px-4  py-2'>" . $row['nomerTelepon'] . "</td>";
                           
                           
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center py-4'>Tidak ada data yang ditemukan.</td></tr>";
                    }
                    ?>
        </tbody>
    </table>
</div>

</body>

<script src="./function/main.js"></script>
<script>
    window.print();
</script>
</html>