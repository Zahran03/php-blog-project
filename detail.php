<?php 

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
    <link rel="stylesheet" href="detail.css">
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
    <section class="container">
        <div class="wrapperBlog">
            <img src="img/<?= $blog["gambar"] ?>" alt="">
            <div class="detailBlog">
                <h1><?= $blog["judul"] ?></h1>
                <p><?= $blog["deskripsi"] ?></p>
            </div>
        </div>
    </section>
</body>
</html>