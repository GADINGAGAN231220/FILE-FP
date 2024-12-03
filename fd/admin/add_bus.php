<?php
session_start();
// if ($_SESSION['role'] != 'admin') {
//     header('Location: ../index.php');
//     exit;
// }
include '../koneksi.php';

$message = ""; // Inisialisasi pesan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $bus_name = $_POST['bus_name'];
    $keberangkatan = $_POST['keberangkatan'];
    $tujuan = $_POST['tujuan'];
    $price = $_POST['price'];
    $available_seats = $_POST['available_seats'];

    // Menyiapkan query untuk menyimpan data bus
    $query = "INSERT INTO buses (bus_name, keberangkatan, tujuan, price, available_seats) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssis", $bus_name, $keberangkatan, $tujuan, $price, $available_seats);

    // Menjalankan query dan memberikan feedback
    if ($stmt->execute()) {
        $message = "Data bus berhasil ditambahkan!";
    } else {
        $message = "Gagal menambahkan bus: " . $stmt->error;
    }
    header('Location: manage_bus.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Data Bus</title>
    <link href="../assets/css/styles.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Data Bus</h2>

    <!-- Menampilkan pesan jika ada -->
    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?= $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Nama Bus</label>
            <input type="text" name="bus_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Keberangkatan</label>
            <input type="text" name="keberangkatan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tujuan</label>
            <input type="text" name="tujuan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Kursi Tersedia</label>
            <input type="number" name="available_seats" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
        <a href="manage_bus.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>