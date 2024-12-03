<?php
session_start();
if (!isset($_SESSION['message'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Form Pembayaran</h2>
        <form action="proses_pembayaran.php" method="POST">
            <label for="metode">Metode Pembayaran:</label>
            <select name="metode" class="form-control">
                <option value="transfer">Transfer Bank</option>
                <option value="kartu_kredit">Kartu Kredit</option>
                <option value="qris">QRIS</option>
            </select>
            <br>
            <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
        </form>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
