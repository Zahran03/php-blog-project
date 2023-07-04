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

function tambah($data, $id ){
    global $conn;

    // ambil data user 
    $userID = $id;
    $judul = htmlspecialchars($data["judul"]);
    $gambar = upload();
    if( !$gambar ){
        return false;
    }
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    mysqli_query($conn, "INSERT INTO blogs VALUES ('', $userID, '$gambar', '$judul', '$deskripsi')");

    return mysqli_affected_rows($conn);
}
function upload() {
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // cek apakah user mengupload gambar
    if( $error === 4){
        echo "
            <script>
                alert('Pilih Gambar Telebih Dahulu');
                document.location.href = 'index.php';
            </script>
        ";
        return false;
    }

    // cek apakah yang di upload user adalah gambar
    $ekstensiGambarValid = ["jpg", "png", "jpeg"];
    $ekstensiGambarUser = explode(".", $namaFile);
    $ekstensiGambarUser = strtolower(end($ekstensiGambarUser));

    if( !in_array($ekstensiGambarUser, $ekstensiGambarValid)){
        echo "
            <script>
                alert('Maaf Yang Anda Upload Bukan Gambar');
                document.location.href = 'index.php';
            </script>
        ";
        return false;
    }

    // cek ukuran file 
    if( $ukuranFile > 4000000 ){
        echo "
            <script>
                alert('Maaf Ukuran Gambar Minimal 4MB');
                document.location.href = 'index.php';
            </script>
        ";
        return false;
    }

    // lolos semua pengecekan 
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambarUser;

    move_uploaded_file($tmpName, "img/" . $namaFileBaru);

    return $namaFileBaru;
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

function update($data, $id){
    global $conn;

    $judul = htmlspecialchars($data["judul"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar lama atau gambar baru
    if( $_FILES["gambar"]["error"] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE blogs SET
                gambar = '$gambar',
                judul = '$judul',
                deskripsi = '$deskripsi'
              WHERE user_id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM blogs WHERE id = $id");

    return mysqli_affected_rows($conn);
}
?>