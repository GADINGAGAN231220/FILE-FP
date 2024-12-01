<?php
$host = 'localhost'; // Ganti sesuai kebutuhan
$user = 'root';      // Username database
$pass = '';          // Password database
$db   = 'db_bus';    // Nama database

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
