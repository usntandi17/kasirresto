<?php
session_start();

// Koneksi
$conn = mysqli_connect('localhost', 'root', '', 'kasir_restorant');

// Login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' and password='$password'");
    $hitung = mysqli_num_rows($check);

    if ($hitung > 0) {
        $_SESSION['login'] = 'True';
        header('location:index.php');
    } else {
        echo '
        <script>alert("Username atau Password salah");
        window.location.href="login.php"
        </script>
        ';
    }
}

// Tambah masakan
if (isset($_POST['tambahmasakan'])) {
    $nama_masakan = $_POST['nama_masakan'];
    $harga = $_POST['harga'];
    $status_masakan = $_POST['status_masakan'];

    // Perhatikan penyesuaian nama kolom di sini
    $insert = mysqli_query($conn, "INSERT INTO masakan (nama_masakan, harga, status_masakan) 
                                   VALUES ('$nama_masakan', '$harga', '$status_masakan')");

    if ($insert) {
        header('location:stock.php');
    } else {
        echo '
        <script>alert("Gagal menambah masakan baru");
        window.location.href="stock.php"
        </script>
        ';
    }
}
?>
