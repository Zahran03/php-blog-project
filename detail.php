<?php 
session_start();
// if( !isset($_SESSION["id"]) ) {
//     header("Location: login.php");
//     exit;
// }
require "functions.php";

// ambil param
$id = $_GET["id"];
$blog = query("SELECT * FROM blogs WHERE id = $id")[0];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Detail</title>
    <link rel="stylesheet" href="detail.css?version=12345">
</head>
<body>
    <nav>
        <section class="logo">Blogin</section>
        <section class="navMenu">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="tambah.php">Buat Blog</a>
            <a href="login.php">Login</a>
        </section>
    </nav>
    <section class="container">
        <div class="wrapperBlog">
            <div class="imageTitle">
                <div class="image">
                    <img src="img/<?= $blog["gambar"] ?>" alt="">
                </div>
                <div class="title">
                    <h1><?= $blog["judul"] ?></h1>
                </div>
            </div>
            <div class="detailBlog">
                <p><?= $blog["deskripsi"] ?></p>
                <a href="index.php">Kembali Ke Home</a>
            </div>
        </div>
    </section>
</body>
</html>