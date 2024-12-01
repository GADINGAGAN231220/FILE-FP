<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama    = $_POST['nama'];
    $email   = $_POST['email'];
    $tanggal = $_POST['tanggal'];
    $jam     = $_POST['jam'];
    $kursi   = $_POST['kursi'];

    // Insert data ke database
    $sql = "INSERT INTO reservasi (nama, email, tanggal, jam, kursi) 
            VALUES ('$nama', '$email', '$tanggal', '$jam', '$kursi')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<h3>Reservasi berhasil!</h3>";
        echo "<a href='landing.php'>Kembali ke halaman utama</a>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
    
    mysqli_close($koneksi);
} else {
    header("Location: landing.php");
}
?>
