<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'bus_booking';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// echo "Koneksi berhasil!";
?>
