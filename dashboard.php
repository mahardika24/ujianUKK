<?php
session_start();

if (!isset($_SESSION["idPetugas"])) {
    header("Location: ../multi-user/login.php");
    exit();
}

require_once "./function/konek.php";

$id_petugas = $_SESSION["idPetugas"];
$role = $_SESSION["role"];
$query_produk = "SELECT COUNT(*) AS total_produk FROM produk";
$result_produk = mysqli_query($koneksi, $query_produk);

if (!$result_produk) {
    echo "Error: " . mysqli_error($koneksi);
    exit();
}

$row_produk = mysqli_fetch_assoc($result_produk);
$total_produk = $row_produk['total_produk'];

$query_pelanggan = "SELECT COUNT(*) AS total_pelanggan FROM pelanggan";
$result_pelanggan = mysqli_query($koneksi, $query_pelanggan);

if (!$result_pelanggan) {
    echo "Error: " . mysqli_error($koneksi);
    exit();
}

$row_pelanggan = mysqli_fetch_assoc($result_pelanggan);
$total_pelanggan = $row_pelanggan['total_pelanggan'];


$query = "SELECT produkID, namaProduk, harga, stok, gambar FROM produk";
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

    <title>Dashboard</title>
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
                 <a href="./dataMenu.php" class="text-gray-600 font-medium hover:text-gray-900">Daftar Menu </a>

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

            <!-- bagian dashboard content -->

            <section class="w-3/4 mt-16 mx-auto px-4 grid gap-6 md:grid-cols-2 lg:grid-cols-2">

                <div class="bg-white rounded-lg shadow-lg">
                    <div class="py-3 rounded-t-lg px-5 bg-[#058C67] text-white">
                        <h2 class="text-lg font-semibold ">Menu</h2>
                    </div>
                    <div class="px-6 text-center py-7">
                    <p class="text-2xl text-gray-800 font-medium"><?php echo $total_produk; ?></p>
                    </div>
                      <a href="./dataMenu.php" class="border-t border-gray-300 rounded-b-lg bg-slate-100  px-6 flex items-center gap-1 text-blue-500 cursor-pointer  justify-center py-4">
                        <p class="text-base hover:underline font-medium">Lihat Selengkapnya</p>
                        <i class='bx bx-right-arrow-alt text-xl'></i>
                      </a>
                </div>
                <div class="bg-white rounded-lg shadow-lg">
                    <div class="py-3 rounded-t-lg px-5 bg-[#058C67] text-white">
                        <h2 class="text-lg font-semibold ">Customer</h2>
                    </div>
                    <div class="px-6 text-center py-7">
                    <p class="text-2xl text-gray-800 font-medium"><?php echo $total_pelanggan; ?></p>
                    </div>
                    <a href="./dataCustomer.php" class="border-t rounded-b-lg border-gray-300 bg-slate-100  px-6 flex items-center gap-1 text-blue-500 cursor-pointer  justify-center py-4">
                        <p class="text-base hover:underline font-medium">Lihat Selengkapnya</p>
                        <i class='bx bx-right-arrow-alt text-xl'></i>
                    </a>
                </div>

        </section>

        <div class="w-3/4 bg-white h-auto mx-auto mt-24 rounded-lg">
    <div class="bg-gray-800 text-white py-4 px-6 flex items-center gap-4 rounded-t-lg">
    <i class='bx bx-food-menu'></i>
    <h1 class="text-1xl font-medium">Daftar Menu</h1>
    </div>

    <div class="overflow-x-scroll mx-5 mt-5">
    <table id="barangTable" class="table-auto  w-full mx-10 border-collapse">
        <thead>
        <tr class=" text-[#595959] font-medium text-sm">
                <th class="px-4 border border-[#8E8E8E] py-2">No</th>
                <th class="px-4 border border-[#8E8E8E] py-2">Nama Menu</th>
                <th class="px-4 border border-[#8E8E8E] py-2">Harga</th>
                <th class="px-4 border border-[#8E8E8E] py-2">Stok</th>
                <th class="px-4 border border-[#8E8E8E] py-2">Action</th>
            </tr>
        </thead>
        <tbody>
         
            </tbody>

    </table>
    </div>
    </div>

            <!-- end -->

        </main>   

      

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

        <!-- bagian dashboard content -->

        <section class="w-3/4 mt-16 mx-auto px-4 grid gap-6 md:grid-cols-2 lg:grid-cols-2">

            <div class="bg-white rounded-lg shadow-lg">
                <div class="py-3 rounded-t-lg px-5 bg-[#058C67] text-white">
                    <h2 class="text-lg font-semibold ">Menu</h2>
                </div>
                <div class="px-6 text-center py-7">
                <p class="text-2xl text-gray-800 font-medium"><?php echo $total_produk; ?></p>
                </div>
                  <a href="./dataMenu.php" class="border-t border-gray-300 rounded-b-lg bg-slate-100  px-6 flex items-center gap-1 text-blue-500 cursor-pointer  justify-center py-4">
                    <p class="text-base hover:underline font-medium">Lihat Selengkapnya</p>
                    <i class='bx bx-right-arrow-alt text-xl'></i>
                    
                  </a>
            </div>
            <div class="bg-white rounded-lg shadow-lg">
                <div class="py-3 rounded-t-lg px-5 bg-[#058C67] text-white">
                    <h2 class="text-lg font-semibold ">Customer</h2>
                </div>
                <div class="px-6 text-center py-7">
                <p class="text-2xl text-gray-800 font-medium"><?php echo $total_pelanggan; ?></p>
                </div>
                <a href="./dataCustomer.php" class="border-t rounded-b-lg border-gray-300 bg-slate-100  px-6 flex items-center gap-1 text-blue-500 cursor-pointer  justify-center py-4">
                    <p class="text-base hover:underline font-medium">Lihat Selengkapnya</p>
                    <i class='bx bx-right-arrow-alt text-xl'></i>
                </a>
            </div>

    </section>

    <div class="w-3/4 bg-white h-auto mx-auto mt-24 rounded-lg">
