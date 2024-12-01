<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Tiket Bus</title>
</head>
<body>
    <h1>Booking Tiket Bus</h1>
    <form method="POST" action="process_booking.php">
        <input type="text" name="bus_name" placeholder="Nama Bus" required><br>
        <input type="text" name="route" placeholder="Rute" required><br>
        <input type="date" name="date" required><br>
        <input type="number" name="seats" placeholder="Jumlah Kursi" required><br>
        <button type="submit">Book Sekarang</button>
    </form>
    <a href="logout.php">Logout</a>
</body>
</html>
