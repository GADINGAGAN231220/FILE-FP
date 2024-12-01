<?php
session_start();
include 'koneksi.php'; // Include your database connection

// Check if reservation data is available
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve reservation data from the session or POST
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $keberangkatan = $_POST['keberangkatan'];
    $tujuan = $_POST['tujuan'];
    $kursi = $_POST['kursi'];

    // Store data in session for later use (like payment)
    $_SESSION['reservation'] = [
        'nama' => $nama,
        'email' => $email,
        'tanggal' => $tanggal,
        'jam' => $jam,
        'keberangkatan' => $keberangkatan,
        'tujuan' => $tujuan,
        'kursi' => $kursi,
    ];

    // Query to find available buses based on departure and destination
    $query = "SELECT * FROM reservasi_tiket WHERE keberangkatan='$keberangkatan' AND tujuan='$tujuan'";
    $result = mysqli_query($koneksi, $query);
} else {
    // Redirect back to the reservation form if accessed directly
    header('Location: landing.php'); // Change this to your actual reservation form page
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buses Available</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h2>Buses Available</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <tr>
                    <th>Bus Name</th>
                    <th>Price</th>
                    <th>Available Seats</th>
                    <th>Action</th>
                </tr>
                <?php while ($bus = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $bus['bus_name']; ?></td>
                        <td><?= $bus['price']; ?></td>
                        <td><?= $bus['available_seats']; ?></td>
                        <td>
                            <form action="pembayaran.php" method="POST">
                                <input type="hidden" name="nama" value="<?= $nama; ?>">
                                <input type="hidden" name="email" value="<?= $email; ?>">
                                <input type="hidden" name="tanggal" value="<?= $tanggal; ?>">
                                <input type="hidden" name="jam" value="<?= $jam; ?>">
                                <input type="hidden" name="keberangkatan" value="<?= $keberangkatan; ?>">
                                <input type="hidden" name="tujuan" value="<?= $tujuan; ?>">
                                <input type="hidden" name="kursi" value="<?= $kursi; ?>">
                                <input type="hidden" name="bus_id" value="<?= $bus['id']; ?>"> <!-- Assuming you have an ID for the bus -->
                                <input type="submit" value="Pilih Bus">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Tidak ada bus yang tersedia untuk rute ini.</p>
        <?php endif; ?>
    </div>
</body>
</html>