<div class="bg-gray-800 text-white py-4 px-6 flex items-center gap-4 rounded-t-lg">
<i class='bx bx-food-menu'></i>
<h1 class="text-1xl font-medium">Daftar Menu</h1>
</div>

<div class="overflow-x-scroll mx-5 mt-5">
<table id="barangTable" class="table-auto  w-full mx-10 border-collapse">
    <thead>
    <tr class=" text-[#595959] font-medium text-sm">
            <th class="px-4 border border-[#8E8E8E] py-2">No</th>
            <th class="px-4 border border-[#8E8E8E] py-2">Nama Menu</th>
            <th class="px-4 border border-[#8E8E8E] py-2">Harga</th>
            <th class="px-4 border border-[#8E8E8E] py-2">Stok</th>
            <th class="px-4 border border-[#8E8E8E] py-2">Action</th>
        </tr>
    </thead>
    <tbody>
     
        </tbody>

</table>
</div>
</div>

        <!-- end -->

    </main>   

  <!-- ==== BAGIAN KASIR ==== -->

    <?php elseif ($role == 'kasir') : ?>

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
             <a href="./dashboard.php" class="text-gray-600 font-medium hover:text-gray-900">Penjualan</a>
        </div>

        <span id="dropdownToggle" class="relative flex items-center ml-auto mr-5 cursor-pointer">
        <i class='bx bxs-user-circle text-4xl text-gray-600'></i>
        <i id="dropdownIcon" class='bx bx-chevron-down text-2xl text-gray-600'></i>
    </span>

 <!-- Dropdown menu -->
        <div id="dropdownMenu" class="hidden absolute right-2 mt-40 w-48 bg-white border border-gray-200 rounded-md shadow-md z-50">
        <p class="text-gray-600 flex py-2 justify-center font-medium text-sm"><?php echo $role == 'administrator' ? 'Administrator' : ($role == 'petugas' ? 'Petugas' : 'Kasir'); ?></p>

        <hr>

        <a id="logoutButton" class="flex justify-center py-2 cursor-pointer items-center">
            <i class='bx bx-log-out text-gray-600 font-medium text-lg mr-2'></i>
            <span class="text-gray-600 text-sm font-medium">Logout</span>
        </a>
        </div>
    </nav>

        <!-- bagian  content -->
        <div class="w-[95%] flex md:flex-row flex-col gap-6 mx-auto">

