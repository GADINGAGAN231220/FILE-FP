<?php
session_start();
include 'koneksi.php';

// Pastikan pengguna sudah login
// if (!isset($_SESSION['user'])) {
//     header('Location: index.php');
//     exit;
// }

// Ambil semua data bus dari database
$query = "SELECT * FROM buses";
$result = $koneksi->query($query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Pengguna</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['user']['name']); ?>!</h2> -->
        <p>Berikut adalah daftar bus yang tersedia:</p>

        <!-- Tabel Daftar Bus -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Bus</th>
                    <th>Keberangkatan</th>
                    <th>Tujuan</th>
                    <th>Harga</th>
                    <th>Kursi Tersedia</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['bus_name']); ?></td>
                            <td><?= htmlspecialchars($row['keberangkatan']); ?></td>
                            <td><?= htmlspecialchars($row['tujuan']); ?></td>
                            <td><?= number_format($row['price']); ?> IDR</td>
                            <td><?= htmlspecialchars($row['available_seats']); ?></td>
                            <td>
                                <<a href="reservasi.php?keberangkatan=<?= urlencode($row['keberangkatan']); ?>&tujuan=<?= urlencode($row['tujuan']); ?>" class="btn btn-primary btn-sm">
                                    Reservasi
                                </a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data bus tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>