<?php
session_start();  
require "../functions/functions.php";


if(!isset($_SESSION["level"]) || $_SESSION["level"] != "admin") {
    header("Location: login.php");
}

if(isset($_POST["submit"])) {
    if(regisKelas($_POST) > 0) {
        echo "<script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'admin.php';
              </script>";
    } else
        echo "<script>alert('Data Tidak Berhasil Ditambahkan')</script>";
}


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
        <ul>
            <li>
                <h1>REGISTER KELAS</h1>
            </li>
            <li>
                <label for="kelas">Nama Kelas :</label>
                <input type="text" name="kelas" id="kelas">
            </li>   
                <li>
                    <label for="kompetensi">Kompetensi Keahlian :</label>
                    <input type="text" name="kompetensi" id="kompetensi">
                </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>
</body>
</html>