<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reservasi = $_POST['id'];
    $metode       = $_POST['metode'];
    $status       = 'Lunas';

    // Update status pembayaran
    $sql = "UPDATE reservasi SET status_pembayaran='$status', metode_pembayaran='$metode' WHERE id=$id_reservasi";

    if (mysqli_query($koneksi, $sql)) {
        echo "<h3>Pembayaran berhasil!</h3>";
        echo "<a href='index.php'>Kembali ke halaman utama</a>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
} else {
    header("Location: landing.php");
}
?>
