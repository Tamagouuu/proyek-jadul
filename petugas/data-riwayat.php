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
    <title>Riwayat Pembayaran</title>
</head>
<body>
    <h1>Halo Admin, <?= $result["nama_petugas"] ?></h1>
    <a href="data-petugas.php">Daftar Petugas</a>
    <a href="data-siswa.php">Daftar Siswa</a>
    <a href="data-kelas.php">Daftar Kelas</a>
    <a href="data-spp.php">Daftar SPP</a>
    <a href="admin.php">Kembali ke Admin</a>
    <h1>Riwayat Pembayaran SPP</h1>
    <a href="entryspp.php">Entry Pembayaran SPP</a>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Petugas</th>
            <th>NISN</th>
            <th>Tgl Bayar</th>
            <th>Bulan dibayar</th>
            <th>Tahun dibayar</th>
            <th>Jumlah dibayar</th>
        </tr>
        <?php $no = 1 ?>
        <?php foreach($pembayaran as $data) : ?>
        <tr>
            <td><?= $no ?></td>
            <td>
                <a href="ubah.php?id=<?= $data["id_pembayaran"] ?>&level=pembayaran">Ubah</a> |
                <a href="hapus.php?id=<?= $data["id_pembayaran"] ?>&level=pembayaran">Hapus</a>
            </td>
            <td><?= implode(query("SELECT nama_petugas FROM petugas WHERE id_petugas = '{$data["id_petugas"]}'")[0]) ?></td>
            <td><?= $data["nisn"] ?></td>
            <td><?= $data["tgl_bayar"] ?></td>
            <td><?= $data["bulan_dibayar"] ?></td>
            <td><?= implode(query("SELECT tahun FROM spp WHERE id_spp = '{$data["id_spp"]}'")[0]) ?></td>
            <td><?= implode(query("SELECT nominal FROM spp WHERE id_spp = '{$data["id_spp"]}'")[0]) ?></td>
        </tr>
        <?php $no++; ?>
        <?php endforeach; ?>
    </table>   
</body>
</html>