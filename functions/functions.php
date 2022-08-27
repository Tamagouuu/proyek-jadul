<?php 

$conn = mysqli_connect("localhost","root","","latihan_aplikasi_spp");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row; 
    }
    return $rows;
}



function regisPetugas($data) {
    global $conn;

    $username = $data["username"];
    $password = $data["password"];
    $nama = $data["nama"];

    $result = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)) {
        echo "<script> alert('Username sudah ada')</script>";
        return false;
    }

    mysqli_query($conn, "INSERT INTO petugas VALUES('','$username','$password','$nama','petugas')");

    $resp = mysqli_affected_rows($conn);

    return $resp;

}

function regisSiswa($data) {
    global $conn;

    $nisn = $data["nisn"];
    $nama = $data["nama"];
    $nis = $data["nis"];
    $idKelas = $data["idkelas"];
    $alamat = $data["alamat"];
    $noTelp = $data["telp"];
    $idSpp = $data["spp"];

    $result = mysqli_query($conn, "SELECT * FROM siswa WHERE nis = '$nis'");

    if(mysqli_fetch_assoc($result)) {
        echo "<script> alert('Data sudah ada')</script>";
        return false;
    }

    mysqli_query($conn, "INSERT INTO siswa VALUE('$nisn','$nama','$nis','$idKelas','$alamat', '$noTelp', '$idSpp')");

    $resp = mysqli_affected_rows($conn);

    return $resp;

}

function regisKelas($data) {
    global $conn;

    $kelas = $data["kelas"];
    $kompetensi = $data["kompetensi"];

    $result = mysqli_query($conn, "SELECT * FROM kelas WHERE nama_kelas = '$kelas'");

    if(mysqli_fetch_assoc($result)) {
        echo "<script> alert('Data sudah ada')</script>";
        return false;
    }

    mysqli_query($conn,"INSERT INTO kelas VALUE('','$kelas','$kompetensi')");

    $resp = mysqli_affected_rows($conn);

    return $resp;
}

function regisSpp($data) {
    global $conn;

    $tahun = $data["tahun"];
    $nominal = $data["nominal"];

    $result = mysqli_query($conn, "SELECT * FROM spp WHERE tahun = '$tahun'");

    if(mysqli_fetch_assoc($result)) {
        echo "<script> alert('Data sudah ada')</script>";
        return false;
    }

    mysqli_query($conn,"INSERT INTO spp VALUE('','$tahun','$nominal')");

    $resp = mysqli_affected_rows($conn);

    return $resp;
}


function ubahPetugas($data) {
    global $conn;
    
    $id = $data["id"];
    $username = $data["username"];
    $password = $data["password"];
    $nama = $data["nama"];

    mysqli_query($conn,"UPDATE petugas SET username = '$username', password = '$password', nama_petugas = '$nama' WHERE id_petugas = $id");

    $result = mysqli_affected_rows($conn);
    return $result;
}

function ubahSiswa($data) {
    global $conn;

    $id = $data["id"];
    $nisn = $data["nisn"];
    $nama = $data["nama"];
    $nis = $data["nis"];
    $kelas = $data["idkelas"];
    $alamat = $data["alamat"];
    $telp = $data["telp"];
    $spp = $data["idspp"];

    mysqli_query($conn,"UPDATE siswa SET nisn = '$nisn',nama = '$nama', nis = '$nis', id_kelas = '$kelas', alamat = '$alamat', no_telp = '$telp', id_spp = '$spp' WHERE nisn = $id");

    $result = mysqli_affected_rows($conn);
    return $result;

}

function ubahKelas($data) {
    global $conn;

    $id = $data["id"];
    $nama = $data["nama"];
    $kompetensi = $data["kompetensi"];

    mysqli_query($conn,"UPDATE kelas SET nama_kelas = '$nama', kompetensi_keahlian = '$kompetensi' WHERE id_kelas = $id");

    $result = mysqli_affected_rows($conn);
    return $result;
}

function ubahSpp($data) {
    global $conn;

    $id = $data["id"];
    $tahun = $data["tahun"];
    $nominal = $data["nominal"];

    mysqli_query($conn,"UPDATE spp SET tahun = '$tahun', nominal = '$nominal' WHERE id_spp = $id");

    $result = mysqli_affected_rows($conn);
    return $result;
}

function entrySpp($data) {
    global $conn;

    $id = $data["id"];
    $nisn = $data["nisn"];
    $tgl = $data["tgl"];
    $bulan = $data["bulan"];
    $tahun = $data["tahun"];
    $spp = $data["spp"];
    $bayar = $data["bayar"];

    mysqli_query($conn, "INSERT INTO pembayaran VALUES('','$id','$nisn','$tgl','$bulan','$tahun','$spp','$bayar')");

    $result = mysqli_affected_rows($conn);
    return $result;


}

function cariPetugas($keyword) {
    $query = "SELECT * FROM petugas WHERE nama_petugas LIKE '%$keyword%' OR username LIKE '%$keyword%'";

    return query($query);
}

function cariSiswa($keyword) {
    $query = "SELECT * FROM siswa WHERE nama LIKE '%$keyword%' OR nisn LIKE '%$keyword%' OR nis LIKE '%$keyword%'";

    return query($query);
}

function cariKelas($keyword) {
    $query = "SELECT * FROM kelas WHERE nama_kelas LIKE '%$keyword%' OR kompetensi_keahlian LIKE '%$keyword%'";

    return query($query);
}

function cariSpp($keyword) {
    $query = "SELECT * FROM spp WHERE tahun LIKE '%$keyword%' OR nominal LIKE '%$keyword%'";
    return query($query);
}

?>