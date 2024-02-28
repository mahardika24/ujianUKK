<?php
// memanggil fungsi koneksi untuk menyambungkan ke database
require_once "../function/konek.php";
// variable di bawah berfungsi untuk menyimpan atau menampung data nilai pesan ketika register berhasil
$registrationMessage = ''; 

// kondisi di bawah ini mengecek apakah request yang diterima oleh server merupakan POST request. 
// $_SERVER["REQUEST_METHOD"] adalah variabel global dalam PHP yang berisi metode HTTP yang digunakan 
// untuk mengirim request ke halaman tersebut jika metodenya adalah POST maka blok kode di dalam kurung kurawal akan dieksekusi.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_petugas = $_POST['namaPetugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // code di bawah ialah membuat variable unikID yang memanggil fungsi bawaan dari php yang bernama uniqid
    // yang di mana berfungsi untuk generate id secara uniq
    $unikID = uniqid();

    // code di bawah ini untuk mengisi baris baru ke dalam table tb_petugas dengan values ? yang digunakan 
    // untuk menandai posisi di mana nilai yang sebenarnya akan dimasukkan nantinya
    $query = "INSERT INTO petugas (idPetugas, namaPetugas, username, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
  

    mysqli_stmt_bind_param($stmt, "sssss", $unikID, $nama_petugas, $username, $password, $role);
// menyimpan nilai statement di variable yg bernama result
    $result = mysqli_stmt_execute($stmt);

    // jika result bernilai true maka variable registrationMessage menampilkan register berhasil dan dapat 
    // menyimpan data ke dalam db
    if ($result) {
        $registrationMessage = "Registrasi berhasil";
    
        // sebaliknya jika bernilai false maka menampilkan registergagal
    } else {
        $registrationMessage = "Registrasi gagal. Silakan coba lagi.";
    }

    // menutup fungsi statement
    mysqli_stmt_close($stmt);
}
// menutup fungsi koneksi dari database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="stylesheet" href="../input.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" href="../assets/iconTittle.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../assets/iconTitle.png" type="image/x-icon">


    <title>Registrasi Petugas</title>
</head>
<body style="font-family: 'Montserrat', sans-serif;" class="bg-[#E8E6F2]">
<section>
    <div class="flex flex-col items-center justify-center min-h-screen mx-4 md:mx-12">
        <div class="flex justify-center w-full h-auto">
            <div class="w-full md:w-1/2 bg-white rounded-2xl p-6 shadow-xl">
                <form class="space-y-4 md:space-y-6" method="post">
                    <img class="h-10 mr-2" src="../assets/logo.png">

                    <div class="relative">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col sm:flex-row sm:gap-4">
                                <div class="flex flex-col w-full">
                                    <label for="namaPetugas" class="font-semibold text-[#656565]">Nama petugas</label>
                                    <input type="text" name="namaPetugas" class="border-2 w-full py-1 border-gray-500 px-3 rounded-lg" required>
                                </div>
                                <div class="flex flex-col w-full">
                                    <label for="username" class="font-semibold text-[#656565]">Username</label>
                                    <input type="text" name="username" class="border-2 w-full py-1 border-gray-500 px-3 rounded-lg" required>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label for="password" class="font-semibold text-[#656565]">Password</label>
                                <input type="password" name="password" class="border-2 w-full py-1 border-gray-500 px-3 rounded-lg" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="role" class="font-semibold text-[#656565]">Role</label>
                                <select class="border-2 w-full py-1 border-gray-500 px-3 rounded-lg" name="role" required>
                                    <option value="administrator">Administrator</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>
                        </div>

                        <input type="submit" value="Register" class="border-2 w-full text-white font-semibold py-2 mt-4 border-gray-500 px-3 rounded-lg bg-[#06AF81] hover:bg-[#31BF98] transition-opacity">
                        <h1 class="font-medium text-[#656565] text-center">Tidak punya akun?<a href="login.php"><span class="font-semibold text-[#E7A92F] pl-2 cursor-pointer hover:underline">Login</span></a></h1>

                        <div class="text-green-500 text-center">
                            <?php echo $registrationMessage; ?>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</section>

</body>
</html>
