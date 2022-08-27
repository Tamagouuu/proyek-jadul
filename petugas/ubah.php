<?php
session_start();
require "../functions/functions.php";

$id = $_GET["id"];
$level = $_GET["level"];

if (!isset($_SESSION["level"]) || $_SESSION["level"] != "admin") {
    header("Location: login.php");
}

if ($level == "petugas") {
    $resultPetugas = query("SELECT * FROM petugas WHERE id_petugas = $id")[0];
    $ubah = "ubahPetugas";
} elseif ($level == "siswa") {
    $resultSiswa = query("SELECT * FROM siswa WHERE nisn = $id")[0];
    $ubah = "ubahSiswa";
} elseif ($level == "kelas") {
    $resultKelas = query("SELECT * FROM kelas WHERE id_kelas = $id")[0];
    $ubah = "ubahKelas";
} elseif ($level == "spp") {
    $resultSpp = query("SELECT * FROM spp WHERE id_spp = $id")[0];
    $ubah = "ubahSpp";
}

$spp = query("SELECT * FROM spp");
$kelas = query("SELECT * FROM kelas");



if (isset($_POST["submit"])) {
    if ($ubah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah');
                document.location.href = 'admin.php';
              </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <style>
        ul {
            list-style: none;
        }
    </style>
</head>

<body>
    <h1>Ubah Data</h1>
    <?php if ($level == "petugas") : ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $resultPetugas["id_petugas"] ?>">
            <ul>
                <li>
                    <label for="username">Username :</label>
                    <input type="text" name="username" id="username" value="<?= $resultPetugas["username"] ?>" required>
                </li>
                <li>
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" value="<?= $resultPetugas["password"] ?>" required>
                </li>
                <li>
                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" id="nama" value="<?= $resultPetugas["nama_petugas"] ?>" required>
                </li>
                <li>
                    <button type="submit" name="submit">Submit</button>
                </li>
            </ul>
        </form>
    <?php elseif ($level == "siswa") : ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $resultSiswa["nisn"] ?>">
            <ul>
                <li>
                    <label for="nisn">NISN :</label>
                    <input type="text" name="nisn" id="nisn" value="<?= $resultSiswa["nisn"] ?>" required>
                </li>
                <li>
                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" id="nama" value="<?= $resultSiswa["nama"] ?>" required>
                </li>
                <li>
                    <label for="nis">NIS :</label>
                    <input type="text" name="nis" id="nis" value="<?= $resultSiswa["nis"] ?>" required>
                </li>
                <li>
                    <label for="idkelas">Kelas :</label>
                    <select name="idkelas" id="idkelas">
                        <?php foreach ($kelas as $data) : ?>
                            <?php if ($data["id_kelas"] == $resultSiswa["id_kelas"]) : ?>
                                <option value="<?= $resultSiswa["id_kelas"] ?>" selected><?= $data["nama_kelas"] ?></option>
                            <?php else : ?>
                                <option value="<?= $data["id_kelas"] ?>"><?= $data["nama_kelas"] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </li>
                <li>
                    <label for="alamat">Alamat :</label>
                    <input type="text" name="alamat" id="alamat" value="<?= $resultSiswa["alamat"] ?>">
                </li>
                <li>
                    <label for="telp">No. Telp</label>
                    <input type="telp" name="telp" id="telp" value="<?= $resultSiswa["no_telp"] ?>">
                </li>
                <li>
                    <label for="idspp">SPP :</label>
                    <select name="idspp" id="idspp">
                        <?php foreach ($spp as $data) : ?>
                            <?php if ($data["id_spp"] == $resultSiswa["id_spp"]) : ?>
                                <option value="<?= $resultSiswa["id_spp"] ?>" selected><?= " {$data["tahun"]}-{$data["nominal"]}" ?></option>
                            <?php else : ?>
                                <option value="<?= $data["id_spp"] ?>"><?= "{$data["tahun"]}-{$data["nominal"]}" ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </li>
                <li>
                    <button type="submit" name="submit">Submit</button>
                </li>
            </ul>
        </form>
    <?php elseif ($level == "kelas") : ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $resultKelas["id_kelas"] ?>">
            <ul>
                <li>
                    <label for="nama">Nama Kelas :</label>
                    <input type="text" name="nama" id="nama" value="<?= $resultKelas["nama_kelas"] ?>">
                </li>
                <li>
                    <label for="kompetensi">Kompetensi Keahlian :</label>
                    <input type="text" name="kompetensi" id="kompetensi" value="<?= $resultKelas["kompetensi_keahlian"] ?>">
                </li>
                <li>
                    <button type="submit" name="submit">Submit</button>
                </li>
            </ul>
        </form>
    <?php elseif ($level == "spp") : ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $resultSpp["id_spp"] ?>">
            <ul>
                <li>
                    <label for="nama">Tahun :</label>
                    <input type="text" name="tahun" id="tahun" value="<?= $resultSpp["tahun"] ?>">
                </li>
                <li>
                    <label for="nominal">Nominal :</label>
                    <input type="text" name="nominal" id="nominal" value="<?= $resultSpp["nominal"] ?>">
                </li>
                <li>
                    <button type="submit" name="submit">Submit</button>
                </li>
            </ul>
        </form>
    <?php endif; ?>
</body>

</html>