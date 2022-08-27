<?php 
session_start();
require "../functions/functions.php";

if(isset($_SESSION["level"])) {
    header("Location: {$_SESSION['level']}.php");
}

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username'"));
    if($result["username"] == $username && $result["password"] == $password) {
        $_SESSION["level"]= $result["level"];
        $_SESSION["id"] = $result["id_petugas"];
        header("Location:".$result["level"].".php");
    } else {
        echo("<script>alert('Anda Ngga Bisa Login')</script>");
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas</title>
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
                <h1>LOGIN PETUGAS</h1>
            </li>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>
</body>
</html>