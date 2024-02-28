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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="shortcut icon" href="./assets/iconTitle.png" type="image/x-icon">

    <title>Data Customer</title>
</head>
<body style="font-family: 'Montserrat', sans-serif;">

    <!-- === BAGIAN ADMIN === -->
    <?php if ($role == 'administrator') : ?>

            <div class="fixed top-0 left-0 w-full h-full bg-black/0 z-40 md:hidden sidebar-overlay"></div>

    <main class="w-full bg-[#E8E6F2] min-h-screen transition-all main">
        <nav style="box-shadow: 0px 4px 31.5px 0px rgba(0, 0, 0, 0.07);" class="h-[70px] px-6 bg-white flex items-center z-40 sticky top-0 left-0">
           
             <button id="menuButton" type="button" class="text-lg text-gray-600 sidebar-toggle block md:hidden">
                <i class="ri-menu-line"></i>
            </button>

            <div class="flex relative  items-center ml-5 gap-1 text-[#505050]">
            <img class="h-7 mr-2" src="./assets/logo.png">
            </div>


            <div id="menuList" class="hidden md:flex ml-5 gap-4 text-[#505050]">
                 <a href="./dashboard.php" class="text-gray-600 font-medium hover:text-gray-900">Dashboard</a>
                 <a href="./dataCustomer.php" class="text-gray-600 font-medium hover:text-gray-900">Data Customer</a>
                 <a href="./dataMenu.php" class="text-gray-600 font-medium hover:text-gray-900">Daftar Menu</a>
            </div>

            <span id="dropdownToggle" class="relative flex items-center ml-auto mr-5 cursor-pointer">
            <i class='bx bxs-user-circle text-4xl text-gray-600'></i>
            <i id="dropdownIcon" class='bx bx-chevron-down text-2xl text-gray-600'></i>
        </span>
    
     <!-- Dropdown menu -->
     <div id="dropdownMenu" class="hidden absolute right-2 mt-40 w-48 bg-white border border-gray-200 rounded-md shadow-md z-50">
    <p class="text-gray-600 flex py-2 justify-center font-medium text-sm"><?php echo $role == 'administrator' ? 'Administrator' : 'Petugas'; ?></p>
    <hr>
    
    <a href="regisPetugas.php" class="flex justify-center py-2 cursor-pointer items-center">
        <i class='bx bx-add-to-queue text-gray-600 font-medium text-lg mr-2'></i>
        <span class="text-gray-600 text-sm font-medium">Tambah Petugas</span>
    </a>

    <hr>
    
    <a id="logoutButton" class="flex justify-center py-2 cursor-pointer items-center">
        <i class='bx bx-log-out text-gray-600 font-medium text-lg mr-2'></i>
        <span class="text-gray-600 text-sm font-medium">Logout</span>
    </a>
