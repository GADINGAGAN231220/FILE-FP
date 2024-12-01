<?php
// Start the session
session_start();

// Check if the user has submitted the payment form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simulate payment processing
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jumlah_kursi = $_POST['kursi'];

    // Here you would typically process the payment through a payment gateway
    // For this example, let's assume the payment is always successful

    // Store payment information in session (or database)
    $_SESSION['payment_status'] = 'success';
    $_SESSION['nama'] = $nama;
    $_SESSION['email'] = $email;
    $_SESSION['jumlah_kursi'] = $jumlah_kursi;

    // Redirect to landing page after successful payment
    header('Location: bus_available.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Tiket Bus</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h2>Pembayaran Tiket Bus</h2>
        <form action="pembayaran.php" method="POST">
            <label for="nama">Nama Lengkap:</label><br>
            <input type="text" id="nama" name="nama" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="kursi">Jumlah Kursi:</label><br>
            <input type="number" id="kursi" name="kursi" min="1" max="10" required><br><br>

            <input type="submit" value="Bayar">
        </form>
    </div>
</body>
</html>