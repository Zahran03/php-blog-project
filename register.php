<?php 

require "functions.php";
if( isset($_POST["register"]) ){
    if(register($_POST) > 0){
        echo "
            <script>
                alert('Akun telah dibuat');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="login.css?version=12345">
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
    <div class="container">
        <div class="wrapper">
            <h1>Register</h1>
            <div class="formInput">
                <form action="" method="post">
                    <label for="username">Username : </label>
                    <input type="text" name="username" id="username">
                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password">
                    <label for="password2">Confirm Password : </label>
                    <input type="password" name="password2" id="password2">
                    <button type="submit" name="register">Registrasi</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>