<?php 
$conn = mysqli_connect("localhost", "root", "", "blogproject");

function query($query) {
    global $conn;

    $result = mysqli_query($conn, $query);

    $data = [];
    while ( $row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }

    return $data;
}

function tambah($data, $userid){
    global $conn;

    // ambil data user 
    $userID = $userid;
    $judul = htmlspecialchars($data["judul"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    mysqli_query($conn, "INSERT INTO blogs VALUES ('',$userID, '$gambar', '$judul', '$deskripsi')");

    return mysqli_affected_rows($conn);
}

function register($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek apakah ada username yang sama
    $cekUsername = mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '$username'");
    if( mysqli_fetch_assoc($cekUsername)){
        echo "
            <script>
                alert('Username Yang Anda Masukan Sudah Ada');
                document.location.href = 'index.php';
            </script>
        ";
        return false;
    }

    // cek apakah password dan password confirm sama
    if( $password !== $password2){
        echo "
            <script>
                alert('Password dan Password Konfirmasi');
                document.location.href = 'index.php';
            </script>
        ";
        return false;
    }
    // hashing password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //masukan kedalam data base
    mysqli_query($conn, "INSERT INTO pengguna VALUES ('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}



?>