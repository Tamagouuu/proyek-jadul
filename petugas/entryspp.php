<?php
session_start();  
require "../functions/functions.php";


if(!isset($_SESSION["level"]) == "admin" || !isset($_SESSION["level"]) == "petugas" ) {
    header("Location: login.php");
}


if(isset($_POST["submit"])) {
    if(entrySpp($_POST) > 0) {
        echo "<script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'admin.php';
              </script>";
    } else
        echo "<script>alert('Data Tidak Berhasil Ditambahkan')</script>";
}

$siswa = query("SELECT * FROM siswa");
$spp = query("SELECT * FROM spp");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Kelas</title>
    <style>
        ul {
            list-style: none;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $_SESSION["id"] ?>">
        <ul>
            <li>
                <h1>Entry SPP</h1>
            </li>
            <li>
                <label for="nisn">NISN :</label>
                <select name="nisn" id="nisn">
                    <?php foreach($siswa as $data) : ?>
                        <option value="<?= $data["nisn"] ?>"><?= $data["nisn"] ?></option>
                    <?php endforeach; ?>
                </select>
            </li>   
            <li>
                <label for="tgl">Tanggal Pembayaran:</label>
                <input type="date" name="tgl" id="tgl" required>
            </li>
            <li>
                <label for="bulan">Bulan Dibayar:</label>
                <input type="text" name="bulan" id="bulan" required>
            </li>
            <li>
                <label for="tahun">Tahun Dibayar:</label>
                <input type="text" name="tahun" id="tahun" required>
            </li>
            <li>
                <label for="spp">SPP :</label>
                <select name="spp" id="spp">
                    <?php foreach($spp as $data) : ?>
                        <option value="<?= $data["id_spp"] ?>"><?= "{$data["tahun"]} - {$data["nominal"]}" ?></option>
                    <?php endforeach ?>
                </select>
            </li>
            <li>
                <label for="bayar">Jumlah Dibayar :</label>
                <input type="text" name="bayar" id="bayar" required>
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>
</body>
</html>