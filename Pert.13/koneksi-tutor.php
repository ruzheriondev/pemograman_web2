
<?php

$Open = mysqli_connect("localhost", "root", "", "db_mahasiswa");

// Cek koneksi database
if (!$Open) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}

?>
