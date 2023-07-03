<?php 
require "functions.php";
$userID = $_GET["user_id"];

$blog = query("SELECT * FROM blogs WHERE user_id = $userID")[0];

if(isset($_POST["update"]) ){
    if( update($_POST, $blog["id"]) > 0 ){
        header("Location: index.php?id=" . $userID);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="tambah.css">
</head>
<body>
        <nav>
            <section class="logo">Blog Php</section>
            <section class="navMenu">
                <a href="index.php?id=<?= $userID ?>">Home</a>
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact</a>
                <a href="tambah.php">Buat Blog</a>
            </section>
        </nav>
    <div class="container">
        <section class="wrapperForm">
            <form action="" method="post">
                <label for="judul">Judul : </label>
                <input type="text" name="judul" id="judul" placeholder="Masukan Judul Blog Anda" value="<?= $blog["judul"]?>">
                <label for="gambar">Gambar : </label>
                <input type="text" name="gambar" id="gambar" value="<?= $blog["gambar"]?>">
                <label for="deskripsi">Deskripsi Blog : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Masukan Deskripsi Blog Anda" ><?= $blog["deskripsi"] ?></textarea>
                <button type="submit" name="update">Buat Blog</button>   
            </form>
        </section>
    </div>
</body>
</html>