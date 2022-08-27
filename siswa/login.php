<?php
session_start();

require "../functions/functions.php";

if(isset($_SESSION["siswa"])) {
    header("Location: {$_SESSION['level']}.php");
}

if(isset($_POST["submit"])) {
    $nis = $_POST["nis"];
    $nisn = $_POST["nisn"];
    $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = '$nisn'"));
    if($result["nis"] == $nis && $result["nisn"] == $nisn) {
        $_SESSION["nisn"] = $result["nisn"];
        $_SESSION["siswa"] = "siswa"; 
        header("Location: siswa.php"); exit;
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
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
                <h1>LOGIN SISWA</h1>
            </li>
            <li>
                <label for="nisn">NISN :</label>
                <input type="text" name="nisn" id="nisn">
            </li>
            <li>
                <label for="nis">NIS :</label>
                <input type="password" name="nis" id="nis">
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>
    <ul>
        <li>
            <a href="../petugas/login.php">Login Sebagai Petugas, Disini</a>
        </li>
    </ul>
</body>
</html>