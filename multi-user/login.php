<?php
session_start();
// code di bawah untuk mengambil koneksi untuk menyambungkan ke database
require_once "../function/konek.php";

// jika koneksi ke database error maka muncul error pada bagian session
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : '';
unset($_SESSION["error"]);

// kondisi di bawah ini mengecek apakah request yang diterima oleh server merupakan POST request. 
// $_SERVER["REQUEST_METHOD"] adalah variabel global dalam PHP yang berisi metode HTTP yang digunakan 
// untuk mengirim request ke halaman tersebut jika metodenya adalah POST maka blok kode di dalam kurung kurawal akan dieksekusi.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

// code di bawah untuk mengambil isi dari tb_petugas di colom username dan password  
    $sql = "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'";
    $result = $koneksi->query($sql);

    // mengecek jika object result memiliki lebih dari 0 baris maka code yang di dalam kurung kurawal akan di eksekusi
    // 
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // menyimpan nilai dari kolom id_petugas dan role 
        $_SESSION["idPetugas"] = $row["idPetugas"];
        $_SESSION["role"] = $row["role"];

        // jika id petugas dan role benar maka akan pergi ke halaman dashboard
        header("Location: ../dashboard.php");
        exit();
        // jika role dan username yang di inputkan salah maka akan muncul alert eror seperti di bawah
    } else {
        $_SESSION["error"] = "Username atau password salah!";
        // dan akan ke halaman login lagi
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="stylesheet" href="../input.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="../assets/iconTittle.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/iconTitle.png" type="image/x-icon">

    <title>Login</title>
</head>

<body style="font-family: 'Montserrat', sans-serif;" class="bg-[#E8E6F2]">
<section>
    <div class="flex flex-col items-center justify-center h-screen mx-2 md:mx-12">
        <div class="flex justify-center w-full h-[30rem]">
            <div style="box-shadow: 0px 0px 100px 0px rgba(0, 0, 0, 0.15);" class="w-full md:w-1/2 bg-white rounded-2xl p-6"> 
                <form class="space-y-4 md:space-y-6 " action="login.php" method="post">
                    <img class="w-25 h-10 mr-2" src="../assets/logo.png">

                    <div class="top-3 relative">
                        <span class="flex  flex-col justify-center mx-auto items-start">
                            <h1 class="flex items-start font-bold text-[#656565] text-3xl">Log in.</h1>
                            <p class="text-[#656565]">Log in menggunakan username dan password anda</p>
                        </span>
                        
                        <div class="flex flex-col gap-3 md:ml-16 md:mr-20 mt-5"> 

                            <span class="flex-col flex justify-center gap-1">
                                <label for="username" class="font-semibold text-[#656565]">Username</label>
                                <input type="text" name="username" class="border-2 w-full py-1 border-gray-500 px-3 rounded-lg" required>
                            </span>

                            <div class="flex-col flex justify-center gap-1 relative">
                                <label for="password" class="font-semibold text-[#656565]">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" class="border-2 w-full py-1 border-gray-500 px-3 pr-10 rounded-lg" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="border-2 w-full text-white font-semibold py-2 mt-2 border-gray-500 px-3 rounded-lg bg-[#06AF81] hover:bg-[#31BF98] transition-opacity">LOGIN</button>
                            <div id="error-message" class="text-red-500 mt-1 flex justify-center">
                                <?php echo isset($error) ? $error : ''; ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



</body>

</html>