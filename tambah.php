<?php 
session_start();

require "functions.php";
if( !isset($_SESSION["id"]) ){
    header("Location: login.php");
    exit;
}
if( isset( $_POST["create"])){
    if( tambah($_POST, $_SESSION["id"]) > 0){
        header("Location: index.php");
    } else {
        echo "
            <script>
                alert('Data Gagagl Ditambahkan');
                document.location.href = 'index.php';
            </script>
        ";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Blog</title>
    <link rel="stylesheet" href="tambah.css">
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
        <section class="wrapperForm">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="judul">Judul : </label>
                <input type="text" name="judul" id="judul" placeholder="Masukan Judul Blog Anda">
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
                <label for="deskripsi">Deskripsi Blog : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Masukan Deskripsi Blog Anda"></textarea>
                <button type="submit" name="create">Buat Blog</button>   
            </form>
        </section>
    </div>
</body>
</html>