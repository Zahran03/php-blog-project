<?php 
session_start();
require "functions.php";

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

$blogs = query("SELECT * FROM blogs");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <section class="logo">Blog Php</section>
        <section class="navMenu">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <?php if( !isset($_SESSION["login"]) ) : ?>

            <?php else : ?>
                <a href="tambah.php">Buat Blog</a>
            <?php endif; ?>
            <?php if( !isset($_SESSION["login"]) ) : ?>
                <a href="login.php">Login</a>
            <?php else : ?>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </section>
    </nav>
    <section class="container">
        <section class="wrapperCard">
            <?php foreach( $blogs as $blog ) : ?>
            <section  class="card">
                <div class="imageBlog">
                    <img src="img/<?= $blog["gambar"] ?>" alt="" height="100">
                </div>
                <div class="postTitle">
                    <a href="detail.php?id=<?= $blog["id"] ?>"><?= $blog["judul"]?></a>
                </div>
                <div class="postDesc"><?= $blog["deskripsi"] ?></div>
            </section>
            <?php endforeach; ?>
        </section>
    </section>
</body>
</html>