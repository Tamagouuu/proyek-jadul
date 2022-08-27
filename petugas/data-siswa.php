<?php 
session_start();
require "../functions/functions.php";

if(!isset($_SESSION["level"]) || $_SESSION["level"] != "admin") {
    header("Location: login.php");
}


if(isset($_POST["keyword"]) && strlen($_POST["keyword"]) != 0) {
    $_SESSION["hasilSiswa"] = $_POST["keyword"];
    unset($_GET);
}

// pagination
$jumlahDataPerHalaman = 3;
if(isset($_SESSION["hasilSiswa"])) {
    $jumlahData = count(cariSiswa($_SESSION["hasilSiswa"]));
} else {
    $jumlahData = count(query("SELECT * FROM siswa"));
}
$jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"]) ? $_GET["halaman"] : 1);
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


// $siswa = query("SELECT * FROM siswa LIMIT $awalData,$jumlahDataPerHalaman");

if(isset($_SESSION["hasilSiswa"])) {
    $hasil = cariSiswa($_SESSION["hasilSiswa"]);
    if(count($hasil) != 0) {
        $final = array_slice($hasil, $awalData, $jumlahDataPerHalaman);
        $siswa = $final;
    } else {
        $siswa = false;
    }
} else {
    $siswa = query("SELECT * FROM siswa LIMIT $awalData,$jumlahDataPerHalaman");
}

if(isset($_POST["batal"])) {
    unset($_SESSION["hasilSiswa"]);
    header("Refresh:0");
}

$result = query("SELECT * FROM petugas WHERE id_petugas = {$_SESSION['id']}")[0];
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

    <a href="regissiswa.php">Tambah Siswa</a>

    <br><br>

    <form action="" method="POST">
        <?php if (isset($_SESSION["hasilSiswa"])) : ?>
            <button type="submit" name="batal">Batalkan Pencarian</button>
        <?php else : ?>
            <input type="text" name="keyword" autofocus placeholder="Cari Sini Bro" autocomplete="off" >
            <button type="submit" name="cari">Cari!</button>
        <?php endif ?>
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

    <?php if($siswa != false) : ?>
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
        <?php $no = 1 + $awalData?>
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
    <?php else : ?>
        <h1>Data Yang Dicari Tidak Ada</h1>
    <?php endif; ?>
</body>
</html>