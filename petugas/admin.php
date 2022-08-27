<?php 
session_start();
require "../functions/functions.php";

if(!isset($_SESSION["level"]) || $_SESSION["level"] != "admin") {
    header("Location: login.php");
}

$result = query("SELECT * FROM petugas WHERE id_petugas = {$_SESSION['id']}")[0];
$pembayaran = query("SELECT * FROM pembayaran");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>Halo Admin, <?= $result["nama_petugas"] ?></h1>
    <a href="logout.php">Logout</a>
    <a href="data-petugas.php">Daftar Petugas</a>
    <a href="data-siswa.php">Daftar Siswa</a>
    <a href="data-kelas.php">Daftar Kelas</a>
    <a href="data-spp.php">Daftar SPP</a>
    <a href="data-riwayat.php">Daftar Riwayat Pembayaran</a>
</body>
</html>