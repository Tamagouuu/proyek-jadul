<?php 
session_start();
require "../functions/functions.php";

if(!isset($_SESSION["level"]) || $_SESSION["level"] != "admin") {
    header("Location: login.php");
}

$id = $_GET["id"];
$level = $_GET["level"];

if($level == "petugas") {
    $hapus = "id_petugas";
} elseif($level == "siswa") {
    $hapus = "nisn";
} elseif($level == "spp") {
    $hapus = "id_spp";
} elseif($level == "kelas") {
    $hapus = "id_kelas";
}

if(hapus($id) > 0) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = 'admin.php';
          </script>";
} else {
    echo "<script>
            alert('Data Tidak berhasil dihapus');
            document.location.href = 'admin.php';
          </script>";
}

function hapus($id) {
    global $conn, $level, $hapus;

    mysqli_query($conn,"DELETE FROM {$level} WHERE {$hapus} = '$id'");

    $resp = mysqli_affected_rows($conn);
    return $resp;
}




?>
