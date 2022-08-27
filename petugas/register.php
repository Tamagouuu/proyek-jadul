<?php
session_start(); 
require "../functions/functions.php";

if(!isset($_SESSION["level"]) || $_SESSION["level"] != "admin") {
    header("Location: login.php");
}

if(isset($_POST["submit"])) {
    if(regisPetugas($_POST) > 0) {
        echo "<script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'login.php';
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
    <title>Register Petugas</title>
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
                <h1>REGISTER PETUGAS</h1>
            </li>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="nama">Nama Petugas :</label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <button name="submit">Submit</button>
            </li>
        </ul>
    </form>
</body>
</html>