<?php 
session_start();
require "../functions/functions.php";

if(!isset($_SESSION["siswa"]) == "siswa") {
    header("Location: login.php"); exit;
}

$id = $_SESSION["nisn"];

$result = query("SELECT * FROM siswa WHERE nisn = '{$id}'")[0];
$siswa = query("SELECT * FROM siswa");
$pembayaran = query("SELECT * FROM pembayaran WHERE nisn = '{$id}'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Halo Siswa, <?= $result["nama"] ?></h1>
    <a href="logout.php">Logout</a>

    <h1>Riwayat Pembayaran SPP</h1>
    <?php if(!empty($pembayaran)) : ?>   
        <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>No.</th>
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
    <?php else : ?>
        <h1>Belum terdapat transaksi pembayaran</h1>
    <?php endif; ?>
</body>
</html>