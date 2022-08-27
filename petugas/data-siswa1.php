<?php 
session_start();
require "../functions/functions.php";

if(!isset($_SESSION["level"]) || $_SESSION["level"] != "admin") {
    header("Location: login.php");
}

var_dump($_POST);

$result = query("SELECT * FROM petugas WHERE id_petugas = {$_SESSION['id']}")[0];

// pagination
// konfigurasi
$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM siswa"));
$jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"]) ? $_GET["halaman"] : 1);
$awalData = ($jumlahDataPerHalaman * $halamanAktif) / $jumlahDataPerHalaman;

$siswa = query("SELECT * FROM siswa LIMIT $awalData,$jumlahDataPerHalaman");

if(isset($_POST["cari"])) {
    $siswa = cariSiswa($_POST["keyword"]); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
</head>
<body>
    <h1>Halo Admin, <?= $result["nama_petugas"] ?></h1>
    <a href="data-petugas.php">Daftar Petugas</a>
    <a href="data-kelas.php">Daftar Kelas</a>
    <a href="data-spp.php">Daftar SPP</a>
    <a href="data-riwayat.php">Daftar Riwayat Pembayaran</a>
    <a href="admin.php">Kembali ke Admin</a>

    <h1>Daftar Siswa</h1>

    <form action="" method="POST">
        <input type="text" name="keyword" autofocus placeholder="Cari Sini Bro" autocomplete="off">
        <button type="submit" name="cari">Cari!</button>
    </form>

    <?php if($halamanAktif > 1 ) : ?>
        <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
    <?php endif; ?>
    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if($i == $halamanAktif) :?>
            <a href="?halaman=<?= $i ?>" style="font-weight : bold; color : red;"><?= $i ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if($halamanAktif < $jumlahHalaman ) : ?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
    <?php endif; ?>
    <br>

    <a href="regissiswa.php">Tambah Siswa</a>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>SPP</th>
        </tr>
        <?php $no = 0 + $awalData?>
        <?php foreach($siswa as $data) : ?>
        <tr>
            <td><?= $no ?></td>
            <td>
                <a href="ubah.php?id=<?= $data["nisn"] ?>&level=siswa">Ubah</a> |
                <a href="hapus.php?id=<?= $data["nisn"] ?>&level=siswa">Hapus</a>
            </td>
            <td><?= $data["nisn"] ?></td>
            <td><?= $data["nama"] ?></td>
            <td><?= $data["nis"] ?></td>
            <td><?= implode(query("SELECT nama_kelas FROM kelas WHERE id_kelas = '{$data["id_kelas"]}'")[0]) ?></td>
            <td><?= $data["alamat"] ?></td>
            <td><?= $data["no_telp"] ?></td>
            <td><?= implode('-',query("SELECT tahun,nominal FROM spp WHERE id_spp = '{$data["id_spp"]}'")[0]) ?></td>
        </tr>
        <?php $no++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>