<!-- form data menu -->
<div class="w-full bg-white h-auto mt-24 rounded-lg">
<div class="bg-gray-800 text-white py-4 px-6 flex items-center gap-4 rounded-t-lg">
<i class='bx bx-data'></i>
<h1 class="text-2xl font-medium">Data Menu</h1>
<div id="forDebug">

</div>
</div>
<div class="overflow-x-scroll max-h-[40rem] mx-5 mt-5">
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
<?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <div class="bg-white cursor-pointer hover:bg-slate-100 border border-gray-200 rounded-md shadow-sm p-4" onclick="tampilkanDataProduk('<?php echo $row['namaProduk']; ?>', '<?php echo $row['harga']; ?>', '<?php echo $row['stok']; ?>')">
    <?php
    $base64Image = $row['gambar'];
    $imageSrc = 'data:image/jpeg;base64,' . $base64Image;
    ?>

    <img src="<?php echo $imageSrc; ?>" alt="<?php echo $row['namaProduk']; ?>" class="w-full h-32 object-cover mb-4">
    
    <h3 class="text-lg text-gray-700 font-semibold"><?php echo $row['namaProduk']; ?></h3>
    <p class="text-gray-600 font-medium">Harga: <?php echo $row['harga']; ?></p>
    <p class="text-gray-600">Stok: <?php echo $row['stok']; ?></p>
</div>
<?php endwhile; ?>
</div>
</div>

</div>


<!-- batas -->

<div class="md:w-2/3 w-full bg-white h-auto mx-auto mt-0 sm:mt-24 rounded-lg">
<div class="bg-gray-800 text-white py-4 px-6 flex items-center gap-4 rounded-t-lg">
<i class='bx bx-cart' ></i>
<h1 class="text-1xl font-medium">Keranjang</h1>
</div>
<div class="overflow-x-scroll mx-5 mt-5">
<!-- Form Keranjang -->

<form action="./crud/tambahKasir.php" method="post">
<div class="flex flex-col gap-5 justify-center"> 
<p class="text-red-500 font-medium text-xs ">* Untuk Customer yang sudah terdaftar pada sistem</p>
    <div class="flex items-center gap-4">
        <label for="pelangganID" class="font-medium text-gray-500">Customer</label>
        <div class="relative w-3/4">
            <div class="flex">
            <input type="text" name="pelangganID" id="customerInput" placeholder="Nama Customer"  class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 border-gray-300 rounded-s-md w-full p-2 pl-1">
                <button id="searchCustomerButton" type="button" class="bg-[#06AF81] text-white px-4 rounded-r-md hover:bg-[#31BF98]">Cari</button>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <label  class="font-medium text-gray-500">Atas Nama</label>
        <div class="relative w-3/4">
            <div class="flex">
                <input type="text"  placeholder="Atas Nama" class="focus:border-gray-500 focus:outline-none border-2 text-gray-600  border-gray-300 rounded-md w-full p-2 pl-1">
            </div>
        </div>
    </div>


    <div class="overflow-x-scroll mx-1 mt-5">
       <span class="flex items-center gap-1 mb-2">
           <i class='bx bx-cart-alt'></i>
           <p class="text-sm text-gray-600 font-medium">List Keranjang</p>
       </span> 
    <table id="tabelKeranjang" class="border-collapse w-full">
        <thead>
            <tr>
                <th class="border text-xs border-x-0 border-gray-300 px-3 text-start font-semibold py-2">No</th>
                <th class="border text-xs border-x-0 border-gray-300 text-start px-3 font-semibold py-2">Nama</th>
                <th class="border text-xs border-x-0 border-gray-300 text-center px-3 font-semibold py-2">Qty</th>
                <th class="border text-xs border-x-0 border-gray-300 text-start px-3 font-semibold py-2">Harga</th>
                <th class="border text-xs border-x-0 border-gray-300 text-center px-3 font-semibold py-2">#</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="flex items-center gap-4">
        <label for="tanggalPenjualan" class="font-medium text-gray-500">Tanggal</label>
        <div class="relative w-3/4">
            <div class="flex">
            <input type="date" name="tanggalPenjualan" id="tanggalPenjualan"  class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 border-gray-300 rounded-md w-full p-2 pl-1">
            </div>
        </div>
    </div>

    <div class="flex items-center gap-10">
    <label for="totalHarga" class="font-medium text-gray-500">Total</label>
    <div class="relative w-3/4">
        <div class="absolute inset-y-0 left-0 flex items-center border-2 border-gray-300 justify-center bg-gray-200 rounded-l-md px-2">
            <span class="text-gray-600 font-medium">Rp</span>
        </div>
        <input type="number" name="totalHarga" id="totalHarga" value="0" class="focus:border-gray-500  focus:outline-none border-2 text-gray-600 border-gray-300 rounded-md w-full p-2 pl-12 " disabled >
    </div>
