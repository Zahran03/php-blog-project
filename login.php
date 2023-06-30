<?php 
require "functions.php";
session_start();

if( isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");
    if( mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"])){
            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <nav>
        <section class="logo">Blog Php</section>
        <section class="navMenu">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="tambah.php">Buat Blog</a>
            <a href="login.php">Login</a>
        </section>
    </nav>
    <div class="container">
        <div class="wrapper">
            <h1>Login</h1>
            <div class="formInput">
                <form action="" method="post">
                    <label for="username">Username : </label>
                    <input type="text" name="username" id="username">
                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password">
                    <button type="submit" name="login">Login</button>
                </form>
            </div>
        </div>
        <?php if( isset($error) ) : ?>
            <p style="color: red; font-style: italic;">Username / Password Salah</p>
        <?php endif; ?>
        <div class="register">
            <a href="register.php">Belum Punya Akun?</a>
        </div>
    </div>
</body>
</html>