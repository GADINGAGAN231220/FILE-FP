<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard</title>
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['user']['nama']); ?></h1>
    <a href="reservasi.php">Pesan Tiket</a><br>
    <a href="cek_booking.php">Cek Booking</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>