</div>









</div>
<button type="button" onclick="simpanTransaksi()" class="mt-4 bg-[#06AF81] hover:bg-[#31BF98] text-white font-semibold py-2 px-4 mb-4 rounded-md w-full">
    <i class='bx bx-save mr-2'></i>
    Simpan Transaksi
</button>
</form>
</div>
</div>

</div>

<!-- Float element -->
<div id="floatMenu" class="hidden fixed top-1/2 z-50 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4  rounded-md shadow-md">
    <div class="flex justify-between items-center mb-4">
        <span class="flex items-center gap-1">
            <i class='bx bx-group font-bold text-xl text-[#333333ff]' ></i>
            <h2 class="text-[#333333ff] font-semibold">Data Pelanggan</h2>
        </span>
        <button id="closeButton" class=" p-2">
            <i class="bx bx-x text-gray-600 text-2xl"></i>
        </button>
    </div>
    <div class="overflow-x-auto ">
        <table class="border-collapse w-full">
            <thead>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">No</th>
                    <th class="border border-gray-400 text-start px-4 py-2">Nama</th>
                    <th class="border border-gray-400 text-start px-4 py-2">alamat</th>
                    <th class="border border-gray-400 text-start px-4 py-2">No/WA</th>
                    <th class="border border-gray-400 text-start px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query_pelanggan = "SELECT * FROM pelanggan";
                $result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
                if (!$result_pelanggan) {
                    echo "Error: " . mysqli_error($koneksi);
                    exit();
                }

                $counter = 1;

                while ($row_pelanggan = mysqli_fetch_assoc($result_pelanggan)) {
                    echo "<tr>";
                    echo "<td class='border border-gray-400  px-4 py-2'>" . $counter++ . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $row_pelanggan['namaPelanggan'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $row_pelanggan['alamat'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $row_pelanggan['nomerTelepon'] . "</td>";
                    echo "<td class='border border-[#8E8E8E] font-medium text-[#616161] text-lg text-center px-4 py-2'>
                    <a onclick='addPelanggan(\"" . $row_pelanggan['namaPelanggan'] . "\", \"" . $row_pelanggan['pelangganID'] . "\")'> 
                        <i class='bx bxs-user-plus bg-green-500/40 p-1 rounded-sm cursor-pointer hover:bg-green-500/50 text-green-500'></i> 
                        </a>
                        </td>";
                    echo "</tr>";
                }
                
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Overlay hitam -->
<div id="overlay" class="hidden fixed top-0 left-0 w-full h-full bg-black opacity-50 z-40"></div>


    <?php endif; ?>
    <!-- end -->

    

    <br>
</body>
<script src="sweetalert.min.js"></script>
<script src="./function/waktu.js"></script>
<script src="./function/gantiMenu.js"></script>
<script src="./function/logoutAllert.js"></script>
<script src="./function/main.js"></script>
<script src="./function/kasir.js"></script>


</html>
