<?php
include 'koneksi.php';

if (isset($_POST['cek'])) {
    $email = $_POST['email'];

    // Ambil data reservasi berdasarkan email
    $query = "SELECT * FROM reservasi WHERE email='$email'";
    $result = mysqli_query($koneksi, $query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Booking</title>
</head>
<body>
    <h2>Cek Booking Anda</h2>
    <form method="POST">
        <label for="email">Masukkan Email Anda:</label><br>
        <input type="email" name="email" required><br><br>
        <input type="submit" name="cek" value="Cek Booking">
    </form>

    <?php if (isset($result) && mysqli_num_rows($result) > 0): ?>
        <h3>Data Reservasi:</h3>
        <?php while ($data = mysqli_fetch_assoc($result)): ?>
            <p>Nama: <?= $data['nama']; ?></p>
            <p>Tanggal: <?= $data['tanggal']; ?></p>
            <p>Jam: <?= $data['jam']; ?></p>
            <p>Jumlah Kursi: <?= $data['kursi']; ?></p>
            <p>Status Pembayaran: <?= $data['status_pembayaran'] ?? 'Belum Dibayar'; ?></p>
            <hr>
        <?php endwhile; ?>
    <?php elseif (isset($result)): ?>
        <p>Data tidak ditemukan.</p>
    <?php endif; ?>
</body>
</html>
