<?php 
session_start();
if( !isset($_SESSION["id"]) ) {
    header("Location: login.php");
    exit;
}
require "functions.php";
$userID = $_SESSION["id"];
$blog = query("SELECT * FROM blogs WHERE user_id = $userID")[0];

if(isset($_POST["update"]) ){
    if( update($_POST, $userID) > 0 ){
        echo "
            <script>
                alert('berhasil edit');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('gagal edit');
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
    <title>Edit Blog</title>
    <link rel="stylesheet" href="tambah.css?version=12345">
</head>
<body>
        <nav>
            <section class="logo">Blogin</section>
            <section class="navMenu">
                <a href="index.php">Home</a>
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact</a>
                <a href="tambah.php">Buat Blog</a>
            </section>
        </nav>
    <div class="container">
        <section class="wrapperForm">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="gambarLama"  value="<?= $blog["gambar"] ?>">
                <label for="judul">Judul : </label>
                <input type="text" name="judul" id="judul" placeholder="Masukan Judul Blog Anda" value="<?= $blog["judul"]?>">
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
                <label for="deskripsi">Deskripsi Blog : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Masukan Deskripsi Blog Anda" ><?= $blog["deskripsi"] ?></textarea>
                <button type="submit" name="update">Edit Blog</button>   
            </form>
        </section>
    </div>
</body>
</html>