</div>
        
        </nav>

            <!-- bagian content -->
            <div class="w-2/3 mx-auto">

     <!-- ==== tambah data ==== -->
     <div id="addForm2" class="fixed z-20 inset-0 overflow-y-auto  bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg mt-20 z-50 shadow-xl max-w-md w-full p-5 max-h-[80vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-600">Tambah Customer</h2>
                    <button onclick="toggleForm2()" class="text-gray-600 hover:text-gray-800 text-xl focus:outline-none">
                    <i class='bx bx-x'></i>
                    </button>
                </div>

                <form action="./crud/tambah_customer.php"  method="POST" enctype="multipart/form-data" class="space-y-4">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="flex flex-col gap-2">
                            <label for="namaPelanggan" class="font-medium text-gray-500">Nama Customer</label>
                            <input type="text" name="namaPelanggan" required class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 font-medium border-gray-300 rounded-md w-full p-2">

                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <div class="flex flex-col gap-2">
                            <label for="alamat" class="font-medium text-gray-500">Alamat</label>
                            <textarea name="alamat" required class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 font-medium border-gray-300 rounded-md w-full p-2"></textarea>
                        </div>
                    </div>


                    <div class="grid grid-cols-1 gap-6">
                        <div class="flex flex-col gap-2">
                            <label for="nomerTelepon" class="font-medium text-gray-500">WA / HP</label>
                            <input type="text" name="nomerTelepon" required value="+62" class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 font-medium border-gray-300 rounded-md w-full p-2">

                        </div>
                    </div>

                    <button type="submit"  class="bg-[#06AF81] hover:bg-[#31BF98] text-white font-semibold py-2 px-4 rounded-md">Simpan</button>
                </form>
            </div>
        </div>
        <!-- ==== end ==== -->

        <div class="button-container flex justify-between relative top-20 flex-col md:flex-row">
                <!-- Tombol "Cetak PDF" -->
                <a href="./cetak.php" target="_blank" class="bg-[#06AF81] text-white px-4 py-3 hover:bg-[#31BF98] font-medium text-sm rounded-md flex items-center mb-2 md:mb-0">
                    <i class='bx bxs-file-pdf'></i>
                    <span class="ml-2">Cetak PDF</span>
                </a>


                <!-- Tombol "Tambah Customer" -->
                <button onclick="toggleForm2()" class="bg-[#06AF81] text-white px-4 py-3 hover:bg-[#31BF98] font-medium text-sm rounded-md flex items-center">
                    <i class='bx bx-user-plus text-xl'></i>
                    <span class="ml-2">Tambah Menu</span>
                </button>
            </div>
            <!-- end -->

            <div class="w-full bg-white h-auto mx-auto mt-24 rounded-lg">
    <div class="bg-gray-800 text-white py-4 px-6 flex items-center gap-4 rounded-t-lg">
    <i class='bx bx-user'></i>
    <h1 class="text-1xl font-medium">Daftar Customer</h1>
    </div>

    <div class="overflow-x-scroll mx-5 mt-5">

    <table id="barangTable" class="table-auto  w-full mx-10 border-collapse">
        <thead>
        <tr class=" text-[#595959] font-medium text-sm">
                <th class="px-4 border border-[#8E8E8E] py-2">No</th>
                <th class="px-4 border border-[#8E8E8E] text-start py-2">Nama Customer</th>
                <th class="px-4 border border-[#8E8E8E] text-start py-2">Alamat</th>
                <th class="px-4 border border-[#8E8E8E] text-start py-2">WA/HP</th>
                <th class="px-4 border border-[#8E8E8E] py-2">Action</th>
            </tr>
        </thead>
        <tbody>
         
             <?php
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='" . ($no % 2 === 0 ? 'even:bg-[#e8e6f2ff]' : 'odd:bg-white') . "'>";
                            echo "<td class='border border-[#8E8E8E] border-b-0 font-medium text-[#616161] text-sm px-4 text-center py-2'>" . $no . "</td>";
                            echo "<td class='border border-[#8E8E8E] border-b-0 font-medium text-[#616161] text-sm px-4 py-2 text-center'>" . $row['namaPelanggan'] . "</td>";
                            echo "<td class='border border-[#8E8E8E] border-b-0 font-medium text-[#616161] text-sm px-4  py-2'>" . $row['alamat'] . "</td>";
                            echo "<td class='border border-[#8E8E8E] border-b-0 font-medium text-[#616161] text-sm px-4  py-2'>" . $row['nomerTelepon'] . "</td>";
                            echo "<td class='border border-[#8E8E8E] border-b-0 font-medium text-[#616161] text-lg text-center px-4 py-2'>
                            <a onclick='hapusCustomer(" . $row['pelangganID'] . ")'> 
                            <i class='bx bx-trash bg-red-500/40 p-1 rounded-sm cursor-pointer hover:bg-red-500/50 text-red-500'></i> 
                            </a>

                           </td>";
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
    </div>

</div>

      

    <!--=== BAGIAN PETUGAS ===-->
        <?php elseif ($role == 'petugas') : ?>
           
            <div class="fixed top-0 left-0 w-full h-full bg-black/0 z-40 md:hidden sidebar-overlay"></div>

<main class="w-full bg-[#E8E6F2] min-h-screen transition-all main">
    <nav style="box-shadow: 0px 4px 31.5px 0px rgba(0, 0, 0, 0.07);" class="h-[70px] px-6 bg-white flex items-center z-40 sticky top-0 left-0">
       
         <button id="menuButton" type="button" class="text-lg text-gray-600 sidebar-toggle block md:hidden">
            <i class="ri-menu-line"></i>
        </button>

        <div class="flex relative  items-center ml-5 gap-1 text-[#505050]">
        <img class="h-7 mr-2" src="./assets/logo.png">
        </div>


        <div id="menuList" class="hidden md:flex ml-5 gap-4 text-[#505050]">
             <a href="./dashboard.php" class="text-gray-600 font-medium hover:text-gray-900">Dashboard</a>
             <a href="./dataCustomer.php" class="text-gray-600 font-medium hover:text-gray-900">Data Customer</a>
             <a href="./dataMenu.php" class="text-gray-600 font-medium hover:text-gray-900">Daftar Menu</a>
        </div>

        <span id="dropdownToggle" class="relative flex items-center ml-auto mr-5 cursor-pointer">
        <i class='bx bxs-user-circle text-4xl text-gray-600'></i>
        <i id="dropdownIcon" class='bx bx-chevron-down text-2xl text-gray-600'></i>
    </span>

 <!-- Dropdown menu -->
 <div id="dropdownMenu" class="hidden absolute right-2 mt-40 w-48 bg-white border border-gray-200 rounded-md shadow-md z-50">
<p class="text-gray-600 flex py-2 justify-center font-medium text-sm"><?php echo $role == 'administrator' ? 'Administrator' : 'Petugas'; ?></p>
<hr>

<a id="logoutButton" class="flex justify-center py-2 cursor-pointer items-center">
    <i class='bx bx-log-out text-gray-600 font-medium text-lg mr-2'></i>
    <span class="text-gray-600 text-sm font-medium">Logout</span>
</a>
</div>
    
    </nav>

        <!-- bagian content -->
        <div class="w-2/3 mx-auto">

 <!-- ==== tambah data ==== -->
 <div id="addForm2" class="fixed z-20 inset-0 overflow-y-auto  bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg mt-20 z-50 shadow-xl max-w-md w-full p-5 max-h-[80vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-600">Tambah Customer</h2>
                <button onclick="toggleForm2()" class="text-gray-600 hover:text-gray-800 text-xl focus:outline-none">
                <i class='bx bx-x'></i>
                </button>
            </div>

            <form action="./crud/tambah_customer.php"  method="POST" enctype="multipart/form-data" class="space-y-4">
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col gap-2">
                        <label for="namaPelanggan" class="font-medium text-gray-500">Nama Customer</label>
                        <input type="text" name="namaPelanggan" required class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 font-medium border-gray-300 rounded-md w-full p-2">

                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col gap-2">
                        <label for="alamat" class="font-medium text-gray-500">Alamat</label>
                        <textarea name="alamat" required class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 font-medium border-gray-300 rounded-md w-full p-2"></textarea>
                    </div>
                </div>


                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col gap-2">
                        <label for="nomerTelepon" class="font-medium text-gray-500">WA / HP</label>
                        <input type="text" name="nomerTelepon" required value="+62" class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 font-medium border-gray-300 rounded-md w-full p-2">

                    </div>
                </div>

                <button type="submit"  class="bg-[#06AF81] hover:bg-[#31BF98] text-white font-semibold py-2 px-4 rounded-md">Simpan</button>
            </form>
        </div>
    </div>
    <!-- ==== end ==== -->

    <div class="button-container flex justify-between relative top-20 flex-col md:flex-row">
            <!-- Tombol "Cetak PDF" -->
                  <a href="./cetak.php" target="_blank" class="bg-[#06AF81] text-white px-4 py-3 hover:bg-[#31BF98] font-medium text-sm rounded-md flex items-center mb-2 md:mb-0">
                    <i class='bx bxs-file-pdf'></i>
                    <span class="ml-2">Cetak PDF</span>
                </a>

            <!-- Tombol "Tambah Customer" -->
            <button onclick="toggleForm2()" class="bg-[#06AF81] text-white px-4 py-3 hover:bg-[#31BF98] font-medium text-sm rounded-md flex items-center">
                <i class='bx bx-user-plus text-xl'></i>
                <span class="ml-2">Tambah Menu</span>
            </button>
        </div>
        <!-- end -->

        <div class="w-full bg-white h-auto mx-auto mt-24 rounded-lg">
<div class="bg-gray-800 text-white py-4 px-6 flex items-center gap-4 rounded-t-lg">
<i class='bx bx-user'></i>
<h1 class="text-1xl font-medium">Daftar Customer</h1>
</div>

<div class="overflow-x-scroll mx-5 mt-5">

<table id="barangTable" class="table-auto  w-full mx-10 border-collapse">
    <thead>
    <tr class=" text-[#595959] font-medium text-sm">
            <th class="px-4 border border-[#8E8E8E] py-2">No</th>
            <th class="px-4 border border-[#8E8E8E] text-start py-2">Nama Customer</th>
            <th class="px-4 border border-[#8E8E8E] text-start py-2">Alamat</th>
            <th class="px-4 border border-[#8E8E8E] text-start py-2">WA/HP</th>
            <th class="px-4 border border-[#8E8E8E] py-2">Action</th>
        </tr>
    </thead>
    <tbody>
     
         <?php
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='" . ($no % 2 === 0 ? 'even:bg-[#e8e6f2ff]' : 'odd:bg-white') . "'>";
                        echo "<td class='border border-[#8E8E8E] border-b-0 font-medium text-[#616161] text-sm px-4 text-center py-2'>" . $no . "</td>";
                        echo "<td class='border border-[#8E8E8E] border-b-0 font-medium text-[#616161] text-sm px-4 py-2 text-center'>" . $row['namaPelanggan'] . "</td>";
                        echo "<td class='border border-[#8E8E8E] border-b-0 font-medium text-[#616161] text-sm px-4  py-2'>" . $row['alamat'] . "</td>";
                        echo "<td class='border border-[#8E8E8E] border-b-0 font-medium text-[#616161] text-sm px-4  py-2'>" . $row['nomerTelepon'] . "</td>";
                        echo "<td class='border border-[#8E8E8E] border-b-0 font-medium text-[#616161] text-lg text-center px-4 py-2'>
                        <a onclick='hapusCustomer(" . $row['pelangganID'] . ")'> 
                        <i class='bx bx-trash bg-red-500/40 p-1 rounded-sm cursor-pointer hover:bg-red-500/50 text-red-500'></i> 
                        </a>

                       </td>";
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
</div>

</div>


    <?php endif; ?>
    <!-- end -->

    <br>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<script src="./function/hapusCustomer.js"></script>

<script src="./function/waktu.js"></script>
<script src="./function/gantiMenu.js"></script>
<script src="./function/logoutAllert.js"></script>
<script src="./function/main.js"></script>


</html>
