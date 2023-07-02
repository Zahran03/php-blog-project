<?php 
session_start();

require "functions.php";
$userId = $_GET["id"];
if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
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
            <a href="tambah.php?user_id=<?= $userId ?>">Buat Blog</a>
            <?php if( isset($_SESSION["login"]) ) : ?>
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
                <p><?= $blog["user_id"]?></p>
                <div class="postDesc"><?= $blog["deskripsi"] ?></div>
            </section>
            <?php endforeach; ?>
        </section>
    </section>
</body>
</html>