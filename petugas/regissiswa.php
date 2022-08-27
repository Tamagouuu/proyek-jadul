<?php
session_start();  
require "../functions/functions.php";


if(!isset($_SESSION["level"]) || $_SESSION["level"] != "admin") {
    header("Location: login.php");
}

if(isset($_POST["submit"])) {
    if(regisSiswa($_POST) > 0) {
        echo "<script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'admin.php';
              </script>";
    } else
        echo "<script>alert('Data Tidak Berhasil Ditambahkan')</script>";
}

$spp = query("SELECT * FROM spp");
$kelas = query("SELECT * FROM kelas");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Siswa</title>
    <style>
        ul {
            list-style: none;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <ul>
            <li>
                <h1>REGISTER SISWA</h1>
            </li>
            <li>
                <label for="nisn">NISN :</label>
                <input type="text" name="nisn" id="nisn">   
            </li>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="nis">NIS :</label>
                <input type="text" name="nis" id="nis">
            </li>
            <li>
                <label for="idkelas">Kelas :</label>
                <select name="idkelas" id="idkelas">
                    <?php foreach($kelas as $data) : ?>
                        <option value="<?= $data["id_kelas"] ?>"><?= $data["nama_kelas"] ?></option>
                    <?php endforeach; ?>
                </select>
            </li>
            <li>
                <label for="alamat">Alamat :</label>
                <input type="text" name="alamat" id="alamat">
            </li>
            <li>
                <label for="telp">No. Telp</label>
                <input type="text" name="telp" id="telp">
            </li>   
            <li>
                <label for="spp">SPP : </label>
                <select name="spp" id="spp">
                    <?php foreach($spp as $data) : ?>
                        <option value="<?= $data["id_spp"] ?>"><?= "{$data["tahun"]} - {$data["nominal"]}" ?></option>
                    <?php endforeach ?>
                </select>
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>
</body>
</html>