<?php 
session_start();

require "functions.php";
if( !isset($_SESSION["id"]) ){
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
    <link rel="stylesheet" href="style.css?version=12345">
</head>
<body>
    <nav>
        <section class="logo">Blogin</section>
        <section class="navMenu">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="tambah.php">Buat Blog</a>
            <?php if( isset($_SESSION["id"]) ) : ?>
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
                <?php if( $_SESSION["id"] === $blog["user_id"] ) :?>
                    <div class="deleteAndEdit">
                        <a class="editButton" href="edit.php">Edit</a>
                        <a class="deleteButton" href="delete.php?id=<?= $blog["id"] ?>">Delete</a>
                    </div>
                <?php endif; ?>
                <div class="postDesc"><?= $blog["deskripsi"] ?></div>
            </section>
            <?php endforeach; ?>
        </section>
    </section>
</body>
</html>