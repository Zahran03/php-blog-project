<?php 
session_start();
if( !isset($_SESSION["id"]) ) {
    header("Location: login.php");
    exit;
}
require "functions.php";

if( hapus($_SESSION["id"]) > 0 ){
    header("Location: index.php");
} else {
    echo "
            <script>
                alert('gagal hapus');
                document.location.href = 'index.php';
            </script>
        ";
}

?>