<?php
// untuk memulai session saat login
session_start();
session_unset();
// untuk menghentikan session login dan pergi ke halaman login.php
session_destroy();
// ketika login session di hentikan maka akan ke direct ke halaman login.php
header("Location: login.php");
exit();

