<?php
session_start();
include 'koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Cek apakah parameter GET ada dan valid
// if (!isset($_GET['keberangkatan']) || !isset($_GET['tujuan'])) {
//     die("Keberangkatan atau Tujuan tidak ditemukan.");
// }

// Ambil parameter keberangkatan dan tujuan dari URL
$keberangkatan = $_GET['keberangkatan'];
$tujuan = $_GET['tujuan'];

$query = "SELECT * FROM buses WHERE keberangkatan = ? AND tujuan = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("ss", $keberangkatan, $tujuan);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah ada bus yang ditemukan
$no_bus_message = "";
if ($result->num_rows == 0) {
    $no_bus_message = "Tidak ada bus yang ditemukan untuk rute ini.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Reservasi Tiket</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Formulir Reservasi</h2>
        <form method="POST" action="proses_reservasi.php">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">

            <div class="form-group">
                <label>Keberangkatan</label>
                <input type="text" name="keberangkatan" class="form-control" value="<?= htmlspecialchars($keberangkatan); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Tujuan</label>
                <input type="text" name="tujuan" class="form-control" value="<?= htmlspecialchars($tujuan); ?>" readonly>
            </div>

            <!-- Menampilkan pesan jika tidak ada bus -->
            <?php if ($no_bus_message): ?>
                <div class="alert alert-warning" role="alert">
                    <?= $no_bus_message; ?>
                </div>
            <?php else: ?>
                <div class="form-group">
                    <label>Pilih Bus</label>
                    <select name="bus_id" class="form-control" required>
                        <option value="">Pilih Bus</option>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <option value="<?= $row['id']; ?>"><?= $row['bus_name']; ?> - <?= $row['price']; ?> IDR</option>
                        <?php endwhile; ?>
                    </select>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label>Tanggal Keberangkatan</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jam Keberangkatan</label>
                <input type="time" name="jam" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jumlah Kursi</label>
                <input type="number" name="jumlah_kursi" class="form-control" required min="1" max="10">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Reservasi</button>
        </form>
    </div>
</body>
</html>