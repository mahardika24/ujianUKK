<?php
session_start();

if (!isset($_SESSION["idPetugas"])) {
    header("Location: ../multi-user/login.php");
    exit();
}

require_once "./function/konek.php";

$id_petugas = $_SESSION["idPetugas"];
$role = $_SESSION["role"];

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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <link rel="shortcut icon" href="./assets/iconTitle.png" type="image/x-icon">


    <title>Kasir</title>
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
                 <a href="./Kasir.php" class="text-gray-600 font-medium hover:text-gray-900">Kasir</a>
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
            <div class="w-[95%] flex md:flex-row flex-col gap-6 mx-auto">

            <!-- form data menu -->
            <div class="w-full bg-white h-auto mt-24 rounded-lg">
    <div class="bg-gray-800 text-white py-4 px-6 flex items-center gap-4 rounded-t-lg">
        <i class='bx bx-data'></i>
        <h1 class="text-1xl font-medium">Data Menu</h1>
    </div>
    <div class="overflow-x-scroll max-h-[40rem] mx-5 mt-5">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="bg-white cursor-pointer hover:bg-orange-400 border border-gray-200 rounded-md shadow-sm p-4">
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

<!-- menu data customer -->

<!-- end -->

<!-- end -->

<div class="md:w-2/3 w-full bg-white h-auto mx-auto mt-0 sm:mt-24 rounded-lg">
    <div class="bg-gray-800 text-white py-4 px-6 flex items-center gap-4 rounded-t-lg">
        <i class='bx bx-cart' ></i>
        <h1 class="text-1xl font-medium">Keranjang</h1>
    </div>
    <div class="overflow-x-scroll mx-5 mt-5">
        <!-- Form Keranjang -->
        <form>
            <div class="flex flex-col gap-5 justify-center"> 
                <div class="flex items-center gap-7">
                    <label for="editStok" class="font-medium text-gray-500">No Bon</label>
                    <input type="text" name="stok" required class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 font-medium border-gray-300 rounded-md w-3/4 p-2">
                </div>
                <div class="flex items-center gap-2">
                    <label for="editStok" class="font-medium text-gray-500">Customer</label>
                    <div class="relative w-3/4">
                        <div class="flex">
                            <input type="text" name="stok" required class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 font-medium border-gray-300 rounded-s-md w-full p-2 pl-10">
                            <button id="searchButton" type="button" class="bg-[#06AF81] text-white px-4 rounded-r-md hover:bg-[#31BF98]">Cari</button>
                        </div>
                    </div>
                </div>




            </div>
            <button type="button" class="mt-4 bg-[#06AF81] hover:bg-[#31BF98] text-white font-semibold py-2 px-4 mb-4 rounded-md w-full">
                <i class='bx bx-save mr-2'></i>
                Simpan Transaksi
            </button>
        </form>
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
             <a href="./Kasir.php" class="text-gray-600 font-medium hover:text-gray-900">Kasir</a>
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
        <div class="w-[95%] flex md:flex-row flex-col gap-6 mx-auto">

        <!-- form data menu -->
        <div class="w-full bg-white h-auto mt-24 rounded-lg">
<div class="bg-gray-800 text-white py-4 px-6 flex items-center gap-4 rounded-t-lg">
    <i class='bx bx-data'></i>
    <h1 class="text-1xl font-medium">Data Menu</h1>
</div>
<div class="overflow-x-scroll max-h-[40rem] mx-5 mt-5">
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="bg-white cursor-pointer hover:bg-orange-400 border border-gray-200 rounded-md shadow-sm p-4">
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

<!-- menu data customer -->

<!-- end -->

<!-- end -->

<div class="md:w-2/3 w-full bg-white h-auto mx-auto mt-0 sm:mt-24 rounded-lg">
<div class="bg-gray-800 text-white py-4 px-6 flex items-center gap-4 rounded-t-lg">
    <i class='bx bx-cart' ></i>
    <h1 class="text-1xl font-medium">Keranjang</h1>
</div>
<div class="overflow-x-scroll mx-5 mt-5">
    <!-- Form Keranjang -->
    <form>
        <div class="flex flex-col gap-5 justify-center"> 
            <div class="flex items-center gap-7">
                <label for="editStok" class="font-medium text-gray-500">No Bon</label>
                <input type="text" name="stok" required class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 font-medium border-gray-300 rounded-md w-3/4 p-2">
            </div>
            <div class="flex items-center gap-2">
                <label for="editStok" class="font-medium text-gray-500">Customer</label>
                <div class="relative w-3/4">
                    <div class="flex">
                        <input type="text" name="stok" required class="focus:border-gray-500 focus:outline-none border-2 text-gray-600 font-medium border-gray-300 rounded-s-md w-full p-2 pl-10">
                        <button id="searchButton" type="button" class="bg-[#06AF81] text-white px-4 rounded-r-md hover:bg-[#31BF98]">Cari</button>
                    </div>
                </div>
            </div>




        </div>
        <button type="button" class="mt-4 bg-[#06AF81] hover:bg-[#31BF98] text-white font-semibold py-2 px-4 mb-4 rounded-md w-full">
            <i class='bx bx-save mr-2'></i>
            Simpan Transaksi
        </button>
    </form>
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

<script src="./function/hapusAllert.js"></script>
<script src="./function/editMenu.js"></script>

<script src="./function/waktu.js"></script>
<script src="./function/logoutAllert.js"></script>
<script src="./function/main.js"></script>

</html>
